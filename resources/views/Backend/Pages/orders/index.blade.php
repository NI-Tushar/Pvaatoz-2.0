@extends('Backend.Layouts.master')
@section('title', 'Orders & Fulfillment Management')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .order-card {
        background-color: #1e293b;
        border: 1px solid rgba(51, 65, 85, 0.8);
        border-radius: 1.25rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    .order-table th {
        background-color: #0f172a;
        color: #94a3b8;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #334155;
    }
    .order-table td {
        padding: 1rem;
        border-bottom: 1px solid rgba(51, 65, 85, 0.5);
        color: #f8fafc;
        font-size: 0.875rem;
    }
    .order-table tr:hover td {
        background-color: rgba(30, 41, 59, 0.7);
    }
    .admin-select {
        background-color: #0f172a;
        border: 1px solid #334155;
        border-radius: 0.5rem;
        padding: 0.4rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #f8fafc;
        transition: all 0.2s ease;
    }
    .admin-select:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }
</style>
@endpush

@section('master-content')

<div class="p-4 sm:p-6 md:p-8 max-w-7xl mx-auto space-y-6"
     x-data="{
        selectedOrder: null,
        modalOpen: false,
        openModal(order) {
            this.selectedOrder = order;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
            this.selectedOrder = null;
        },
        copyToClipboard(text, msg = 'Copied to clipboard!') {
            if (!text) return;
            navigator.clipboard.writeText(text);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 2000
            });
        }
     }">

    <!-- Top Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 border border-slate-700/80 rounded-2xl p-6 shadow-xl">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl border border-emerald-500/30">
                    <i class="fa-solid fa-cart-flatbed"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white tracking-tight m-0">Orders & Fulfillment</h1>
                    <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Track, review, update statuses, and dispatch credentials for all incoming customer orders.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 self-start md:self-center">
            <a href="{{ route('admin.orders.index') }}" 
               class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700 text-xs font-bold transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-arrows-rotate"></i>
                <span>Refresh</span>
            </a>
            @if(request()->hasAny(['search', 'status', 'payment_status', 'payment_method', 'date_from', 'date_to', 'sort']))
                <a href="{{ route('admin.orders.index') }}" 
                   class="px-4 py-2.5 rounded-xl bg-rose-500/20 hover:bg-rose-500/30 text-rose-300 border border-rose-500/30 text-xs font-bold transition flex items-center gap-2">
                    <i class="fa-solid fa-xmark"></i>
                    <span>Clear Filters</span>
                </a>
            @endif
        </div>
    </div>

    <!-- KPI Metric Cards Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Orders -->
        <div class="order-card p-5 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 m-0">Total Orders</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-white mt-1 mb-0">{{ $totalOrders }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-slate-800 text-slate-300 flex items-center justify-center text-xl border border-slate-700">
                    <i class="fa-solid fa-receipt"></i>
                </div>
            </div>
            <div class="mt-3 text-[11px] text-slate-400 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                <span>All time orders logged</span>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="order-card p-5 relative overflow-hidden border-amber-500/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-400 m-0">Pending Orders</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-amber-400 mt-1 mb-0">{{ $pendingOrders }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl border border-amber-500/30">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="mt-3 text-[11px] text-amber-300/80 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Requires verification or fulfillment</span>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="order-card p-5 relative overflow-hidden border-emerald-500/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-400 m-0">Completed</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-emerald-400 mt-1 mb-0">{{ $completedOrders }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl border border-emerald-500/30">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="mt-3 text-[11px] text-emerald-300/80 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>Dispatched & finished</span>
            </div>
        </div>

        <!-- Gross Revenue -->
        <div class="order-card p-5 relative overflow-hidden border-teal-500/30">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-teal-400 m-0">Gross Revenue</p>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-white mt-1 mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-teal-500/20 text-teal-400 flex items-center justify-center text-xl border border-teal-500/30">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
            </div>
            <div class="mt-3 text-[11px] text-teal-300/80 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span>From completed & paid orders</span>
            </div>
        </div>
    </div>

    <!-- Search & Filter Controls Card -->
    <div class="order-card p-5 sm:p-6">
        <form method="GET" action="{{ route('admin.orders.index') }}" id="orders-filter-form" class="space-y-4">
            
            <!-- Search Bar & Primary Status Buttons -->
            <div class="flex flex-col lg:flex-row gap-3 items-stretch lg:items-center justify-between">
                
                <!-- Search Box -->
                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search by order number (AV-...), customer name, email, phone, or product..." 
                           class="w-full pl-11 pr-24 py-2.5 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition">
                    
                    @if(request('search'))
                        <a href="{{ route('admin.orders.index', request()->except('search', 'page')) }}" 
                           class="absolute right-16 top-1/2 -translate-y-1/2 text-xs text-slate-400 hover:text-slate-200"
                           title="Clear search">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif

                    <button type="submit" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 px-3 py-1 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-xs font-bold transition cursor-pointer">
                        Search
                    </button>
                </div>

                <!-- Sort Dropdown -->
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-xs font-bold text-slate-400 whitespace-nowrap">Sort:</span>
                    <select name="sort" 
                            onchange="document.getElementById('orders-filter-form').submit()"
                            class="admin-select cursor-pointer">
                        <option value="latest" @selected(request('sort', 'latest') == 'latest')>Newest First</option>
                        <option value="oldest" @selected(request('sort') == 'oldest')>Oldest First</option>
                        <option value="amount_desc" @selected(request('sort') == 'amount_desc')>Amount: High to Low</option>
                        <option value="amount_asc" @selected(request('sort') == 'amount_asc')>Amount: Low to High</option>
                    </select>
                </div>
            </div>

            <!-- Status Tabs & Secondary Filters Row -->
            <div class="pt-3 border-t border-slate-700/60 flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                <!-- Order Status Filter Pills -->
                <div class="flex flex-wrap items-center gap-1.5">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mr-2 flex items-center gap-1">
                        <i class="fa-solid fa-filter text-emerald-400"></i>
                        Status:
                    </span>

                    <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'all'])) }}"
                       class="px-3 py-1 rounded-lg text-xs font-bold border transition {{ !request('status') || request('status') === 'all' ? 'bg-emerald-600 text-white border-emerald-500 shadow-sm' : 'bg-slate-800 text-slate-400 border-slate-700 hover:bg-slate-700 hover:text-white' }}">
                        All ({{ $totalOrders }})
                    </a>

                    <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'pending'])) }}"
                       class="px-3 py-1 rounded-lg text-xs font-bold border transition {{ request('status') === 'pending' ? 'bg-amber-600 text-white border-amber-500 shadow-sm' : 'bg-slate-800 text-slate-400 border-slate-700 hover:bg-slate-700 hover:text-amber-300' }}">
                        Pending ({{ $pendingOrders }})
                    </a>

                    <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'processing'])) }}"
                       class="px-3 py-1 rounded-lg text-xs font-bold border transition {{ request('status') === 'processing' ? 'bg-blue-600 text-white border-blue-500 shadow-sm' : 'bg-slate-800 text-slate-400 border-slate-700 hover:bg-slate-700 hover:text-blue-300' }}">
                        Processing ({{ $processingOrders }})
                    </a>

                    <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'completed'])) }}"
                       class="px-3 py-1 rounded-lg text-xs font-bold border transition {{ request('status') === 'completed' ? 'bg-emerald-600 text-white border-emerald-500 shadow-sm' : 'bg-slate-800 text-slate-400 border-slate-700 hover:bg-slate-700 hover:text-emerald-300' }}">
                        Completed ({{ $completedOrders }})
                    </a>

                    <a href="{{ route('admin.orders.index', array_merge(request()->except('status', 'page'), ['status' => 'cancelled'])) }}"
                       class="px-3 py-1 rounded-lg text-xs font-bold border transition {{ request('status') === 'cancelled' ? 'bg-rose-600 text-white border-rose-500 shadow-sm' : 'bg-slate-800 text-slate-400 border-slate-700 hover:bg-slate-700 hover:text-rose-300' }}">
                        Cancelled ({{ $cancelledOrders }})
                    </a>
                </div>

                <!-- Payment Status Dropdown Filter -->
                <div class="flex items-center gap-2 self-start md:self-auto">
                    <span class="text-xs font-bold text-slate-400">Payment:</span>
                    <select name="payment_status" 
                            onchange="document.getElementById('orders-filter-form').submit()"
                            class="admin-select cursor-pointer">
                        <option value="all" @selected(request('payment_status', 'all') == 'all')>All Payments</option>
                        <option value="paid" @selected(request('payment_status') == 'paid')>Paid</option>
                        <option value="pending" @selected(request('payment_status') == 'pending')>Pending</option>
                        <option value="failed" @selected(request('payment_status') == 'failed')>Failed</option>
                        <option value="refunded" @selected(request('payment_status') == 'refunded')>Refunded</option>
                    </select>
                </div>

            </div>

        </form>
    </div>

    <!-- Orders Main Table Card -->
    <div class="order-card overflow-hidden">
        
        <div class="px-6 py-4 bg-slate-900/80 border-b border-slate-700 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-white m-0">Orders Table</h3>
                <span class="text-xs text-slate-400">
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} entries
                </span>
            </div>
            
            <span class="text-xs text-slate-400 font-mono">
                Auto-sorting by {{ request('sort', 'latest') }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full order-table text-left border-collapse">
                <thead>
                    <tr>
                        <th class="w-28">Order #</th>
                        <th>Customer</th>
                        <th>Items & Quantity</th>
                        <th class="w-24">Total</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th class="text-right w-36">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <!-- Order Number & Date -->
                            <td class="font-mono text-xs">
                                <span class="font-bold text-emerald-400 block cursor-pointer hover:underline"
                                      @click="openModal({{ json_encode($order) }})">
                                    {{ $order->order_number }}
                                </span>
                                <span class="text-[11px] text-slate-400 block mt-0.5" title="{{ $order->created_at->format('Y-m-d H:i:s') }}">
                                    {{ $order->created_at->diffForHumans() }}
                                </span>
                            </td>

                            <!-- Customer Info -->
                            <td>
                                <div class="font-bold text-white flex items-center gap-1.5">
                                    <span>{{ $order->customer_name }}</span>
                                    @if($order->user_id)
                                        <span class="bg-emerald-500/20 text-emerald-400 text-[10px] px-1.5 py-0.2 rounded font-mono" title="Registered User">User</span>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-400 flex items-center gap-1.5 mt-0.5">
                                    <i class="fa-regular fa-envelope text-[10px] text-slate-500"></i>
                                    <a href="mailto:{{ $order->customer_email }}" class="hover:text-emerald-400 transition truncate max-w-[180px]">
                                        {{ $order->customer_email }}
                                    </a>
                                </div>
                                @if($order->customer_phone)
                                    <div class="text-[11px] text-slate-400 flex items-center gap-1.5 mt-0.5">
                                        <i class="fa-solid fa-phone text-[10px] text-slate-500"></i>
                                        <span>{{ $order->customer_phone }}</span>
                                    </div>
                                @endif
                            </td>

                            <!-- Items Summary -->
                            <td>
                                <div class="space-y-1.5">
                                    @forelse($order->items as $item)
                                        <div class="flex items-center gap-2">
                                            @if($item->product_logo)
                                                <img src="{{ $item->product_logo }}" 
                                                     alt="{{ $item->product_name }}" 
                                                     class="w-6 h-6 rounded object-contain bg-slate-900 p-0.5 shrink-0 border border-slate-700"
                                                     onerror="this.src='{{ asset('no_image.jpg') }}'">
                                            @endif
                                            <span class="text-xs font-semibold text-slate-200 truncate max-w-[200px]" title="{{ $item->product_name }}">
                                                {{ $item->product_name }}
                                            </span>
                                            <span class="text-xs font-bold text-emerald-400 bg-slate-900/60 px-1.5 py-0.5 rounded border border-slate-700/60">
                                                ×{{ $item->quantity }}
                                            </span>
                                        </div>
                                    @empty
                                        <span class="text-xs text-slate-400">{{ $order->total_quantity }} accounts</span>
                                    @endforelse
                                </div>
                            </td>

                            <!-- Total Price -->
                            <td>
                                <span class="text-sm font-extrabold text-white block">
                                    ${{ number_format($order->total_price, 2) }}
                                </span>
                                <span class="text-[10px] text-slate-400">
                                    {{ $order->total_quantity }} total
                                </span>
                            </td>

                            <!-- Payment Method -->
                            <td>
                                <span class="text-xs font-bold text-slate-300 uppercase tracking-wider block">
                                    {{ str_replace('_', ' ', $order->payment_method) }}
                                </span>
                            </td>

                            <!-- Payment Status Badge & Quick Selector -->
                            <td>
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="m-0 inline-block">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $order->status }}">
                                    <select name="payment_status" 
                                            onchange="this.form.submit()"
                                            class="admin-select text-[11px] font-bold cursor-pointer rounded-lg px-2.5 py-1 {{ $order->payment_status === 'paid' ? '!bg-emerald-950 !text-emerald-300 !border-emerald-600' : '!bg-amber-950 !text-amber-300 !border-amber-600' }}">
                                        <option value="pending" @selected($order->payment_status == 'pending')>⏳ Pending</option>
                                        <option value="paid" @selected($order->payment_status == 'paid')>✅ Paid</option>
                                        <option value="failed" @selected($order->payment_status == 'failed')>❌ Failed</option>
                                        <option value="refunded" @selected($order->payment_status == 'refunded')>↩️ Refunded</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Order Status Dropdown / Quick Changer -->
                            <td>
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="m-0 inline-block">
                                    @csrf
                                    <input type="hidden" name="payment_status" value="{{ $order->payment_status }}">
                                    <select name="status" 
                                            onchange="this.form.submit()"
                                            class="admin-select text-[11px] font-bold cursor-pointer rounded-lg px-2.5 py-1 {{ $order->status === 'completed' ? '!bg-emerald-950 !text-emerald-300 !border-emerald-600' : ($order->status === 'processing' ? '!bg-blue-950 !text-blue-300 !border-blue-600' : ($order->status === 'cancelled' ? '!bg-rose-950 !text-rose-300 !border-rose-600' : '!bg-amber-950 !text-amber-300 !border-amber-600')) }}">
                                        <option value="pending" @selected($order->status == 'pending')>⏳ Pending</option>
                                        <option value="processing" @selected($order->status == 'processing')>⚙️ Processing</option>
                                        <option value="completed" @selected($order->status == 'completed')>✅ Completed</option>
                                        <option value="cancelled" @selected($order->status == 'cancelled')>🚫 Cancelled</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- View & Dispatch Modal Trigger -->
                                    <button type="button" 
                                            @click="openModal({{ json_encode($order) }})"
                                            class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 hover:bg-emerald-500/30 transition flex items-center justify-center text-xs"
                                            title="View Order Details & Dispatch Credentials">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete Order #{{ $order->order_number }}?');" 
                                          class="m-0 inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-8 h-8 rounded-lg bg-rose-500/20 text-rose-400 hover:bg-rose-500/30 transition flex items-center justify-center text-xs"
                                                title="Delete Order">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-12">
                                <div class="w-16 h-16 rounded-2xl bg-slate-800 text-slate-500 flex items-center justify-center mx-auto mb-3 text-2xl border border-slate-700">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <h4 class="text-base font-bold text-white mb-1">No Orders Found</h4>
                                <p class="text-xs text-slate-400 max-w-sm mx-auto">
                                    No customer orders match the current search or filter criteria. Place an order on checkout or reset filters above.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($orders->hasPages())
            <div class="p-4 bg-slate-900/60 border-t border-slate-700 flex justify-center">
                {{ $orders->links('vendor.pagination.tailwind') }}
            </div>
        @endif

    </div>

    <!-- ================= FULL ORDER DETAILS & DISPATCH MODAL ================= -->
    <div x-show="modalOpen" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        
        <div @click.away="closeModal()" 
             class="bg-slate-900 border border-slate-700 rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl p-6 sm:p-7 space-y-6 text-slate-100">
            
            <template x-if="selectedOrder">
                <div>
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-lg border border-emerald-500/30">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white m-0 flex items-center gap-2">
                                    <span>Order Details:</span>
                                    <span class="font-mono text-emerald-400" x-text="selectedOrder.order_number"></span>
                                </h3>
                                <span class="text-xs text-slate-400">Placed on <span x-text="new Date(selectedOrder.created_at).toLocaleString()"></span></span>
                            </div>
                        </div>

                        <button type="button" 
                                @click="closeModal()" 
                                class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    <!-- Customer & Order Meta Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-4 p-4 rounded-2xl bg-slate-800/60 border border-slate-700/80">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Customer Info</span>
                            <p class="font-bold text-white text-sm m-0" x-text="selectedOrder.customer_name"></p>
                            <p class="text-xs text-emerald-400 font-mono m-0 mt-0.5" x-text="selectedOrder.customer_email"></p>
                            <p class="text-xs text-slate-300 font-mono m-0 mt-0.5" x-text="selectedOrder.customer_phone || 'No phone provided'"></p>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Payment & Financials</span>
                            <p class="text-xs text-slate-300 m-0">Method: <strong class="text-white uppercase font-mono" x-text="selectedOrder.payment_method"></strong></p>
                            <p class="text-xs text-slate-300 m-0 mt-0.5">Total Amount: <strong class="text-emerald-400 text-sm font-mono">$<span x-text="selectedOrder.total_price"></span></strong></p>
                            <p class="text-xs text-slate-300 m-0 mt-0.5">Quantity: <strong class="text-white font-mono" x-text="selectedOrder.total_quantity"></strong> accounts</p>
                        </div>
                    </div>

                    <!-- Customer Notes if any -->
                    <template x-if="selectedOrder.notes">
                        <div class="mb-4 p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-200 text-xs">
                            <strong class="block text-amber-400 font-bold mb-0.5">Customer Formatting Notes:</strong>
                            <span x-text="selectedOrder.notes"></span>
                        </div>
                    </template>

                    <!-- Itemized Order Products -->
                    <div class="space-y-2 mb-6">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Ordered Products</span>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            <template x-for="item in selectedOrder.items" :key="item.id">
                                <div class="p-3 bg-slate-800/80 border border-slate-700 rounded-xl flex items-center justify-between gap-3 text-xs">
                                    <div class="flex items-center gap-2.5">
                                        <template x-if="item.product_logo">
                                            <img :src="item.product_logo" class="w-8 h-8 rounded object-contain bg-slate-900 p-1 border border-slate-700">
                                        </template>
                                        <div>
                                            <span class="font-bold text-white block text-sm" x-text="item.product_name"></span>
                                            <span class="text-slate-400 text-[11px]" x-text="item.category"></span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-mono font-bold text-emerald-400 block" x-text="`$${item.subtotal || item.unit_price}`"></span>
                                        <span class="text-slate-400 font-mono text-[11px]" x-text="`Qty: ${item.quantity}`"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Status Changer & Dispatch Update Form -->
                    <form :action="`/admin/orders/${selectedOrder.id}/status`" method="POST" class="space-y-4 pt-4 border-t border-slate-800">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Order Status</label>
                                <select name="status" x-model="selectedOrder.status" class="w-full admin-select text-xs font-bold py-2">
                                    <option value="pending">⏳ Pending Verification</option>
                                    <option value="processing">⚙️ Processing / Preparing Accounts</option>
                                    <option value="completed">✅ Completed / Dispatched</option>
                                    <option value="cancelled">🚫 Cancelled / Order Void</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Payment Status</label>
                                <select name="payment_status" x-model="selectedOrder.payment_status" class="w-full admin-select text-xs font-bold py-2">
                                    <option value="pending">⏳ Pending Payment</option>
                                    <option value="paid">✅ Paid & Confirmed</option>
                                    <option value="failed">❌ Payment Failed</option>
                                    <option value="refunded">↩️ Refunded</option>
                                </select>
                            </div>
                        </div>

                        <!-- Credentials / Delivery Dispatch Field -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold text-slate-300 uppercase tracking-wider m-0 flex items-center gap-1.5">
                                    <i class="fa-solid fa-key text-emerald-400"></i>
                                    Delivery Credentials / Login Files / Links
                                </label>
                                <button type="button" 
                                        @click="copyToClipboard(selectedOrder.delivery_credentials, 'Credentials copied!')"
                                        class="text-xs text-emerald-400 hover:text-emerald-300 font-semibold cursor-pointer">
                                    <i class="fa-regular fa-copy"></i> Copy
                                </button>
                            </div>
                            <textarea name="delivery_credentials" 
                                      rows="3" 
                                      x-model="selectedOrder.delivery_credentials"
                                      placeholder="Paste exported CSV link, credentials, recovery email, or accounts access format here..." 
                                      class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 text-xs font-mono focus:outline-none focus:ring-2 focus:ring-emerald-500/50"></textarea>
                            <span class="text-[11px] text-slate-400 mt-1 block">Credentials stored here can be viewed by customers in their account portal.</span>
                        </div>

                        <!-- Internal Admin Notes -->
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Internal Admin Notes</label>
                            <input type="text" 
                                   name="admin_notes" 
                                   x-model="selectedOrder.admin_notes"
                                   placeholder="Private internal note for staff..." 
                                   class="w-full p-2.5 bg-slate-950 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
                        </div>

                        <!-- Save Actions -->
                        <div class="flex items-center justify-end gap-3 pt-3">
                            <button type="button" 
                                    @click="closeModal()" 
                                    class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold transition">
                                Close
                            </button>
                            <button type="submit" 
                                    class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md shadow-emerald-600/30 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </template>

        </div>
    </div>

</div>

@endsection
