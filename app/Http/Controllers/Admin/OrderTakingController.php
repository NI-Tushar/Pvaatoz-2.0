<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTakingSetting;
use App\Services\OrderNotificationService;
use Illuminate\Http\Request;

class OrderTakingController extends Controller
{
    /**
     * Display the Order Taking configuration page.
     */
    public function index()
    {
        $settings = OrderTakingSetting::current();
        return view('Backend.Pages.OrderTaking.index', compact('settings'));
    }

    /**
     * Update the Order Taking configuration.
     */
    public function update(Request $request)
    {
        $request->validate([
            'telegram_address' => ['required', 'string', 'max:255'],
            'telegram_bot_token' => ['nullable', 'string', 'max:255'],
            'telegram_chat_id' => ['nullable', 'string', 'max:255'],
            'discord_address' => ['required', 'string', 'max:255'],
            'discord_webhook_url' => ['nullable', 'string', 'url'],
            'email_address' => ['required', 'string', 'email', 'max:255'],
        ]);

        $settings = OrderTakingSetting::current();
        $settings->update([
            'telegram_address' => trim($request->telegram_address),
            'telegram_bot_token' => trim($request->telegram_bot_token ?? ''),
            'telegram_chat_id' => trim($request->telegram_chat_id ?? ''),
            'is_telegram_enabled' => $request->boolean('is_telegram_enabled'),

            'discord_address' => trim($request->discord_address),
            'discord_webhook_url' => trim($request->discord_webhook_url ?? ''),
            'is_discord_enabled' => $request->boolean('is_discord_enabled'),

            'email_address' => trim($request->email_address),
            'is_email_enabled' => $request->boolean('is_email_enabled'),
        ]);

        return redirect()->route('admin.order-taking.index')->with('success', 'Order Taking configuration saved successfully!');
    }

    /**
     * Send test alert across configured channels.
     */
    public function test(Request $request, OrderNotificationService $notificationService)
    {
        $channel = $request->input('channel', 'all');

        // Create in-memory mock order for testing
        $mockOrder = new Order([
            'order_number' => 'TEST-' . strtoupper(substr(uniqid(), -6)),
            'customer_name' => 'Demo Customer',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '+1 (555) 019-2834',
            'payment_method' => 'usdt_trc20',
            'payment_status' => 'paid',
            'total_quantity' => 2,
            'total_price' => 19.98,
            'notes' => 'This is a test notification from the Order Taking settings panel.',
            'created_at' => now(),
        ]);
        $mockOrder->id = 999999;

        $item1 = new OrderItem([
            'product_name' => 'Gmail PVA Accounts (Aged)',
            'quantity' => 1,
            'unit_price' => 9.99,
            'subtotal' => 9.99,
        ]);
        $item2 = new OrderItem([
            'product_name' => 'Discord Nitro (1 Year)',
            'quantity' => 1,
            'unit_price' => 9.99,
            'subtotal' => 9.99,
        ]);
        $mockOrder->setRelation('items', collect([$item1, $item2]));

        $settings = OrderTakingSetting::current();

        $results = [];
        if ($channel === 'all' || $channel === 'telegram') {
            $results['telegram'] = $notificationService->sendTelegramNotification($mockOrder, $settings);
        }
        if ($channel === 'all' || $channel === 'discord') {
            $results['discord'] = $notificationService->sendDiscordNotification($mockOrder, $settings);
        }
        if ($channel === 'all' || $channel === 'email') {
            $results['email'] = $notificationService->sendEmailNotification($mockOrder, $settings);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'results' => $results,
            ]);
        }

        return redirect()->back()->with('test_results', $results);
    }
}
