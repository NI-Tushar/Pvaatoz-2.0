<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders with search, filters, KPIs, and pagination.
     */
    public function index(Request $request)
    {
        // 1. KPI Counts
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $totalRevenue = Order::whereIn('status', ['completed', 'processing'])
            ->orWhere('payment_status', 'paid')
            ->sum('total_price');

        // 2. Base Query with Relations
        $query = Order::with(['items', 'user']);

        // Search Filter
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Order Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Payment Status Filter
        if ($request->filled('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        // Payment Method Filter
        if ($request->filled('payment_method') && $request->payment_method !== 'all') {
            $query->where('payment_method', $request->payment_method);
        }

        // Date Filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'oldest' => $query->oldest(),
            'amount_desc' => $query->orderBy('total_price', 'desc'),
            'amount_asc' => $query->orderBy('total_price', 'asc'),
            default => $query->latest(),
        };

        // Paginate results
        $orders = $query->paginate(15)->withQueryString();

        return view('Backend.Pages.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'cancelledOrders',
            'totalRevenue'
        ));
    }

    /**
     * Get single order details (JSON for modal or view).
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'order' => $order,
            ]);
        }

        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }

    /**
     * Update order status, payment status, credentials, and admin notes.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
            'delivery_credentials' => 'nullable|string',
            'admin_notes' => 'nullable|string',
        ]);

        $order->status = $validated['status'];

        if (!empty($validated['payment_status'])) {
            $order->payment_status = $validated['payment_status'];
        }

        if ($request->has('delivery_credentials')) {
            $order->delivery_credentials = $validated['delivery_credentials'] ?? null;
        }

        if ($request->has('admin_notes')) {
            $order->admin_notes = $validated['admin_notes'] ?? null;
        }

        $order->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order #' . $order->order_number . ' status updated successfully.',
                'order' => $order->fresh(['items']),
            ]);
        }

        return redirect()->back()->with('success', 'Order #' . $order->order_number . ' updated successfully.');
    }

    /**
     * Delete an order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $orderNum = $order->order_number;
        $order->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order #' . $orderNum . ' has been deleted successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Order #' . $orderNum . ' deleted successfully.');
    }
}
