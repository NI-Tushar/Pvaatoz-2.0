<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the payment methods with tabbed forms.
     */
    public function index()
    {
        PaymentMethod::seedDefaults();
        $methods = PaymentMethod::orderBy('sort_order', 'asc')->get();
        return view('Backend.Pages.payment_methods', compact('methods'));
    }

    /**
     * Update payment method credentials and settings.
     */
    public function update(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'wallet_address' => 'nullable|string|max:255',
            'api_key' => 'nullable|string|max:500',
            'api_secret' => 'nullable|string|max:500',
            'merchant_id' => 'nullable|string|max:255',
            'ipn_secret' => 'nullable|string|max:255',
            'instructions' => 'nullable|string',
            'exchange_rate' => 'nullable|numeric|min:0',
            'is_enabled' => 'nullable|boolean',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'wallet_address' => $validated['wallet_address'] ?? null,
            'api_key' => $validated['api_key'] ?? null,
            'api_secret' => $validated['api_secret'] ?? null,
            'merchant_id' => $validated['merchant_id'] ?? null,
            'ipn_secret' => $validated['ipn_secret'] ?? null,
            'instructions' => $validated['instructions'] ?? null,
            'exchange_rate' => $validated['exchange_rate'] ?? null,
            'is_enabled' => $request->has('is_enabled') ? (bool) $request->input('is_enabled') : false,
        ];

        // Handle QR Code image upload
        if ($request->hasFile('qr_code')) {
            // Delete old qr code if exists
            if ($method->qr_code && Storage::disk('public')->exists($method->qr_code)) {
                Storage::disk('public')->delete($method->qr_code);
            }
            $qrPath = $request->file('qr_code')->store('payment_qr', 'public');
            $updateData['qr_code'] = $qrPath;
        }

        // Delete QR code request
        if ($request->boolean('remove_qr_code')) {
            if ($method->qr_code && Storage::disk('public')->exists($method->qr_code)) {
                Storage::disk('public')->delete($method->qr_code);
            }
            $updateData['qr_code'] = null;
        }

        $method->update($updateData);

        return redirect()->route('admin.payment-methods.index', ['active' => $method->slug])
            ->with('success', "{$method->name} credentials and settings saved successfully!");
    }

    /**
     * Quick toggle enabled/disabled status.
     */
    public function toggleStatus(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->is_enabled = !$method->is_enabled;
        $method->save();

        $statusText = $method->is_enabled ? 'enabled and active on checkout' : 'disabled and hidden from checkout';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_enabled' => $method->is_enabled,
                'message' => "{$method->name} is now {$statusText}."
            ]);
        }

        return redirect()->route('admin.payment-methods.index', ['active' => $method->slug])
            ->with('success', "{$method->name} is now {$statusText}.");
    }
}
