@extends('layouts.app')
@section('title', 'User Dashboard | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .glass-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04), 0 4px 10px -3px rgba(0, 0, 0, 0.02);
    }
    .stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.25s ease;
    }
    .stat-card:hover {
        border-color: #10b981;
        box-shadow: 0 12px 25px -5px rgba(16, 185, 129, 0.12);
        transform: translateY(-2px);
    }
    .dash-tab-btn {
        transition: all 0.2s ease;
        font-weight: 700;
        font-size: 0.8125rem;
    }
    .dash-tab-btn.active {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
    }
    .auth-input {
        width: 100%;
        background-color: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 0.875rem;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        font-size: 0.875rem;
        color: #0f172a;
        transition: all 0.2s ease;
    }
    .auth-input:focus {
        outline: none;
        background-color: #ffffff;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }
</style>
@endpush

@section('app-content')

@php
    $userPhoto = null;
    if ($user && !empty($user->image)) {
        if (str_starts_with($user->image, 'http') || str_starts_with($user->image, 'storage/')) {
            $userPhoto = asset($user->image);
        } else {
            $userPhoto = asset('storage/' . $user->image);
        }
    }
    if (!$userPhoto) {
        $userPhoto = asset('no-profile-img.png');
    }

    $rawPhone = preg_replace('/[^0-9]/', '', $configer?->phone ?? '15550192834');
    $initialTab = session('tab', 'overview');
@endphp

<div class="bg-gradient-to-b from-slate-50 via-white to-slate-50 text-slate-800 antialiased min-h-screen pt-28 pb-20 font-['Inter',sans-serif]"
     x-data="{ 
        activeTab: '{{ $initialTab }}',
        selectedOrder: null,
        orderModalOpen: false,
        openOrderModal(order) {
            this.selectedOrder = order;
            this.orderModalOpen = true;
        },
        closeOrderModal() {
            this.orderModalOpen = false;
            this.selectedOrder = null;
        }
     }">

    <!-- Ambient Glow Top Accents -->
    <div class="relative overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[1100px] h-[360px] bg-gradient-to-b from-emerald-200/40 via-teal-100/20 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

        <!-- Top Header & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-2 text-xs text-slate-500 mb-2 overflow-x-auto whitespace-nowrap">
                    <a href="{{ route('home') }}" class="hover:text-emerald-600 transition flex items-center gap-1.5 font-medium">
                        <i class="fa-solid fa-house text-[11px] text-slate-400"></i>
                        <span>Home</span>
                    </a>
                    <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                    <span class="text-emerald-700 font-semibold">User Dashboard</span>
                </nav>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                    <span>Welcome back, {{ $user->name }}</span>
                    @if($isAdmin)
                        <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-0.5 rounded-full bg-purple-100 text-purple-700 border border-purple-200 uppercase tracking-wider">
                            <i class="fa-solid fa-shield-halved text-[10px]"></i> Admin
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase tracking-wider">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Client
                        </span>
                    @endif
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Manage your verified PVA account orders, view active shopping cart items, and update profile security.
                </p>
            </div>

            <!-- Actions Header -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}#products" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-black text-white text-xs font-bold transition shadow-sm cursor-pointer">
                    <i class="fa-solid fa-layer-group text-emerald-400"></i>
                    <span>Browse Accounts</span>
                </a>
                <button type="button" 
                        onclick="window.confirmLogout ? window.confirmLogout('{{ $isAdmin ? route('admin.logout') : route('logout') }}') : document.getElementById('dash-logout-form').submit()"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold transition cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="hidden sm:inline">Sign Out</span>
                </button>
                <form id="dash-logout-form" method="POST" action="{{ $isAdmin ? route('admin.logout') : route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Flash Success Notification -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between text-sm shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 text-sm font-bold">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-sm shadow-sm">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-base shrink-0 mt-0.5"></i>
                    <div>
                        <strong class="font-bold block">Please correct the following:</strong>
                        <ul class="list-disc list-inside text-xs mt-1 space-y-0.5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- 4 Key Stat Metrics Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            
            <!-- Stat 1: Total Orders -->
            <div @click="activeTab = 'orders'" class="stat-card rounded-2xl p-5 cursor-pointer flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 text-xl border border-emerald-100">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Total Orders</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-900">{{ $totalOrdersCount }}</span>
                    <span class="text-[11px] text-emerald-600 font-bold block mt-0.5">View history &rarr;</span>
                </div>
            </div>

            <!-- Stat 2: Accounts Purchased -->
            <div @click="activeTab = 'orders'" class="stat-card rounded-2xl p-5 cursor-pointer flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 text-xl border border-teal-100">
                    <i class="fa-solid fa-sim-card"></i>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Accounts Purchased</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-900">{{ $totalAccountsPurchased }}</span>
                    <span class="text-[11px] text-teal-600 font-bold block mt-0.5">Verified PVA</span>
                </div>
            </div>

            <!-- Stat 3: Active Cart -->
            <div @click="activeTab = 'cart'" class="stat-card rounded-2xl p-5 cursor-pointer flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 text-xl border border-blue-100">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Cart Items</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-900">{{ $cartCount }}</span>
                    <span class="text-[11px] text-blue-600 font-bold block mt-0.5">${{ number_format($cartTotal, 2) }} total &rarr;</span>
                </div>
            </div>

            <!-- Stat 4: Total Spent -->
            <div class="stat-card rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-xl border border-amber-100">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block">Total Spent</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-900">${{ number_format($totalSpent, 2) }}</span>
                    <span class="text-[11px] text-amber-600 font-bold block mt-0.5">Lifetime balance</span>
                </div>
            </div>

        </div>

        <!-- Main Dashboard Layout: Left Nav + Right Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: User Profile Badge & Navigation Tabs (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Profile Summary Card -->
                <div class="glass-card rounded-3xl p-6 text-center relative overflow-hidden">
                    <div class="relative inline-block mb-3">
                        <img src="{{ $userPhoto }}" 
                             alt="{{ $user->name }}" 
                             class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-emerald-500/20 shadow-md"
                             onerror="this.onerror=null; this.src='{{ asset('no-profile-img.png') }}';">
                        <span class="absolute bottom-1 right-1 w-4 h-4 rounded-full bg-emerald-500 border-2 border-white" title="Active"></span>
                    </div>

                    <h2 class="text-lg font-extrabold text-slate-900 tracking-tight">{{ $user->name }}</h2>
                    <p class="text-xs text-slate-500 truncate mt-0.5">{{ $user->email }}</p>

                    @if($user->phone)
                        <div class="mt-2 inline-flex items-center gap-1.5 text-xs text-slate-600 bg-slate-50 px-3 py-1 rounded-full border border-slate-200">
                            <i class="fa-solid fa-phone text-emerald-600 text-[11px]"></i>
                            <span>{{ $user->phone }}</span>
                        </div>
                    @endif

                    <!-- Tab Navigation Buttons -->
                    <div class="mt-6 pt-6 border-t border-slate-100 space-y-2 text-left">
                        
                        <!-- Tab Button: Overview -->
                        <button type="button" 
                                @click="activeTab = 'overview'" 
                                :class="activeTab === 'overview' ? 'active' : 'text-slate-700 hover:bg-slate-100'"
                                class="dash-tab-btn w-full flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-chart-pie text-sm w-4 text-center"></i>
                                <span>Overview</span>
                            </span>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </button>

                        <!-- Tab Button: Orders -->
                        <button type="button" 
                                @click="activeTab = 'orders'" 
                                :class="activeTab === 'orders' ? 'active' : 'text-slate-700 hover:bg-slate-100'"
                                class="dash-tab-btn w-full flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-box text-sm w-4 text-center"></i>
                                <span>My Orders History</span>
                            </span>
                            <span class="text-xs px-2 py-0.5 rounded-full" :class="activeTab === 'orders' ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700'">
                                {{ $totalOrdersCount }}
                            </span>
                        </button>

                        <!-- Tab Button: Cart -->
                        <button type="button" 
                                @click="activeTab = 'cart'" 
                                :class="activeTab === 'cart' ? 'active' : 'text-slate-700 hover:bg-slate-100'"
                                class="dash-tab-btn w-full flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-cart-shopping text-sm w-4 text-center"></i>
                                <span>Shopping Cart</span>
                            </span>
                            <span class="text-xs px-2 py-0.5 rounded-full" :class="activeTab === 'cart' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800 font-bold'">
                                {{ $cartCount }}
                            </span>
                        </button>

                        <!-- Tab Button: Edit Profile -->
                        <button type="button" 
                                @click="activeTab = 'profile'" 
                                :class="activeTab === 'profile' ? 'active' : 'text-slate-700 hover:bg-slate-100'"
                                class="dash-tab-btn w-full flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-user-gear text-sm w-4 text-center"></i>
                                <span>Account Details</span>
                            </span>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </button>

                        <!-- Tab Button: Security -->
                        <button type="button" 
                                @click="activeTab = 'security'" 
                                :class="activeTab === 'security' ? 'active' : 'text-slate-700 hover:bg-slate-100'"
                                class="dash-tab-btn w-full flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-lock text-sm w-4 text-center"></i>
                                <span>Password & Security</span>
                            </span>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </button>

                    </div>

                    @if($isAdmin)
                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs transition shadow-sm">
                                <i class="fa-solid fa-gauge-high"></i>
                                <span>Admin Management Panel</span>
                            </a>
                        </div>
                    @endif

                </div>

                <!-- 24/7 Support Box -->
                <div class="glass-card rounded-3xl p-6 space-y-3 bg-emerald-50/20 border-emerald-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                        <i class="fa-solid fa-headset text-emerald-600 text-sm"></i>
                        Direct WhatsApp Support
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Need prompt delivery of custom geo accounts, bulk volume discounts, or order assistance?
                    </p>
                    <a href="https://wa.me/{{ $rawPhone }}?text=Hello%20AccueVault%20Support,%20I%20have%20an%20inquiry%20regarding%20my%20account%20{{ urlencode($user->email) }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Chat With Agent On WhatsApp &rarr;</span>
                    </a>
                </div>

            </div>

            <!-- Right Column: Tab Panes (8 Cols) -->
            <div class="lg:col-span-8">
                
                <!-- TAB 1: OVERVIEW -->
                <div x-show="activeTab === 'overview'" x-transition class="space-y-6">
                    
                    <!-- Welcome Hero Card -->
                    <div class="rounded-3xl p-6 sm:p-8 text-white relative overflow-hidden shadow-xl"
                         style="background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);">
                        <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
                        <div class="relative z-10 space-y-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                                <i class="fa-solid fa-shield-check text-[11px]"></i> Real Physical SIM Accounts
                            </span>
                            <h2 class="text-xl sm:text-2xl font-black tracking-tight">
                                High-Trust PVA Accounts for Enterprise & Social Growth
                            </h2>
                            <p class="text-xs sm:text-sm text-emerald-100/80 max-w-xl leading-relaxed">
                                All PVA accounts are freshly provisioned, manually tested, and backed by a 48-hour replacement warranty.
                            </p>
                            <div class="pt-2 flex flex-wrap items-center gap-3">
                                <a href="{{ route('home') }}#products" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-slate-900 font-extrabold text-xs hover:bg-slate-100 transition shadow">
                                    <i class="fa-solid fa-plus text-emerald-600"></i>
                                    <span>New Order</span>
                                </a>
                                <button type="button" @click="activeTab = 'orders'" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-extrabold text-xs transition border border-white/20">
                                    <i class="fa-solid fa-list-check"></i>
                                    <span>Review Orders ({{ $totalOrdersCount }})</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders Mini-Section -->
                    <div class="glass-card rounded-3xl p-6 sm:p-7 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Recent Orders</h3>
                                <p class="text-xs text-slate-500">Your latest purchases and service deliveries.</p>
                            </div>
                            <button type="button" @click="activeTab = 'orders'" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                                <span>View All ({{ $totalOrdersCount }})</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>

                        @if($orders->count() > 0)
                            <div class="space-y-3">
                                @foreach($orders->take(3) as $ord)
                                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:border-emerald-300 transition">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-mono font-bold text-slate-500">#ORD-{{ sprintf('%05d', $ord->id) }}</span>
                                                <span class="text-xs font-black text-slate-900">{{ $ord->subject }}</span>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-2 text-[11px] text-slate-500">
                                                <span><i class="fa-solid fa-credit-card text-emerald-600 mr-1"></i>{{ $ord->payment_method }}</span>
                                                <span>•</span>
                                                <span><i class="fa-regular fa-clock text-slate-400 mr-1"></i>{{ $ord->created_at ? $ord->created_at->format('M d, Y h:i A') : 'Recent' }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-black text-emerald-700">${{ number_format($ord->total_price, 2) }}</span>
                                            <button type="button" 
                                                    @click="openOrderModal({
                                                        id: '{{ sprintf('%05d', $ord->id) }}',
                                                        subject: '{{ addslashes($ord->subject) }}',
                                                        service: '{{ addslashes($ord->service) }}',
                                                        price: '{{ number_format($ord->total_price, 2) }}',
                                                        qty: '{{ $ord->total_quantity }}',
                                                        method: '{{ addslashes($ord->payment_method) }}',
                                                        date: '{{ $ord->created_at ? $ord->created_at->format('M d, Y - h:i A') : 'Recent' }}',
                                                        notes: '{{ addslashes(str_replace(["\r", "\n"], ' ', $ord->message)) }}'
                                                    })"
                                                    class="px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold transition">
                                                Details
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 rounded-2xl bg-slate-50 border border-dashed border-slate-200 text-center space-y-2">
                                <i class="fa-solid fa-boxes-packing text-3xl text-slate-400"></i>
                                <h4 class="text-sm font-bold text-slate-700">No Orders Placed Yet</h4>
                                <p class="text-xs text-slate-400 max-w-sm mx-auto">Explore our PVA catalog and place your first order.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Active Cart Mini-Section -->
                    <div class="glass-card rounded-3xl p-6 sm:p-7 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Active Shopping Cart</h3>
                                <p class="text-xs text-slate-500">{{ $cartCount }} items pending checkout.</p>
                            </div>
                            <button type="button" @click="activeTab = 'cart'" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition flex items-center gap-1">
                                <span>Manage Cart</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>

                        @if($cartItems->count() > 0)
                            <div class="space-y-3">
                                @foreach($cartItems->take(3) as $cItem)
                                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/90 flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 p-1.5"
                                                 style="background: linear-gradient(135deg, {{ $cItem->product->bg_color_1 ?? '#064e3b' }}, {{ $cItem->product->bg_color_2 ?? '#022c22' }}); border: 1px solid rgba(255,255,255,0.15);">
                                                @if($cItem->product->product_logo)
                                                    <img src="{{ asset('storage/' . $cItem->product->product_logo) }}" alt="Logo" class="max-h-full max-w-full object-contain">
                                                @else
                                                    <i class="fa-solid fa-cube text-white text-xs"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="text-xs font-black text-slate-900">{{ $cItem->product->product_name }}</h4>
                                                <span class="text-[11px] text-slate-500">{{ $cItem->quantity }} accounts &times; ${{ number_format($cItem->unit_price ?: 0.85, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-black text-slate-900">${{ number_format($cItem->total_price, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="pt-2 flex items-center justify-between">
                                    <span class="text-xs text-slate-500 font-medium">Cart Total: <strong class="text-slate-900 font-black">${{ number_format($cartTotal, 2) }}</strong></span>
                                    <a href="{{ route('checkout') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition shadow-sm">
                                        <span>Proceed to Checkout</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="p-6 rounded-2xl bg-slate-50 text-center space-y-1">
                                <p class="text-xs text-slate-500">Your shopping cart is currently empty.</p>
                                <a href="{{ route('home') }}#products" class="inline-block text-xs font-bold text-emerald-600 hover:text-emerald-700">Browse accounts to add &rarr;</a>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- TAB 2: MY ORDERS HISTORY -->
                <div x-show="activeTab === 'orders'" x-transition class="space-y-6" style="display: none;">
                    
                    <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6">
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                                    <i class="fa-solid fa-box text-emerald-600"></i>
                                    <span>My Orders History</span>
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Complete log of all purchases tied to your registered email ({{ $user->email }}).
                                </p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                Total: {{ $totalOrdersCount }} Orders
                            </span>
                        </div>

                        @if($orders->count() > 0)
                            <div class="space-y-4">
                                @foreach($orders as $order)
                                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/90 hover:border-emerald-300 transition-all space-y-3">
                                        
                                        <!-- Top Row: Order ID, Date & Badge -->
                                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-200/60 pb-3">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800 font-mono text-xs font-black">
                                                    #ORD-{{ sprintf('%05d', $order->id) }}
                                                </span>
                                                <span class="text-xs font-semibold text-slate-500">
                                                    <i class="fa-regular fa-calendar text-slate-400 mr-1"></i>
                                                    {{ $order->created_at ? $order->created_at->format('M d, Y - h:i A') : 'Recent' }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                                    <i class="fa-solid fa-circle-check text-[10px]"></i> Confirmed
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Middle Row: Order Details -->
                                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                                            <div class="sm:col-span-8 space-y-1">
                                                <h4 class="text-sm font-extrabold text-slate-900">{{ $order->subject }}</h4>
                                                <p class="text-xs text-slate-600 font-mono line-clamp-2">{{ $order->service }}</p>
                                            </div>
                                            <div class="sm:col-span-4 sm:text-right space-y-1">
                                                <div class="text-base font-black text-emerald-700">${{ number_format($order->total_price, 2) }}</div>
                                                <div class="text-[11px] text-slate-500 flex items-center sm:justify-end gap-1">
                                                    <i class="fa-solid fa-wallet text-slate-400"></i>
                                                    <span>{{ $order->payment_method }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bottom Row: Order Actions -->
                                        <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between text-xs">
                                            <span class="text-slate-500">
                                                Quantity: <strong class="text-slate-800 font-bold">{{ $order->total_quantity }} accounts</strong>
                                            </span>
                                            <button type="button" 
                                                    @click="openOrderModal({
                                                        id: '{{ sprintf('%05d', $order->id) }}',
                                                        subject: '{{ addslashes($order->subject) }}',
                                                        service: '{{ addslashes($order->service) }}',
                                                        price: '{{ number_format($order->total_price, 2) }}',
                                                        qty: '{{ $order->total_quantity }}',
                                                        method: '{{ addslashes($order->payment_method) }}',
                                                        date: '{{ $order->created_at ? $order->created_at->format('M d, Y - h:i A') : 'Recent' }}',
                                                        notes: '{{ addslashes(str_replace(["\r", "\n"], ' ', $order->message)) }}'
                                                    })"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white hover:bg-slate-100 text-slate-800 border border-slate-200 font-bold transition shadow-2xs cursor-pointer">
                                                <i class="fa-solid fa-file-invoice text-emerald-600"></i>
                                                <span>View Full Invoice / Notes</span>
                                            </button>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-12 rounded-2xl bg-slate-50 border border-dashed border-slate-200 text-center space-y-3">
                                <i class="fa-solid fa-receipt text-4xl text-slate-300"></i>
                                <h4 class="text-base font-bold text-slate-700">No Orders Found</h4>
                                <p class="text-xs text-slate-400 max-w-sm mx-auto">You haven't placed any orders yet. Visit our product collection to order verified PVA accounts.</p>
                                <div class="pt-2">
                                    <a href="{{ route('home') }}#products" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition shadow-sm">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span>Browse PVA Products</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

                <!-- TAB 3: SHOPPING CART DATA -->
                <div x-show="activeTab === 'cart'" x-transition class="space-y-6" style="display: none;">
                    
                    <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6">
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                                    <i class="fa-solid fa-cart-shopping text-emerald-600"></i>
                                    <span>My Shopping Cart</span>
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Items saved in your account cart. Synced across your sessions.
                                </p>
                            </div>
                            @if($cartItems->count() > 0)
                                <a href="{{ route('checkout') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs transition shadow-sm">
                                    <span>Checkout Now (${{ number_format($cartTotal, 2) }})</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @endif
                        </div>

                        @if($cartItems->count() > 0)
                            <div class="space-y-4">
                                @foreach($cartItems as $c)
                                    <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        
                                        <div class="flex items-center gap-4">
                                            <!-- Product Icon -->
                                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 p-2 shadow-sm"
                                                 style="background: linear-gradient(135deg, {{ $c->product->bg_color_1 ?? '#064e3b' }}, {{ $c->product->bg_color_2 ?? '#022c22' }}); border: 1px solid rgba(255,255,255,0.15);">
                                                @if($c->product->product_logo)
                                                    <img src="{{ asset('storage/' . $c->product->product_logo) }}" 
                                                         alt="{{ $c->product->product_name }}" 
                                                         class="max-h-full max-w-full object-contain">
                                                @else
                                                    <i class="fa-solid fa-layer-group text-white text-base"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <h4 class="text-sm font-extrabold text-slate-900">{{ $c->product->product_name }}</h4>
                                                    @if($c->product->tag)
                                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                                            {{ $c->product->tag }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <span class="text-xs text-slate-500 block mt-0.5">
                                                    Category: {{ $c->product->category }} • Rate: ${{ number_format($c->unit_price ?: 0.85, 2) }} / account
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Quantity & Total -->
                                        <div class="flex items-center justify-between sm:justify-end gap-6 border-t sm:border-t-0 border-slate-200/80 pt-3 sm:pt-0">
                                            <div class="text-left sm:text-right">
                                                <span class="text-xs text-slate-400 block">Quantity</span>
                                                <span class="text-sm font-extrabold text-slate-800">{{ $c->quantity }} accounts</span>
                                            </div>

                                            <div class="text-left sm:text-right">
                                                <span class="text-xs text-slate-400 block">Subtotal</span>
                                                <span class="text-base font-black text-emerald-700">${{ number_format($c->total_price, 2) }}</span>
                                            </div>

                                            <div>
                                                <button type="button" 
                                                        onclick="if(window.AccueCart) { window.AccueCart.removeItem({{ $c->product_id }}); setTimeout(() => window.location.reload(), 400); }"
                                                        class="w-8 h-8 rounded-xl bg-slate-200 hover:bg-rose-100 text-slate-500 hover:text-rose-600 flex items-center justify-center transition cursor-pointer"
                                                        title="Remove from cart">
                                                    <i class="fa-solid fa-trash text-xs"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                <!-- Cart Checkout Summary Footer -->
                                <div class="p-6 rounded-2xl bg-emerald-50/50 border border-emerald-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6">
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase tracking-wider font-semibold block">Order Total</span>
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-2xl font-black text-slate-900">${{ number_format($cartTotal, 2) }}</span>
                                            <span class="text-xs text-emerald-700 font-bold">({{ $cartCount }} accounts across {{ $cartItems->count() }} items)</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('home') }}#products" class="px-4 py-2.5 rounded-xl bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 text-xs font-bold transition">
                                            Add More Items
                                        </a>
                                        <a href="{{ route('checkout') }}" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold transition shadow-md shadow-emerald-600/25">
                                            Proceed to Checkout &rarr;
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="p-12 rounded-2xl bg-slate-50 border border-dashed border-slate-200 text-center space-y-3">
                                <i class="fa-solid fa-cart-plus text-4xl text-slate-300"></i>
                                <h4 class="text-base font-bold text-slate-700">Your Cart is Empty</h4>
                                <p class="text-xs text-slate-400 max-w-sm mx-auto">Browse our catalogue of verified PVA accounts to add products to your cart.</p>
                                <div class="pt-2">
                                    <a href="{{ route('home') }}#products" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition shadow-sm">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <span>Browse Products Now</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

                <!-- TAB 4: EDIT PROFILE DETAILS -->
                <div x-show="activeTab === 'profile'" x-transition class="space-y-6" style="display: none;">
                    
                    <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6">
                        
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                                    <i class="fa-solid fa-user-pen text-emerald-600"></i>
                                    <span>Edit Profile Information</span>
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">Update your display name, contact phone, and avatar photo.</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data" class="space-y-5" x-data="{ avatarPreview: '{{ $userPhoto }}' }">
                            @csrf

                            <!-- Avatar Preview & Upload -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-center gap-5">
                                <div class="relative shrink-0">
                                    <img :src="avatarPreview" 
                                         alt="{{ $user->name }}" 
                                         class="w-20 h-20 rounded-full object-cover border-2 border-emerald-500/40 shadow">
                                </div>
                                <div class="space-y-1.5 text-center sm:text-left flex-1">
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                        Profile Picture / Avatar
                                    </label>
                                    <input type="file" 
                                           name="image" 
                                           accept="image/*"
                                           @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => avatarPreview = e.target.result; reader.readAsDataURL(file); }"
                                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                                    <span class="text-[11px] text-slate-400 block">PNG, JPG, or WebP up to 2MB.</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Full Name <span class="text-emerald-600">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                            <i class="fa-solid fa-user text-sm"></i>
                                        </div>
                                        <input type="text" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required 
                                               class="auth-input">
                                    </div>
                                    @error('name')
                                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Phone / WhatsApp Number
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                            <i class="fa-solid fa-phone text-sm"></i>
                                        </div>
                                        <input type="text" 
                                               name="phone" 
                                               value="{{ old('phone', $user->phone) }}" 
                                               placeholder="+1 (555) 000-0000"
                                               class="auth-input">
                                    </div>
                                    @error('phone')
                                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Email Address <span class="text-slate-400 font-normal">(Primary account login identifier)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-envelope text-sm"></i>
                                    </div>
                                    <input type="email" 
                                           value="{{ $user->email }}" 
                                           disabled 
                                           class="auth-input bg-slate-100 text-slate-400 cursor-not-allowed">
                                </div>
                                <span class="text-[11px] text-slate-400 mt-1 block">Contact administration to change your verified primary email.</span>
                            </div>

                            <div class="pt-2">
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-emerald-600/25 transition cursor-pointer">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Save Profile Details</span>
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

                <!-- TAB 5: PASSWORD & SECURITY -->
                <div x-show="activeTab === 'security'" x-transition class="space-y-6" style="display: none;">
                    
                    <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6">
                        
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                                    <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                                    <span>Update Account Password</span>
                                </h3>
                                <p class="text-xs text-slate-500 mt-0.5">Ensure your account uses a strong password of at least 8 characters.</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('account.password') }}" class="space-y-5" x-data="{ showCurr: false, showNew: false, showConf: false }">
                            @csrf

                            <!-- Current Password -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Current Password <span class="text-emerald-600">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-lock text-sm"></i>
                                    </div>
                                    <input :type="showCurr ? 'text' : 'password'" 
                                           name="current_password" 
                                           required 
                                           placeholder="••••••••"
                                           class="auth-input pr-10">
                                    <button type="button" 
                                            @click="showCurr = !showCurr" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                                        <i :class="showCurr ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    New Password <span class="text-emerald-600">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-key text-sm"></i>
                                    </div>
                                    <input :type="showNew ? 'text' : 'password'" 
                                           name="password" 
                                           required 
                                           placeholder="••••••••"
                                           class="auth-input pr-10">
                                    <button type="button" 
                                            @click="showNew = !showNew" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                                        <i :class="showNew ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Confirm New Password <span class="text-emerald-600">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-key text-sm"></i>
                                    </div>
                                    <input :type="showConf ? 'text' : 'password'" 
                                           name="password_confirmation" 
                                           required 
                                           placeholder="••••••••"
                                           class="auth-input pr-10">
                                    <button type="button" 
                                            @click="showConf = !showConf" 
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                                        <i :class="showConf ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 hover:bg-black text-white font-extrabold text-xs sm:text-sm shadow-md transition cursor-pointer">
                                    <i class="fa-solid fa-lock"></i>
                                    <span>Update Password</span>
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Order Detail Modal -->
    <div x-show="orderModalOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        
        <div @click.outside="closeOrderModal()" 
             class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-5 shadow-2xl border border-slate-200 relative">
            
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                        <i class="fa-solid fa-receipt"></i>
                    </span>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900" x-text="'Order #' + (selectedOrder ? selectedOrder.id : '')"></h3>
                        <span class="text-[11px] text-slate-400" x-text="selectedOrder ? selectedOrder.date : ''"></span>
                    </div>
                </div>
                <button type="button" @click="closeOrderModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs" x-show="selectedOrder">
                
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="text-slate-400 font-semibold block uppercase tracking-wider text-[10px]">Product / Service</span>
                    <strong class="text-slate-900 block text-xs" x-text="selectedOrder ? selectedOrder.subject : ''"></strong>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-slate-400 font-semibold block text-[10px] uppercase tracking-wider">Total Quantity</span>
                        <strong class="text-slate-900 block font-black text-sm" x-text="(selectedOrder ? selectedOrder.qty : '1') + ' accounts'"></strong>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                        <span class="text-slate-400 font-semibold block text-[10px] uppercase tracking-wider">Amount Paid</span>
                        <strong class="text-emerald-700 block font-black text-sm" x-text="'$' + (selectedOrder ? selectedOrder.price : '0.00')"></strong>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="text-slate-400 font-semibold block text-[10px] uppercase tracking-wider">Payment Method</span>
                    <strong class="text-slate-900 block font-bold" x-text="selectedOrder ? selectedOrder.method : ''"></strong>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-1">
                    <span class="text-slate-400 font-semibold block text-[10px] uppercase tracking-wider">Order Delivery Notes</span>
                    <p class="text-slate-700 text-[11px] leading-relaxed max-h-36 overflow-y-auto font-mono whitespace-pre-wrap" x-text="selectedOrder ? selectedOrder.notes : ''"></p>
                </div>

            </div>

            <div class="pt-2 flex items-center justify-between">
                <a :href="'https://wa.me/{{ $rawPhone }}?text=Hello%20AccueVault%20Support,%20regarding%20Order%20%23' + (selectedOrder ? selectedOrder.id : '')" 
                   target="_blank" 
                   class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Contact Support On WhatsApp</span>
                </a>
                <button type="button" @click="closeOrderModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs cursor-pointer">
                    Close
                </button>
            </div>

        </div>

    </div>

</div>

@endsection
