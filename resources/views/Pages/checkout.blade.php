@extends('layouts.app')
@section('title', 'Checkout - ' . ($product->product_name ?? 'Order') . ' | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .light-detail-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.95);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .light-detail-card:hover {
        border-color: rgba(16, 185, 129, 0.35);
    }
</style>
@endpush

@section('app-content')

@php
    $brandColor = !empty($product->product_color) ? $product->product_color : '#10b981';
    $bgColor1 = !empty($product->bg_color_1) ? $product->bg_color_1 : '#064e3b';
    $bgColor2 = !empty($product->bg_color_2) ? $product->bg_color_2 : '#022c22';

    $contactEmail = $configer?->email ?? 'support@accuevault.com';
    $rawPhone = preg_replace('/[^0-9]/', '', $configer?->phone ?? '15550192834');
    if (empty($rawPhone)) {
        $rawPhone = '15550192834';
    }

    $initialDbItems = [];
    if (isset($dbCartItems) && $dbCartItems->isNotEmpty()) {
        foreach ($dbCartItems as $c) {
            $initialDbItems[] = [
                'product_id' => $c->product_id,
                'product_name' => $c->product->product_name ?? 'PVA Account',
                'category' => $c->product->category ?? 'Account',
                'tag' => $c->product->tag ?? '100% PVA',
                'product_logo' => $c->product->product_logo ? asset('storage/' . $c->product->product_logo) : asset('no_image.jpg'),
                'bg_color_1' => $c->product->bg_color_1 ?? '#064e3b',
                'bg_color_2' => $c->product->bg_color_2 ?? '#022c22',
                'product_color' => $c->product->product_color ?? '#10b981',
                'quantity' => (int) $c->quantity,
                'unit_price' => (float) ($c->unit_price ?: 0.85),
            ];
        }
    }
@endphp

<div class="bg-slate-50 text-slate-800 antialiased min-h-screen pt-28 pb-20 font-['Inter',sans-serif]"
     x-data="{
        mode: '{{ count($initialDbItems) > 0 ? 'cart' : 'single' }}',
        cartItems: {{ json_encode($initialDbItems) }},
        singleProduct: {
            id: {{ $product->id }},
            product_name: '{{ addslashes($product->product_name) }}',
            category: '{{ addslashes($product->category) }}',
            tag: '{{ addslashes($product->tag ?? '100% PVA') }}',
            product_logo: '{{ $product->product_logo ? asset('storage/' . $product->product_logo) : asset('no_image.jpg') }}',
            bg_color_1: '{{ $product->bg_color_1 ?? '#064e3b' }}',
            bg_color_2: '{{ $product->bg_color_2 ?? '#022c22' }}',
            product_color: '{{ $product->product_color ?? '#10b981' }}',
            unit_price: 0.85
        },
@php
    $enabledPaymentMethods = $paymentMethods ?? \App\Models\PaymentMethod::where('is_enabled', true)->orderBy('sort_order', 'asc')->get();
    $defaultPaymentSlug = $enabledPaymentMethods->first()?->slug ?? 'usdt_trc20';

    $authUser = auth()->guard('admin')->check() 
        ? auth()->guard('admin')->user() 
        : (auth()->check() ? auth()->user() : null);

    $defaultName = old('name', $authUser?->name ?? '');
    $defaultEmail = old('email', $authUser?->email ?? '');
    $defaultPhone = old('phone', $authUser?->phone ?? '');
@endphp

        qty: 10,
        unitPrice: 0.85,
        paymentMethod: '{{ $defaultPaymentSlug }}',
        copiedWallet: false,
        copyAddress(addr) {
            if (!addr) return;
            navigator.clipboard.writeText(addr);
            this.copiedWallet = true;
            setTimeout(() => { this.copiedWallet = false; }, 2000);
        },
        name: @js($defaultName),
        email: @js($defaultEmail),
        phone: @js($defaultPhone),

        init() {
            // Check if client has local items and DB was empty
            if (this.cartItems.length === 0 && window.AccueCart) {
                const local = window.AccueCart.getLocalItems();
                if (local && local.length > 0) {
                    this.cartItems = local;
                    this.mode = 'cart';
                }
            }

            // If query ?mode=single or direct product passed, respect that
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('mode') === 'single') {
                this.mode = 'single';
            }
        },

        // Single product calculations
        get singleDiscountRate() {
            if (this.qty >= 100) return 0.25;
            if (this.qty >= 50) return 0.15;
            if (this.qty >= 25) return 0.10;
            return 0;
        },
        get singleSubtotal() {
            return (this.qty * this.unitPrice).toFixed(2);
        },
        get singleDiscountAmount() {
            return (this.qty * this.unitPrice * this.singleDiscountRate).toFixed(2);
        },
        get singleTotal() {
            return (this.qty * this.unitPrice * (1 - this.singleDiscountRate)).toFixed(2);
        },
        get singleDiscountLabel() {
            if (this.qty >= 100) return '25% OFF Bulk Tier';
            if (this.qty >= 50) return '15% OFF Volume Tier';
            if (this.qty >= 25) return '10% OFF Tier Discount';
            return 'Standard Price';
        },

        // Cart calculations
        getItemCalculation(item) {
            const q = parseInt(item.quantity) || 1;
            const p = parseFloat(item.unit_price) || 0.85;
            let disc = 0;
            if (q >= 100) disc = 0.25;
            else if (q >= 50) disc = 0.15;
            else if (q >= 25) disc = 0.10;

            const sub = q * p;
            const discAmt = sub * disc;
            const tot = sub - discAmt;
            return {
                qty: q,
                unitPrice: p,
                subtotal: sub.toFixed(2),
                discountRate: disc,
                discountLabel: disc > 0 ? (disc * 100) + '% OFF' : '',
                discountAmount: discAmt.toFixed(2),
                total: tot.toFixed(2)
            };
        },
        get cartTotals() {
            let totalQty = 0;
            let subtotal = 0;
            let totalDiscount = 0;
            this.cartItems.forEach(item => {
                const c = this.getItemCalculation(item);
                totalQty += c.qty;
                subtotal += parseFloat(c.subtotal);
                totalDiscount += parseFloat(c.discountAmount);
            });
            const grandTotal = subtotal - totalDiscount;
            return {
                totalQty,
                itemCount: this.cartItems.length,
                subtotal: subtotal.toFixed(2),
                totalDiscount: totalDiscount.toFixed(2),
                grandTotal: grandTotal.toFixed(2)
            };
        },

        updateCartItemQty(productId, newQty) {
            if (newQty <= 0) {
                this.removeCartItem(productId);
                return;
            }
            const item = this.cartItems.find(i => parseInt(i.product_id) === parseInt(productId));
            if (item) {
                item.quantity = newQty;
            }
            if (window.AccueCart) {
                window.AccueCart.updateQty(productId, newQty);
            }
        },

        removeCartItem(productId) {
            this.cartItems = this.cartItems.filter(i => parseInt(i.product_id) !== parseInt(productId));
            if (window.AccueCart) {
                window.AccueCart.remove(productId);
            }
            if (this.cartItems.length === 0) {
                this.mode = 'single';
            }
        },

        get currentFinalTotal() {
            return this.mode === 'cart' ? this.cartTotals.grandTotal : this.singleTotal;
        },

        get currentFinalQty() {
            return this.mode === 'cart' ? this.cartTotals.totalQty : this.qty;
        },

        get currentOrderSummaryDescription() {
            if (this.mode === 'cart') {
                return `${this.cartItems.length} Products (${this.cartTotals.totalQty} accounts)`;
            }
            return `${this.qty}x {{ $product->product_name }}`;
        },

        get whatsappOrderUrl() {
            const msg = `Hello, I would like to order ${this.currentOrderSummaryDescription} for $${this.currentFinalTotal} via ${this.paymentMethod}. Name: ${this.name || 'N/A'}, Email: ${this.email || 'N/A'}`;
            return 'https://wa.me/{{ $rawPhone }}?text=' + encodeURIComponent(msg);
        },

        get mailtoOrderUrl() {
            const subj = encodeURIComponent('Order Request: ' + this.currentOrderSummaryDescription);
            const body = encodeURIComponent(`Hello,\n\nI want to order: ${this.currentOrderSummaryDescription}\nTotal: $${this.currentFinalTotal}\nPayment Method: ${this.paymentMethod}\nCustomer: ${this.name}\nEmail: ${this.email}\nPhone: ${this.phone}\n\nPlease proceed with credentials.`);
            return 'mailto:{{ $contactEmail }}?subject=' + subj + '&body=' + body;
        }
     }">

    <!-- Ambient Glow Effect -->
    <div class="relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-b from-emerald-100/60 via-emerald-50/20 to-transparent pointer-events-none rounded-full blur-3xl -z-10"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8 overflow-x-auto whitespace-nowrap py-1">
            <a href="{{ route('home') }}" class="hover:text-emerald-600 transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-house text-xs"></i>
                <span>Home</span>
            </a>
            <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
            <a href="{{ route('home') }}#about" class="hover:text-emerald-600 transition-colors">
                Our Products
            </a>
            <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
            <span class="text-emerald-600 font-semibold">
                Checkout
            </span>
        </nav>

        <!-- Order Success Notification -->
        @if(session('order_success'))
            <div class="mb-10 bg-emerald-50 border-2 border-emerald-500 rounded-3xl p-6 sm:p-8 shadow-lg">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 text-2xl shadow-md">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="flex-1">
                        <span class="inline-block px-3 py-0.5 rounded-full bg-emerald-600 text-white text-xs font-bold uppercase tracking-wider mb-2">Order Confirmed</span>
                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Thank you! Your order has been placed successfully.</h2>
                        <p class="text-slate-600 text-sm mb-4">
                            We have received your order for <strong>{{ session('order_success')['product_name'] }}</strong> ({{ session('order_success')['quantity'] }} accounts, Total: <strong>${{ session('order_success')['total_price'] }}</strong>).
                            Our automation system and fulfillment team will dispatch all credentials and login access files to <strong>{{ session('order_success')['email'] }}</strong> within 1-5 minutes.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow transition">
                                <i class="fa-solid fa-house"></i>
                                Back to Home
                            </a>
                            <a href="https://wa.me/{{ $rawPhone }}" target="_blank" class="inline-flex items-center gap-2 bg-white border border-emerald-600 text-emerald-700 hover:bg-emerald-50 text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                                Live Support on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clear local cart if order succeeded -->
            @if(isset(session('order_success')['clear_cart']))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (window.AccueCart) {
                            window.AccueCart.clearLocal();
                        }
                    });
                </script>
            @endif
        @endif

        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Complete Your Order
                </h1>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Fast, secure checkout with instant digital delivery and 48-hour replacement warranty.
                </p>
            </div>

            <!-- Toggle between Cart Checkout & Single Product Checkout if cart has items -->
            <div x-show="cartItems.length > 0" class="inline-flex p-1 bg-slate-200/80 rounded-2xl shrink-0">
                <button type="button" 
                        @click="mode = 'cart'" 
                        :class="mode === 'cart' ? 'bg-white text-emerald-700 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                        class="px-4 py-2 rounded-xl text-xs transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Checkout Cart (<span x-text="cartItems.length"></span>)</span>
                </button>
                <button type="button" 
                        @click="mode = 'single'" 
                        :class="mode === 'single' ? 'bg-white text-emerald-700 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                        class="px-4 py-2 rounded-xl text-xs transition cursor-pointer flex items-center gap-1.5">
                    <i class="fa-solid fa-box"></i>
                    <span>Single Product</span>
                </button>
            </div>
        </div>

        <form action="{{ route('checkout.submit') }}" method="POST">
            @csrf
            <!-- Form Hidden Fields -->
            <input type="hidden" name="cart_items" :value="mode === 'cart' ? JSON.stringify(cartItems) : ''">
            <input type="hidden" name="product_id" :value="mode === 'single' ? singleProduct.id : (cartItems[0]?.product_id || 1)">
            <input type="hidden" name="quantity" :value="currentFinalQty">
            <input type="hidden" name="total_price" :value="currentFinalTotal">
            <input type="hidden" name="payment_method" :value="paymentMethod">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Left Column: Products / Cart Items, Customer Details, Payment Method -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- ================= CART ITEMS MODE ================= -->
                    <div x-show="mode === 'cart'" class="light-detail-card rounded-3xl p-6 sm:p-7 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-cart-shopping text-emerald-600"></i>
                                Cart Items (<span x-text="cartItems.length"></span>)
                            </h3>
                            <button type="button" 
                                    onclick="window.AccueCart && window.AccueCart.open()"
                                    class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold cursor-pointer">
                                Manage in Drawer
                            </button>
                        </div>

                        <!-- Cart Items List -->
                        <div class="space-y-3">
                            <template x-for="item in cartItems" :key="item.product_id">
                                <div class="p-4 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center gap-4 transition hover:border-emerald-300">
                                    <!-- Logo Container -->
                                    <div class="w-16 h-16 rounded-xl flex items-center justify-center p-2 shrink-0 shadow-sm"
                                         :style="`background: linear-gradient(135deg, ${item.bg_color_1 || '#064e3b'}, ${item.bg_color_2 || '#022c22'});`">
                                        <img :src="item.product_logo || '{{ asset('no_image.jpg') }}'" 
                                             :alt="item.product_name"
                                             class="max-h-10 max-w-full object-contain filter drop-shadow-sm"
                                             onerror="this.src='{{ asset('no_image.jpg') }}'">
                                    </div>

                                    <!-- Item Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="text-base font-bold text-slate-900 truncate m-0" x-text="item.product_name"></h4>
                                            <button type="button" 
                                                    @click="removeCartItem(item.product_id)"
                                                    class="text-slate-400 hover:text-red-500 transition text-sm p-1 cursor-pointer"
                                                    title="Remove item">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </div>

                                        <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-semibold text-[10px]" x-text="item.tag || '100% PVA'"></span>
                                            <span x-text="'$' + (item.unit_price || 0.85) + ' / account'"></span>
                                            <span x-show="getItemCalculation(item).discountLabel"
                                                  class="text-emerald-700 font-bold"
                                                  x-text="getItemCalculation(item).discountLabel"></span>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center border border-slate-300 rounded-lg bg-white overflow-hidden shadow-sm">
                                                <button type="button" 
                                                        @click="updateCartItemQty(item.product_id, parseInt(item.quantity) - 5)"
                                                        class="px-2.5 py-1 text-slate-600 hover:bg-slate-100 font-bold text-xs cursor-pointer">-</button>
                                                <input type="number" 
                                                       min="1" 
                                                       :value="item.quantity" 
                                                       @change="updateCartItemQty(item.product_id, parseInt($event.target.value))"
                                                       class="w-14 text-center text-xs font-bold text-slate-900 border-x border-slate-200 py-1 focus:outline-none">
                                                <button type="button" 
                                                        @click="updateCartItemQty(item.product_id, parseInt(item.quantity) + 5)"
                                                        class="px-2.5 py-1 text-slate-600 hover:bg-slate-100 font-bold text-xs cursor-pointer">+</button>
                                            </div>

                                            <div class="text-right">
                                                <span class="text-base font-extrabold text-slate-900" x-text="'$' + getItemCalculation(item).total"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- ================= SINGLE PRODUCT MODE ================= -->
                    <div x-show="mode === 'single'" class="space-y-6">
                        <!-- Selected Product Card -->
                        <div class="light-detail-card rounded-3xl p-6 sm:p-7">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Selected Product
                                </span>
                                @if(count($allProducts) > 1)
                                    <div class="text-xs">
                                        <span class="text-slate-400">Change product:</span>
                                        <select onchange="if(this.value) window.location.href=this.value"
                                                class="ml-1 bg-slate-50 border border-slate-300 rounded-lg text-xs py-1 px-2 text-slate-700 font-semibold focus:outline-none focus:ring-1 focus:ring-emerald-500">
                                            @foreach($allProducts as $p)
                                                <option value="{{ route('checkout', $p->id) }}" {{ $p->id == $product->id ? 'selected' : '' }}>
                                                    {{ $p->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-4 sm:gap-6">
                                <!-- Visual Logo -->
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl flex items-center justify-center p-3 shrink-0 shadow-sm"
                                     style="background: linear-gradient(135deg, {{ $bgColor1 }}, {{ $bgColor2 }});">
                                    @if($product->product_logo)
                                        <img src="{{ asset('storage/' . $product->product_logo) }}" 
                                             alt="{{ $product->product_name }}"
                                             class="max-h-14 max-w-full object-contain filter drop-shadow-sm"
                                             onerror="this.onerror=null; this.src='{{ asset('no_image.jpg') }}';">
                                    @else
                                        <i class="fa-solid fa-layer-group text-3xl text-white"></i>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {{ $product->tag ?? '100% PVA' }}
                                        </span>
                                        <span class="text-xs text-slate-500 font-medium">
                                            {{ ucwords(str_replace('_', ' ', $product->category ?? 'Account')) }}
                                        </span>
                                    </div>
                                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 truncate">
                                        {{ $product->product_name }}
                                    </h2>
                                    <p class="text-xs text-slate-500 mt-1 line-clamp-1">
                                        {{ $product->product_desc ?? 'Instant digital credentials delivery with complete verification guarantee.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity & Package Tier Selection -->
                        <div class="light-detail-card rounded-3xl p-6 sm:p-7 space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fa-solid fa-boxes-stacked text-emerald-600"></i>
                                    Select Quantity Tier
                                </label>
                                <span x-text="singleDiscountLabel"
                                      class="text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                                </span>
                            </div>

                            <!-- Tier Quick Selectors -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                <button type="button" 
                                        @click="qty = 10" 
                                        :class="qty === 10 ? 'border-emerald-500 bg-emerald-50 text-emerald-900 font-bold ring-2 ring-emerald-500/20' : 'border-slate-200 bg-slate-50 text-slate-700 hover:border-slate-300'"
                                        class="py-3 px-2 rounded-xl border text-center transition-all cursor-pointer">
                                    <span class="block text-sm font-semibold">10 Accounts</span>
                                    <span class="block text-[11px] text-slate-500">Starter Pack</span>
                                </button>
                                <button type="button" 
                                        @click="qty = 25" 
                                        :class="qty === 25 ? 'border-emerald-500 bg-emerald-50 text-emerald-900 font-bold ring-2 ring-emerald-500/20' : 'border-slate-200 bg-slate-50 text-slate-700 hover:border-slate-300'"
                                        class="py-3 px-2 rounded-xl border text-center transition-all cursor-pointer">
                                    <span class="block text-sm font-semibold">25 Accounts</span>
                                    <span class="block text-[11px] text-emerald-700 font-medium">Save 10%</span>
                                </button>
                                <button type="button" 
                                        @click="qty = 50" 
                                        :class="qty === 50 ? 'border-emerald-500 bg-emerald-50 text-emerald-900 font-bold ring-2 ring-emerald-500/20' : 'border-slate-200 bg-slate-50 text-slate-700 hover:border-slate-300'"
                                        class="py-3 px-2 rounded-xl border text-center transition-all cursor-pointer">
                                    <span class="block text-sm font-semibold">50 Accounts</span>
                                    <span class="block text-[11px] text-emerald-700 font-medium">Save 15%</span>
                                </button>
                                <button type="button" 
                                        @click="qty = 100" 
                                        :class="qty === 100 ? 'border-emerald-500 bg-emerald-50 text-emerald-900 font-bold ring-2 ring-emerald-500/20' : 'border-slate-200 bg-slate-50 text-slate-700 hover:border-slate-300'"
                                        class="py-3 px-2 rounded-xl border text-center transition-all cursor-pointer">
                                    <span class="block text-sm font-semibold">100+ Accounts</span>
                                    <span class="block text-[11px] text-emerald-700 font-medium">Save 25%</span>
                                </button>
                            </div>

                            <!-- Custom Quantity Input -->
                            <div class="pt-2 flex items-center justify-between gap-4">
                                <span class="text-xs text-slate-600 font-medium">Or custom quantity:</span>
                                <div class="flex items-center gap-2">
                                    <button type="button" 
                                            @click="if(qty > 5) qty -= 5"
                                            class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center font-bold">-</button>
                                    <input type="number" 
                                           min="1" 
                                           x-model.number="qty" 
                                           class="w-20 text-center font-bold text-slate-900 border border-slate-300 rounded-lg py-1 px-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    <button type="button" 
                                            @click="qty += 5"
                                            class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center font-bold">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Contact Details -->
                    <div class="light-detail-card rounded-3xl p-6 sm:p-7 space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2 m-0">
                                <i class="fa-solid fa-user-check text-emerald-600"></i>
                                Customer & Delivery Details
                            </h3>
                            @if($authUser)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200/90 shadow-sm">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-[11px]"></i>
                                    <span>Logged in as <strong>{{ $authUser->name }}</strong></span>
                                </span>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       required
                                       x-model="name"
                                       value="{{ $defaultName }}"
                                       placeholder="e.g. John Doe"
                                       class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                @error('name')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Delivery Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       required
                                       x-model="email"
                                       value="{{ $defaultEmail }}"
                                       placeholder="your-email@example.com"
                                       class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="text-[11px] text-slate-400 mt-1 block">Account credentials and login files will be dispatched here.</span>
                                @error('email')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    WhatsApp / Telegram / Phone <span class="text-slate-400 font-normal">(Optional)</span>
                                </label>
                                <input type="text" 
                                       name="phone" 
                                       x-model="phone"
                                       value="{{ $defaultPhone }}"
                                       placeholder="+1 (555) 000-0000"
                                       class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="text-[11px] text-slate-400 mt-1 block">For instant dispatch confirmation.</span>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Special Notes / Formatting Requests <span class="text-slate-400 font-normal">(Optional)</span>
                                </label>
                                <input type="text" 
                                       name="notes" 
                                       placeholder="e.g. Specific residential IP country, export format"
                                       class="w-full text-sm px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="light-detail-card rounded-3xl p-6 sm:p-7 space-y-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-credit-card text-emerald-600"></i>
                                Select Payment Method
                            </h3>
                            <span class="text-xs text-slate-500 font-medium">
                                Instant Verification
                            </span>
                        </div>

                        <input type="hidden" name="payment_method" :value="paymentMethod">

                        @if($enabledPaymentMethods->isEmpty())
                            <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-xs flex items-center gap-3">
                                <i class="fa-solid fa-triangle-exclamation text-amber-600 text-lg"></i>
                                <span>No automated payment gateways are currently enabled. Please contact our support team on WhatsApp to complete your checkout.</span>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($enabledPaymentMethods as $pm)
                                    @php
                                        $isUsdt = str_contains($pm->slug, 'usdt');
                                        $isUsdc = str_contains($pm->slug, 'usdc');
                                        $isSol = str_contains($pm->slug, 'solana');
                                        $isBtc = str_contains($pm->slug, 'btc');

                                        $iconColor = $isUsdt ? 'text-emerald-500' 
                                                   : ($isUsdc ? 'text-blue-500' 
                                                   : ($isSol ? 'text-purple-500' 
                                                   : 'text-amber-500'));
                                        $iconClass = $pm->icon ?? ($isUsdt ? 'fa-solid fa-coins' : ($isUsdc ? 'fa-solid fa-circle-dollar-to-slot' : ($isSol ? 'fa-solid fa-bolt' : 'fa-brands fa-bitcoin')));
                                    @endphp
                                    <div @click="paymentMethod = '{{ $pm->slug }}'"
                                         :class="paymentMethod === '{{ $pm->slug }}' ? 'border-emerald-500 bg-emerald-50/70 ring-2 ring-emerald-500/20 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'"
                                         class="p-4 rounded-2xl border cursor-pointer transition-all flex items-start gap-3.5 group">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-slate-200/80 flex items-center justify-center shrink-0 text-xl {{ $iconColor }} transition">
                                            <i class="{{ $iconClass }}"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-1">
                                                <span class="text-sm font-extrabold text-slate-900 truncate">{{ $pm->name }}</span>
                                                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full shrink-0">Instant</span>
                                            </div>
                                            <span class="text-xs text-slate-500 block truncate mt-0.5">{{ $pm->network ?? $pm->currency }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Selected Payment Method Details & Instructions -->
                            @foreach($enabledPaymentMethods as $pm)
                                <div x-show="paymentMethod === '{{ $pm->slug }}'" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="p-5 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-4">
                                    
                                    <div class="flex items-center justify-between pb-3 border-b border-slate-200/80 flex-wrap gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold text-slate-900">{{ $pm->name }}</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                Network: {{ $pm->network ?? $pm->currency }}
                                            </span>
                                        </div>
                                        <span class="text-xs text-slate-500 flex items-center gap-1 font-medium">
                                            <i class="fa-solid fa-bolt text-amber-500"></i> Automatic Delivery Dispatch
                                        </span>
                                    </div>

                                    @if(!empty($pm->wallet_address))
                                        <!-- Wallet Address Box -->
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5 flex items-center justify-between">
                                                <span>{{ $pm->currency }} Receiving Address:</span>
                                                <button type="button" 
                                                        @click="copyAddress('{{ addslashes($pm->wallet_address) }}')"
                                                        class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 cursor-pointer">
                                                    <i class="fa-solid fa-copy text-[11px]"></i>
                                                    <span x-text="copiedWallet ? 'Copied to Clipboard!' : 'Copy Address'"></span>
                                                </button>
                                            </label>
                                            <div class="flex items-center gap-2 p-3 rounded-xl bg-white border border-slate-200 shadow-inner">
                                                <code class="text-xs sm:text-sm font-mono text-slate-800 font-bold break-all flex-1 select-all">
                                                    {{ $pm->wallet_address }}
                                                </code>
                                                <button type="button" 
                                                        @click="copyAddress('{{ addslashes($pm->wallet_address) }}')"
                                                        class="p-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold transition shrink-0"
                                                        title="Copy address">
                                                    <i class="fa-solid fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex flex-col sm:flex-row items-center gap-4">
                                        @if($pm->qr_code)
                                            <!-- QR Code Display -->
                                            <div class="shrink-0 p-2.5 rounded-xl bg-white border border-slate-200 shadow-sm text-center">
                                                <img src="{{ asset('storage/' . $pm->qr_code) }}" 
                                                     alt="Scan to pay {{ $pm->name }}" 
                                                     class="w-28 h-28 object-contain mx-auto rounded">
                                                <span class="text-[10px] text-slate-400 block mt-1">Scan QR to pay</span>
                                            </div>
                                        @endif

                                        <!-- Instructions -->
                                        <div class="flex-1 text-xs text-slate-600 space-y-2">
                                            @if($pm->instructions)
                                                <div class="p-3.5 rounded-xl bg-white border border-slate-200/80 leading-relaxed">
                                                    <strong class="text-slate-800 block mb-1 flex items-center gap-1.5">
                                                        <i class="fa-solid fa-circle-info text-emerald-600"></i> Instructions:
                                                    </strong>
                                                    {{ $pm->instructions }}
                                                </div>
                                            @endif
                                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                                After sending payment, click <strong>"Place Order"</strong> below. Credentials and account backup files will be dispatched automatically to your email once transaction is recorded.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>

                <!-- Right Column: Sticky Order Summary & Instant Checkout CTAs -->
                <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28">

                    <div class="light-detail-card rounded-3xl p-6 sm:p-7 shadow-lg">
                        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-4 mb-4 flex items-center justify-between">
                            <span>Order Summary</span>
                            <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full"
                                  x-text="mode === 'cart' ? `${cartItems.length} Products` : 'Single Product'">
                            </span>
                        </h3>

                        <!-- Price Breakdown -->
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center text-slate-600">
                                <span>Total Quantity:</span>
                                <span class="font-bold text-slate-900" x-text="currentFinalQty + ' accounts'"></span>
                            </div>

                            <div class="flex justify-between items-center text-slate-600">
                                <span>Subtotal:</span>
                                <span class="font-medium text-slate-900" x-text="'$' + (mode === 'cart' ? cartTotals.subtotal : singleSubtotal)"></span>
                            </div>

                            <div class="flex justify-between items-center text-emerald-600" 
                                 x-show="(mode === 'cart' ? parseFloat(cartTotals.totalDiscount) : singleDiscountRate) > 0">
                                <span class="flex items-center gap-1 font-medium">
                                    <i class="fa-solid fa-tag text-xs"></i>
                                    Volume Tier Savings:
                                </span>
                                <span class="font-bold" x-text="'-$' + (mode === 'cart' ? cartTotals.totalDiscount : singleDiscountAmount)"></span>
                            </div>

                            <div class="flex justify-between items-center text-slate-600">
                                <span>Digital Delivery Fee:</span>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase">FREE</span>
                            </div>

                            <div class="border-t border-slate-200/90 pt-4 mt-2 flex justify-between items-baseline">
                                <span class="text-base font-bold text-slate-900">Total Amount:</span>
                                <div class="text-right">
                                    <span class="text-3xl font-extrabold text-emerald-700 tracking-tight" x-text="'$' + currentFinalTotal"></span>
                                    <span class="text-xs text-slate-500 block">USD (All taxes included)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <div class="mt-6 space-y-3">
                            <button type="submit" 
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-center flex items-center justify-center gap-2 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                                <i class="fa-solid fa-lock text-sm"></i>
                                <span>Place Order Now</span>
                            </button>

                            <!-- Alternative 1-Click Order Options -->
                            <div class="relative flex py-1 items-center">
                                <div class="flex-grow border-t border-slate-200"></div>
                                <span class="flex-shrink mx-3 text-slate-400 text-xs uppercase tracking-wider font-semibold">Or Instant Order Via</span>
                                <div class="flex-grow border-t border-slate-200"></div>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <a :href="whatsappOrderUrl" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="flex items-center justify-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 font-bold py-2.5 px-3 rounded-xl transition text-xs text-center">
                                    <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i>
                                    <span>WhatsApp</span>
                                </a>

                                <a :href="mailtoOrderUrl" 
                                   class="flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-300 font-bold py-2.5 px-3 rounded-xl transition text-xs text-center">
                                    <i class="fa-solid fa-envelope text-slate-600 text-sm"></i>
                                    <span>Direct Email</span>
                                </a>
                            </div>
                        </div>

                        <!-- Trust and Guarantees Box -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5 text-xs text-slate-500">
                            <div class="flex items-center gap-2 text-slate-700 font-medium">
                                <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                                <span>48-Hour Replacement Guarantee</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-700 font-medium">
                                <i class="fa-solid fa-bolt text-teal-600"></i>
                                <span>Instant Credentials Dispatch (1 - 5 mins)</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-700 font-medium">
                                <i class="fa-solid fa-headset text-blue-600"></i>
                                <span>24/7 Dedicated Priority Customer Support</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </form>

    </div>

</div>

@endsection
