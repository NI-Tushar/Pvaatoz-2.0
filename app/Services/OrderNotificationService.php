<?php

namespace App\Services;

use App\Models\Configer;
use App\Models\Order;
use App\Models\OrderTakingSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderNotificationService
{
    /**
     * Dispatch order notifications across Telegram, Discord, and Email.
     */
    public function sendOrderNotifications(Order $order): array
    {
        $configer = Configer::latest()->first();
        $settings = OrderTakingSetting::current();

        $results = [
            'telegram' => ['success' => false, 'message' => 'Disabled or not configured'],
            'discord'  => ['success' => false, 'message' => 'Disabled or not configured'],
            'email'    => ['success' => false, 'message' => 'Disabled or not configured'],
        ];

        // Ensure order relations are loaded
        if (!$order->relationLoaded('items')) {
            $order->load('items');
        }

        // 1. Telegram Dispatch (Configer profile takes precedence)
        $hasTelegram = !empty($configer?->telegram) || (!empty($settings->is_telegram_enabled) && !empty($settings->telegram_address));
        if ($hasTelegram) {
            $results['telegram'] = $this->sendTelegramNotification($order, $configer, $settings);
        }

        // 2. Discord Dispatch
        if ($settings->is_discord_enabled || !empty($configer?->discord)) {
            $results['discord'] = $this->sendDiscordNotification($order, $configer, $settings);
        }

        // 3. Email Dispatch (Configer email & app password take precedence)
        $hasEmail = !empty($configer?->email) || (!empty($settings->is_email_enabled) && !empty($settings->email_address));
        if ($hasEmail) {
            $results['email'] = $this->sendEmailNotification($order, $configer, $settings);
        }

        return $results;
    }

    /**
     * Send order alert to Telegram account.
     */
    public function sendTelegramNotification(Order $order, ?Configer $configer = null, ?OrderTakingSetting $settings = null): array
    {
        try {
            $configer = $configer ?: Configer::latest()->first();
            $settings = $settings ?: OrderTakingSetting::current();

            // 1. Resolve Telegram account handle
            $rawTelegram = trim($configer?->telegram ?: ($settings->telegram_address ?? ''));
            if (empty($rawTelegram)) {
                return ['success' => false, 'message' => 'No Telegram account configured in Configer or Order Taking Settings'];
            }

            // Parse username if given as full t.me link
            if (preg_match('/(?:https?:\/\/)?(?:www\.)?t(?:elegram)?\.me\/([a-zA-Z0-9_]+)/i', $rawTelegram, $matches)) {
                $cleanHandle = $matches[1];
            } else {
                $cleanHandle = ltrim($rawTelegram, '@');
            }

            // 2. Resolve Telegram Bot Token
            $botToken = trim(
                $configer?->telegram_bot_token 
                ?: (env('TELEGRAM_BOT_TOKEN') 
                ?: ($settings->telegram_bot_token ?? ''))
            );

            // 3. Build rich HTML message
            $adminUrl = url('/admin/orders');
            $itemsList = '';
            foreach ($order->items as $item) {
                $itemsList .= "  • <b>" . htmlspecialchars($item->product_name) . "</b> × {$item->quantity} ($" . number_format($item->subtotal ?? $item->unit_price, 2) . ")\n";
            }
            if (empty($itemsList)) {
                $itemsList = "  • {$order->total_quantity} accounts ($" . number_format($order->total_price, 2) . ")\n";
            }

            $message  = "🛒 <b>NEW CUSTOMER ORDER RECEIVED!</b>\n";
            $message .= "━━━━━━━━━━━━━━━━━━━━━━\n";
            $message .= "📦 <b>Order Number:</b> <code>#{$order->order_number}</code>\n";
            $message .= "👤 <b>Customer Name:</b> " . htmlspecialchars($order->customer_name) . "\n";
            $message .= "📧 <b>Customer Email:</b> " . htmlspecialchars($order->customer_email) . "\n";
            $message .= "📱 <b>Phone / WhatsApp:</b> " . htmlspecialchars($order->customer_phone ?? 'Not provided') . "\n";
            $message .= "💳 <b>Payment Method:</b> " . strtoupper(str_replace('_', ' ', $order->payment_method)) . " (" . ucfirst($order->payment_status) . ")\n";
            $message .= "💰 <b>Order Total:</b> <b>$" . number_format($order->total_price, 2) . "</b> ({$order->total_quantity} accounts)\n\n";
            $message .= "📋 <b>Items Ordered:</b>\n" . $itemsList . "\n";

            if (!empty($order->notes)) {
                $message .= "📝 <b>Customer Notes:</b> " . htmlspecialchars($order->notes) . "\n\n";
            }

            $message .= "🎯 <b>Target Account:</b> @{$cleanHandle}\n";
            $message .= "🔗 <a href=\"{$adminUrl}\">View in Admin Panel</a>";

            // If no Bot Token is present, log and inform the user
            if (empty($botToken)) {
                Log::info("Telegram order alert logged for account @{$cleanHandle} (Order #{$order->order_number}). Bot token not set.");
                return [
                    'success' => false,
                    'message' => "Telegram account set to @{$cleanHandle}, but no Telegram Bot Token found. Please enter your Telegram Bot Token in Admin Configer or set TELEGRAM_BOT_TOKEN in .env to enable instant delivery.",
                ];
            }

            // 4. Resolve Chat ID
            $chatId = $configer?->telegram_chat_id ?: ($settings->telegram_chat_id ?? '');

            // If handle itself is a numeric ID, use it directly
            if (is_numeric($cleanHandle)) {
                $chatId = $cleanHandle;
            }

            // If chatId is not set or not numeric, attempt auto-discovery from getUpdates
            if (empty($chatId) || !is_numeric($chatId)) {
                try {
                    $updatesResponse = Http::timeout(4)->get("https://api.telegram.org/bot{$botToken}/getUpdates");
                    if ($updatesResponse->successful()) {
                        $updates = $updatesResponse->json('result', []);
                        foreach ($updates as $up) {
                            $chat = $up['message']['chat'] ?? ($up['my_chat_member']['chat'] ?? null);
                            if ($chat) {
                                $chatUsername = strtolower($chat['username'] ?? '');
                                if ($chatUsername === strtolower($cleanHandle) || (string)($chat['id'] ?? '') === (string)$cleanHandle) {
                                    $chatId = (string) $chat['id'];
                                    // Cache discovered chat_id into configers table
                                    if ($configer) {
                                        $configer->update(['telegram_chat_id' => $chatId]);
                                    }
                                    break;
                                }
                            }
                        }
                    }
                } catch (\Throwable $e) {
                    Log::warning('Telegram auto getUpdates resolution error: ' . $e->getMessage());
                }
            }

            // Fallback to @username (works for channels/supergroups) if still not resolved
            $targetDestination = !empty($chatId) ? $chatId : ('@' . $cleanHandle);

            // 5. Send message via Telegram Bot API
            $response = Http::timeout(7)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id'                  => $targetDestination,
                'text'                     => $message,
                'parse_mode'               => 'HTML',
                'disable_web_page_preview' => false,
            ]);

            if ($response->successful()) {
                Log::info("Telegram order notification sent to {$targetDestination} for Order #{$order->order_number}");
                return [
                    'success' => true,
                    'message' => "Order notification successfully sent to Telegram account @{$cleanHandle} (Target ID: {$targetDestination})",
                ];
            }

            // Handle Telegram API errors with friendly explanation
            $errDesc = $response->json('description', 'Unknown error');
            Log::warning("Telegram notification failed for @{$cleanHandle} (ID: {$targetDestination}): {$errDesc}");

            $hint = "";
            if (str_contains(strtolower($errDesc), 'chat not found') || str_contains(strtolower($errDesc), 'bot can\'t initiate conversation')) {
                $hint = " Hint: Please open your bot on Telegram and send '/start' or message it once so the bot can send messages to @{$cleanHandle}.";
            }

            return [
                'success' => false,
                'message' => "Telegram API returned error: {$errDesc}.{$hint}",
            ];
        } catch (\Throwable $e) {
            Log::error('Telegram notification exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Telegram error: ' . $e->getMessage()];
        }
    }

    /**
     * Send order alert to Discord via Webhook.
     */
    public function sendDiscordNotification(Order $order, ?Configer $configer = null, ?OrderTakingSetting $settings = null): array
    {
        try {
            $configer = $configer ?: Configer::latest()->first();
            $settings = $settings ?: OrderTakingSetting::current();

            $discordAddress = trim($configer?->discord ?: ($settings->discord_address ?? ''));
            $webhookUrl = trim($settings->discord_webhook_url ?? '');

            $adminUrl = url('/admin/orders');
            $itemsLines = [];
            foreach ($order->items as $item) {
                $itemsLines[] = "• **" . $item->product_name . "** × {$item->quantity} ($" . number_format($item->subtotal ?? $item->unit_price, 2) . ")";
            }
            if (empty($itemsLines)) {
                $itemsLines[] = "• {$order->total_quantity} accounts ($" . number_format($order->total_price, 2) . ")";
            }

            $embed = [
                'title'       => "🛒 New Order Placed: #{$order->order_number}",
                'url'         => $adminUrl,
                'color'       => 0x10B981, // Emerald Green
                'description' => "A customer has placed an order on **AccueVault**.\n**Assigned Handler:** `{$discordAddress}`",
                'fields'      => [
                    [
                        'name'   => '👤 Customer Information',
                        'value'  => "**Name:** {$order->customer_name}\n**Email:** {$order->customer_email}\n**Phone:** " . ($order->customer_phone ?: 'Not provided'),
                        'inline' => true,
                    ],
                    [
                        'name'   => '💳 Payment Details',
                        'value'  => "**Method:** " . strtoupper(str_replace('_', ' ', $order->payment_method)) . "\n**Status:** " . ucfirst($order->payment_status) . "\n**Total:** $" . number_format($order->total_price, 2),
                        'inline' => true,
                    ],
                    [
                        'name'   => '📋 Ordered Product Details',
                        'value'  => implode("\n", array_slice($itemsLines, 0, 10)),
                        'inline' => false,
                    ],
                ],
                'footer'      => [
                    'text' => 'AccueVault Order System • Discord Handler: ' . $discordAddress,
                ],
                'timestamp'   => now()->toISOString(),
            ];

            if (!empty($order->notes)) {
                $embed['fields'][] = [
                    'name'   => '📝 Customer Notes',
                    'value'  => $order->notes,
                    'inline' => false,
                ];
            }

            if (!empty($webhookUrl)) {
                $response = Http::timeout(6)->post($webhookUrl, [
                    'username' => 'AccueVault Order Taking',
                    'content'  => "🚨 **New Order Alert!** Attention: `{$discordAddress}`",
                    'embeds'   => [$embed],
                ]);

                if ($response->successful()) {
                    return ['success' => true, 'message' => "Dispatched to Discord Webhook successfully! (Target: {$discordAddress})"];
                } else {
                    Log::warning('Discord Webhook failed: ' . $response->body());
                    return ['success' => false, 'message' => 'Discord Webhook error (HTTP ' . $response->status() . ')'];
                }
            } else {
                Log::info("Discord order alert logged for handler {$discordAddress} (Order #{$order->order_number}).");
                return ['success' => true, 'message' => "Discord handle configured as {$discordAddress}."];
            }
        } catch (\Throwable $e) {
            Log::error('Discord notification exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Send order alert to Email using configured email, app password, and .env SMTP settings.
     */
    public function sendEmailNotification(Order $order, ?Configer $configer = null, ?OrderTakingSetting $settings = null): array
    {
        try {
            $configer = $configer ?: Configer::latest()->first();
            $settings = $settings ?: OrderTakingSetting::current();

            // Destination email priority: Configer email -> OrderTakingSetting email -> .env MAIL_USERNAME
            $toEmail = trim(
                $configer?->email 
                ?: ($settings->email_address ?? env('MAIL_USERNAME', ''))
            );

            if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'Invalid or empty email address provided'];
            }

            // App password priority: Configer app_password -> .env MAIL_PASSWORD
            $smtpPassword = trim(
                $configer?->app_password 
                ?: (env('MAIL_PASSWORD') ?: '')
            );

            // SMTP host, port, encryption, and username from .env / configer
            $smtpHost       = env('MAIL_HOST', 'smtp.gmail.com');
            $smtpPort       = (int) env('MAIL_PORT', 587);
            $smtpEncryption = env('MAIL_ENCRYPTION', 'tls');
            $smtpUsername   = !empty($configer?->email) ? trim($configer->email) : env('MAIL_USERNAME', $toEmail);
            $fromAddress    = !empty($configer?->email) ? trim($configer->email) : env('MAIL_FROM_ADDRESS', $toEmail);
            $fromName       = !empty($configer?->name) ? trim($configer->name) : env('MAIL_FROM_NAME', config('app.name', 'AccueVault'));

            // Dynamically apply SMTP runtime credentials
            config([
                'mail.default'                 => 'smtp',
                'mail.mailers.smtp.transport'  => 'smtp',
                'mail.mailers.smtp.host'       => $smtpHost,
                'mail.mailers.smtp.port'       => $smtpPort,
                'mail.mailers.smtp.encryption' => $smtpEncryption,
                'mail.mailers.smtp.username'   => $smtpUsername,
                'mail.mailers.smtp.password'   => $smtpPassword,
                'mail.from.address'            => $fromAddress,
                'mail.from.name'               => $fromName,
            ]);

            // Purge cached transport so Laravel re-instantiates SMTP with the dynamic credentials
            try {
                app('mail.manager')->purge('smtp');
            } catch (\Throwable $e) {
                // transport flush error safe ignore
            }

            $adminUrl = url('/admin/orders');

            $itemsHtml = '';
            foreach ($order->items as $item) {
                $itemsHtml .= "<tr>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #334155; color: #f8fafc; font-size: 13px;'>
                        <strong>" . htmlspecialchars($item->product_name) . "</strong>
                    </td>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #334155; color: #cbd5e1; font-size: 13px; text-align: center;'>
                        {$item->quantity}
                    </td>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #334155; color: #10b981; font-size: 13px; text-align: right; font-weight: bold;'>
                        $" . number_format($item->subtotal ?? $item->unit_price, 2) . "
                    </td>
                </tr>";
            }

            $notesHtml = '';
            if (!empty($order->notes)) {
                $notesHtml = "<div style='margin-top: 16px; padding: 12px; background: #0f172a; border-left: 4px solid #f59e0b; border-radius: 6px;'>
                    <strong style='color: #f59e0b; font-size: 12px; display: block; margin-bottom: 4px;'>Customer Formatting Notes:</strong>
                    <span style='color: #cbd5e1; font-size: 13px;'>" . nl2br(htmlspecialchars($order->notes)) . "</span>
                </div>";
            }

            $htmlContent = "
            <!DOCTYPE html>
            <html>
            <body style='font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Helvetica, Arial, sans-serif; background-color: #0f172a; color: #f8fafc; padding: 24px; margin: 0;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #1e293b; border: 1px solid #334155; border-radius: 14px; overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.5);'>
                    
                    <!-- Header -->
                    <div style='background: linear-gradient(135deg, #059669 0%, #10b981 100%); padding: 26px 20px; text-align: center;'>
                        <h1 style='color: #ffffff; margin: 0; font-size: 22px; font-weight: 800; letter-spacing: -0.02em;'>🛒 NEW CUSTOMER ORDER RECEIVED</h1>
                        <p style='color: #ecfdf5; margin: 6px 0 0 0; font-size: 14px; font-weight: 500;'>Order #{$order->order_number}</p>
                    </div>

                    <!-- Body -->
                    <div style='padding: 24px;'>
                        <p style='margin-top: 0; color: #cbd5e1; font-size: 14px; line-height: 1.5;'>
                            Hello Admin, a customer has completed an order on <strong>" . htmlspecialchars($fromName) . "</strong>. Complete order and customer details are provided below:
                        </p>

                        <!-- Customer Details Box -->
                        <div style='background-color: #0f172a; border: 1px solid #334155; border-radius: 10px; padding: 16px; margin-bottom: 20px;'>
                            <h3 style='margin: 0 0 12px 0; color: #10b981; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;'>👤 Customer Information</h3>
                            <table style='width: 100%; border-collapse: collapse; font-size: 13px;'>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Full Name:</td>
                                    <td style='color: #ffffff; font-weight: bold; padding: 4px 0; text-align: right;'>" . htmlspecialchars($order->customer_name) . "</td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Email Address:</td>
                                    <td style='color: #10b981; padding: 4px 0; text-align: right;'><a href='mailto:{$order->customer_email}' style='color: #10b981; text-decoration: none; font-weight: bold;'>{$order->customer_email}</a></td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Phone / WhatsApp:</td>
                                    <td style='color: #ffffff; padding: 4px 0; text-align: right;'>" . htmlspecialchars($order->customer_phone ?? 'Not provided') . "</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Payment & Total Box -->
                        <div style='background-color: #0f172a; border: 1px solid #334155; border-radius: 10px; padding: 16px; margin-bottom: 20px;'>
                            <h3 style='margin: 0 0 12px 0; color: #10b981; font-size: 13px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;'>💳 Payment & Total</h3>
                            <table style='width: 100%; border-collapse: collapse; font-size: 13px;'>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Payment Method:</td>
                                    <td style='color: #ffffff; font-weight: bold; padding: 4px 0; text-align: right;'>" . strtoupper(str_replace('_', ' ', $order->payment_method)) . "</td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Payment Status:</td>
                                    <td style='color: #ffffff; font-weight: bold; padding: 4px 0; text-align: right;'>" . ucfirst($order->payment_status) . "</td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Total Quantity:</td>
                                    <td style='color: #ffffff; font-weight: bold; padding: 4px 0; text-align: right;'>{$order->total_quantity} accounts</td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 6px 0; font-size: 14px;'>Grand Total:</td>
                                    <td style='color: #10b981; font-weight: 800; padding: 6px 0; text-align: right; font-size: 18px;'>$" . number_format($order->total_price, 2) . "</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Ordered Items Table -->
                        <h3 style='margin: 0 0 10px 0; color: #f8fafc; font-size: 13px; text-transform: uppercase; font-weight: 700;'>📋 Ordered Account Packages</h3>
                        <table style='width: 100%; border-collapse: collapse; background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; overflow: hidden; margin-bottom: 20px;'>
                            <thead>
                                <tr style='background-color: #1e293b;'>
                                    <th style='padding: 8px 12px; color: #94a3b8; font-size: 12px; text-align: left;'>Product</th>
                                    <th style='padding: 8px 12px; color: #94a3b8; font-size: 12px; text-align: center;'>Qty</th>
                                    <th style='padding: 8px 12px; color: #94a3b8; font-size: 12px; text-align: right;'>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$itemsHtml}
                            </tbody>
                        </table>

                        {$notesHtml}

                        <!-- Action Button -->
                        <div style='text-align: center; margin-top: 28px;'>
                            <a href='{$adminUrl}' style='display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 13px 30px; font-weight: bold; font-size: 14px; border-radius: 8px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);'>
                                Manage Order in Admin Panel →
                            </a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div style='background-color: #0f172a; padding: 16px; text-align: center; border-top: 1px solid #334155; color: #64748b; font-size: 11px;'>
                        AccueVault Order System • Delivered via SMTP to {$toEmail}
                    </div>
                </div>
            </body>
            </html>
            ";

            Mail::html($htmlContent, function ($msg) use ($toEmail, $fromAddress, $fromName, $order) {
                $msg->to($toEmail)
                    ->from($fromAddress, $fromName)
                    ->subject("🛒 New Order #{$order->order_number} received! ($" . number_format($order->total_price, 2) . ")");
            });

            Log::info("Order notification email successfully sent via SMTP to {$toEmail} for Order #{$order->order_number}");
            return ['success' => true, 'message' => "Order email successfully dispatched via SMTP to {$toEmail}!"];
        } catch (\Throwable $e) {
            Log::error('Email notification exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Email dispatch error: ' . $e->getMessage()];
        }
    }
}
