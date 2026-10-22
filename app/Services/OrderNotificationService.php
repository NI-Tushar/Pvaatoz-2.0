<?php

namespace App\Services;

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
        $settings = OrderTakingSetting::current();
        $results = [
            'telegram' => ['success' => false, 'message' => 'Disabled or not configured'],
            'discord' => ['success' => false, 'message' => 'Disabled or not configured'],
            'email' => ['success' => false, 'message' => 'Disabled or not configured'],
        ];

        // Ensure order relations are loaded
        if (!$order->relationLoaded('items')) {
            $order->load('items');
        }

        // 1. Telegram Dispatch
        if ($settings->is_telegram_enabled) {
            $results['telegram'] = $this->sendTelegramNotification($order, $settings);
        }

        // 2. Discord Dispatch
        if ($settings->is_discord_enabled) {
            $results['discord'] = $this->sendDiscordNotification($order, $settings);
        }

        // 3. Email Dispatch
        if ($settings->is_email_enabled && !empty($settings->email_address)) {
            $results['email'] = $this->sendEmailNotification($order, $settings);
        }

        return $results;
    }

    /**
     * Send order alert to Telegram.
     */
    public function sendTelegramNotification(Order $order, OrderTakingSetting $settings): array
    {
        try {
            $adminUrl = url('/admin/orders');
            $itemsList = '';
            foreach ($order->items as $item) {
                $itemsList .= "  • <b>" . htmlspecialchars($item->product_name) . "</b> × {$item->quantity} ($" . number_format($item->subtotal ?? $item->unit_price, 2) . ")\n";
            }
            if (empty($itemsList)) {
                $itemsList = "  • {$order->total_quantity} accounts ($" . number_format($order->total_price, 2) . ")\n";
            }

            $message = "🛒 <b>NEW ORDER RECEIVED!</b>\n";
            $message .= "━━━━━━━━━━━━━━━━━━━━━━\n";
            $message .= "📦 <b>Order Number:</b> <code>#{$order->order_number}</code>\n";
            $message .= "👤 <b>Customer:</b> " . htmlspecialchars($order->customer_name) . "\n";
            $message .= "📧 <b>Email:</b> " . htmlspecialchars($order->customer_email) . "\n";
            $message .= "📱 <b>Phone:</b> " . htmlspecialchars($order->customer_phone ?? 'Not provided') . "\n";
            $message .= "💳 <b>Payment Option:</b> " . strtoupper(str_replace('_', ' ', $order->payment_method)) . " (" . ucfirst($order->payment_status) . ")\n";
            $message .= "💰 <b>Total Amount:</b> <b>$" . number_format($order->total_price, 2) . "</b> ({$order->total_quantity} items)\n\n";
            $message .= "📋 <b>Ordered Product Details:</b>\n" . $itemsList . "\n";

            if (!empty($order->notes)) {
                $message .= "📝 <b>Customer Notes:</b> " . htmlspecialchars($order->notes) . "\n\n";
            }

            $message .= "🎯 <b>Order Taking Handler:</b> {$settings->telegram_address}\n";
            $message .= "🔗 <a href=\"{$adminUrl}\">Open Admin Orders Panel</a>";

            // If Bot Token and Chat ID are configured, send via Telegram Bot API
            if (!empty($settings->telegram_bot_token) && !empty($settings->telegram_chat_id)) {
                $response = Http::timeout(6)->post("https://api.telegram.org/bot{$settings->telegram_bot_token}/sendMessage", [
                    'chat_id' => $settings->telegram_chat_id,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => false,
                ]);

                if ($response->successful()) {
                    return ['success' => true, 'message' => "Dispatched to Telegram chat ID {$settings->telegram_chat_id} (Target: {$settings->telegram_address})"];
                } else {
                    Log::warning('Telegram notification failed: ' . $response->body());
                    return ['success' => false, 'message' => 'Telegram API error: ' . $response->json('description', 'Unknown error')];
                }
            } else {
                Log::info("Telegram order alert logged for handler {$settings->telegram_address} (Order #{$order->order_number}). Bot token or chat ID not set yet.");
                return ['success' => true, 'message' => "Telegram address saved as {$settings->telegram_address}. To activate instant bot delivery, provide Bot Token & Chat ID."];
            }
        } catch (\Throwable $e) {
            Log::error('Telegram notification exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Send order alert to Discord via Webhook.
     */
    public function sendDiscordNotification(Order $order, OrderTakingSetting $settings): array
    {
        try {
            $adminUrl = url('/admin/orders');
            $itemsLines = [];
            foreach ($order->items as $item) {
                $itemsLines[] = "• **" . $item->product_name . "** × {$item->quantity} ($" . number_format($item->subtotal ?? $item->unit_price, 2) . ")";
            }
            if (empty($itemsLines)) {
                $itemsLines[] = "• {$order->total_quantity} accounts ($" . number_format($order->total_price, 2) . ")";
            }

            $embed = [
                'title' => "🛒 New Order Placed: #{$order->order_number}",
                'url' => $adminUrl,
                'color' => 0x10B981, // Emerald Green
                'description' => "A customer has placed an order on **AccueVault**.\n**Assigned Handler:** `{$settings->discord_address}`",
                'fields' => [
                    [
                        'name' => '👤 Customer Information',
                        'value' => "**Name:** {$order->customer_name}\n**Email:** {$order->customer_email}\n**Phone:** " . ($order->customer_phone ?: 'Not provided'),
                        'inline' => true,
                    ],
                    [
                        'name' => '💳 Payment Details',
                        'value' => "**Method:** " . strtoupper(str_replace('_', ' ', $order->payment_method)) . "\n**Status:** " . ucfirst($order->payment_status) . "\n**Total:** $" . number_format($order->total_price, 2),
                        'inline' => true,
                    ],
                    [
                        'name' => '📋 Ordered Product Details',
                        'value' => implode("\n", array_slice($itemsLines, 0, 10)),
                        'inline' => false,
                    ],
                ],
                'footer' => [
                    'text' => 'AccueVault Order Taking System • Discord Handler: ' . $settings->discord_address,
                ],
                'timestamp' => now()->toISOString(),
            ];

            if (!empty($order->notes)) {
                $embed['fields'][] = [
                    'name' => '📝 Customer Notes',
                    'value' => $order->notes,
                    'inline' => false,
                ];
            }

            if (!empty($settings->discord_webhook_url)) {
                $response = Http::timeout(6)->post($settings->discord_webhook_url, [
                    'username' => 'AccueVault Order Taking',
                    'content' => "🚨 **New Order Alert!** Attention: `{$settings->discord_address}`",
                    'embeds' => [$embed],
                ]);

                if ($response->successful()) {
                    return ['success' => true, 'message' => "Dispatched to Discord Webhook successfully! (Target: {$settings->discord_address})"];
                } else {
                    Log::warning('Discord Webhook failed: ' . $response->body());
                    return ['success' => false, 'message' => 'Discord Webhook error (HTTP ' . $response->status() . ')'];
                }
            } else {
                Log::info("Discord order alert logged for handler {$settings->discord_address} (Order #{$order->order_number}). Webhook URL not set yet.");
                return ['success' => true, 'message' => "Discord handle configured as {$settings->discord_address}. To receive automated embeds, add a Discord Webhook URL."];
            }
        } catch (\Throwable $e) {
            Log::error('Discord notification exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Send order alert to Email.
     */
    public function sendEmailNotification(Order $order, OrderTakingSetting $settings): array
    {
        try {
            $adminUrl = url('/admin/orders');
            $toEmail = trim($settings->email_address);

            if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'Invalid email address provided'];
            }

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
            <body style='font-family: Arial, sans-serif; background-color: #0f172a; color: #f8fafc; padding: 20px; margin: 0;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.4);'>
                    
                    <!-- Header -->
                    <div style='background: linear-gradient(135deg, #059669 0%, #10b981 100%); padding: 24px; text-align: center;'>
                        <h1 style='color: #ffffff; margin: 0; font-size: 22px; font-weight: 800;'>🛒 NEW ORDER RECEIVED</h1>
                        <p style='color: #ecfdf5; margin: 6px 0 0 0; font-size: 14px;'>Order #{$order->order_number}</p>
                    </div>

                    <!-- Body -->
                    <div style='padding: 24px;'>
                        <p style='margin-top: 0; color: #cbd5e1; font-size: 14px;'>
                            Hello Admin, a new customer has completed checkout on AccueVault. Order details are listed below:
                        </p>

                        <!-- Customer Details Box -->
                        <div style='background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 16px; margin-bottom: 20px;'>
                            <h3 style='margin: 0 0 10px 0; color: #10b981; font-size: 14px; text-transform: uppercase;'>👤 Customer Details</h3>
                            <table style='width: 100%; border-collapse: collapse; font-size: 13px;'>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Full Name:</td>
                                    <td style='color: #ffffff; font-weight: bold; padding: 4px 0; text-align: right;'>" . htmlspecialchars($order->customer_name) . "</td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Email Address:</td>
                                    <td style='color: #10b981; padding: 4px 0; text-align: right;'><a href='mailto:{$order->customer_email}' style='color: #10b981; text-decoration: none;'>{$order->customer_email}</a></td>
                                </tr>
                                <tr>
                                    <td style='color: #94a3b8; padding: 4px 0;'>Phone Number:</td>
                                    <td style='color: #ffffff; padding: 4px 0; text-align: right;'>" . htmlspecialchars($order->customer_phone ?? 'Not provided') . "</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Financials Box -->
                        <div style='background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 16px; margin-bottom: 20px;'>
                            <h3 style='margin: 0 0 10px 0; color: #10b981; font-size: 14px; text-transform: uppercase;'>💳 Payment & Total</h3>
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
                                    <td style='color: #94a3b8; padding: 6px 0; font-size: 15px;'>Grand Total:</td>
                                    <td style='color: #10b981; font-weight: 800; padding: 6px 0; text-align: right; font-size: 17px;'>$" . number_format($order->total_price, 2) . "</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Ordered Items Table -->
                        <h3 style='margin: 0 0 10px 0; color: #f8fafc; font-size: 14px; text-transform: uppercase;'>📋 Ordered Items</h3>
                        <table style='width: 100%; border-collapse: collapse; background-color: #0f172a; border: 1px solid #334155; border-radius: 8px; overflow: hidden;'>
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
                            <a href='{$adminUrl}' style='display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 12px 28px; font-weight: bold; font-size: 14px; border-radius: 8px;'>
                                Manage Order in Admin Panel →
                            </a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div style='background-color: #0f172a; padding: 16px; text-align: center; border-top: 1px solid #334155; color: #64748b; font-size: 11px;'>
                        AccueVault Order Taking System • Sent to {$toEmail}
                    </div>
                </div>
            </body>
            </html>
            ";

            Mail::html($htmlContent, function ($msg) use ($toEmail, $order) {
                $msg->to($toEmail)
                    ->subject("🛒 New Order #{$order->order_number} received! ($" . number_format($order->total_price, 2) . ")");
            });

            return ['success' => true, 'message' => "Order email successfully dispatched to {$toEmail}!"];
        } catch (\Throwable $e) {
            Log::error('Email notification exception: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Email dispatch error: ' . $e->getMessage()];
        }
    }
}
