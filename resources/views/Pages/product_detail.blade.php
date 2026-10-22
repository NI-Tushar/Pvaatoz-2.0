@extends('layouts.app')
@section('title', ($product->product_name ?? 'Product Details') . ' | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .glass-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.85);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04), 0 4px 10px -3px rgba(0, 0, 0, 0.02);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .glass-card:hover {
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.07), 0 6px 15px -3px rgba(16, 185, 129, 0.08);
    }
    .tier-card {
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .tier-card:hover {
        transform: translateY(-2px);
    }
    .custom-gradient-mesh {
        background-color: #0f172a;
        background-image: 
            radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.25) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(6, 78, 59, 0.35) 0px, transparent 50%);
    }
</style>
@endpush

@section('app-content')

@php
    // Prepare parsed feature list
    $features = [];
    if (!empty($product->feature_list)) {
        if (is_array($product->feature_list)) {
            $features = $product->feature_list;
        } else {
            $features = preg_split('/[\r\n,]+/', (string) $product->feature_list, -1, PREG_SPLIT_NO_EMPTY);
            $features = array_map('trim', $features);
        }
    }

    if (empty($features)) {
        $features = [
            '100% Phone Verified with Real Physical SIMs',
            'Registered via Clean Residential IPs Worldwide',
            'Full Credentials & Active Recovery Email Included',
            'Fresh Creation & High Trust Score History',
            'Pre-Tested for Social Automation & Marketing',
            'Instant Excel / CSV Credentials Delivery',
            '48-Hour Replacement Guarantee Against Disables'
        ];
    }

    $brandColor = !empty($product->bg_color_1) ? $product->bg_color_1 : '#10b981';
    $bgColor1 = !empty($product->bg_color_1) ? $product->bg_color_1 : '#064e3b';
    $bgColor2 = !empty($product->bg_color_2) ? $product->bg_color_2 : '#022c22';

    // Helper function for hex to rgb
    $hexToRgb = function($hex) {
        $hex = ltrim($hex, '#');
        if (strlen($hex) == 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        if (strlen($hex) != 6) {
            return '16, 185, 129';
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return "{$r}, {$g}, {$b}";
    };
    $brandRgb = $hexToRgb($brandColor);
    $bg1Rgb = $hexToRgb($bgColor1);
    $bg2Rgb = $hexToRgb($bgColor2);

    $contactEmail = $configer?->email ?? 'support@accuevault.com';
    $orderMailSubject = rawurlencode('Order Inquiry for ' . $product->product_name);
    $orderMailBody = rawurlencode('Hello ' . ($configer?->name ?? 'AccueVault') . ",\n\nI want to order " . $product->product_name . ".\nPlease send me available packages and payment details.\n\nThank you!");
    $mailtoLink = "mailto:{$contactEmail}?subject={$orderMailSubject}&body={$orderMailBody}";

    $rawPhone = preg_replace('/[^0-9]/', '', $configer?->phone ?? '15550192834');
    if (empty($rawPhone)) {
        $rawPhone = '15550192834';
    }
    $whatsappLink = "https://wa.me/{$rawPhone}?text=" . rawurlencode('Hello, I want to purchase ' . $product->product_name . '. Please send package details.');
@endphp

<div class="bg-gradient-to-b from-slate-50 via-white to-slate-50 text-slate-800 antialiased min-h-screen pb-24 font-['Inter',sans-serif]">

    <!-- Full-Width Hero Banner Section with Dynamic Product Shade -->
    <section class="relative w-full overflow-hidden pt-28 sm:pt-36 pb-16 sm:pb-20 border-b"
             style="border-bottom-color: rgba({{ $brandRgb }}, 0.25);">
        <!-- Background Image with Dark Blur Effect (Full Width) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <img src="{{ asset('Frontend/images/product-banner.jpg') }}" 
                 alt="{{ $product->product_name }} Banner" 
                 class="w-full h-full object-cover object-center scale-110 filter blur-sm">
            <!-- Full-Width Dark Gradient Overlay with Dynamic Product Tint -->
            <div class="absolute inset-0"
                 style="background: linear-gradient(to right, rgba(2, 6, 23, 0.72), rgba({{ $bg1Rgb }}, 0.65), rgba(2, 6, 23, 0.72)); mix-blend-mode: multiply;"></div>
            <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>
            
            <!-- Dynamic Glowing Orbs matching Product Color -->
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[400px] rounded-full blur-3xl pointer-events-none"
                 style="background-color: {{ $brandColor }}; opacity: 0.22;"></div>
            <div class="absolute -bottom-20 left-10 w-[400px] h-[300px] rounded-full blur-3xl pointer-events-none"
                 style="background-color: {{ $brandColor }}; opacity: 0.15;"></div>
        </div>

        <!-- Foreground Content (Left Big Product Image + Right Text Content) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- LEFT SIDE: Product Image In Big Size (4-5 cols) -->
                <div class="lg:col-span-4 xl:col-span-4 flex justify-center lg:justify-start">
                    <div class="relative w-56 h-56 sm:w-64 sm:h-64 lg:w-72 lg:h-72 rounded-3xl p-6 sm:p-8 flex items-center justify-center shadow-2xl overflow-hidden border border-white/20 group backdrop-blur-md shrink-0"
                         style="background: linear-gradient(135deg, {{ $bgColor1 }}, {{ $bgColor2 }});">
                        
                        <!-- Ambient Radial Glow -->
                        <div class="absolute w-44 h-44 rounded-full blur-2xl opacity-50 pointer-events-none"
                             style="background-color: {{ $brandColor }};"></div>
                        
                        <!-- Subtle Pattern Overlay -->
                        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:14px_14px] pointer-events-none"></div>

                        <!-- Tag Badge Floating Inside Canvas with Dynamic Color -->
                        @if($product->tag)
                            <div class="absolute top-3.5 left-3.5 z-20">
                                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-black/50 backdrop-blur-md shadow-sm"
                                      style="color: {{ $brandColor }}; border: 1px solid rgba({{ $brandRgb }}, 0.45);">
                                    <i class="fa-solid fa-shield-check text-[9px]"></i>
                                    {{ $product->tag }}
                                </span>
                            </div>
                        @endif

                        <!-- Product Logo in Big Size -->
                        @if($product->product_logo)
                            <img src="{{ asset('storage/' . $product->product_logo) }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="relative z-10 max-h-36 sm:max-h-44 max-w-full object-contain filter drop-shadow-[0_15px_30px_rgba(0,0,0,0.65)] group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.onerror=null; this.src='{{ asset('no_image.jpg') }}';">
                        @else
                            <div class="relative z-10 text-center text-white">
                                <div class="w-20 h-20 mx-auto mb-2.5 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-lg">
                                    <i class="fa-solid fa-layer-group text-3xl" style="color: {{ $brandColor }};"></i>
                                </div>
                                <p class="font-extrabold text-base tracking-wide text-white drop-shadow">{{ $product->product_name }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT SIDE: Text Content (8 cols) -->
                <div class="lg:col-span-8 xl:col-span-8 text-left space-y-4">
                    
                    <!-- Breadcrumbs on Dark Banner with Dynamic Product Tint -->
                    <nav class="flex items-center justify-start gap-2 text-xs sm:text-sm text-white/75 overflow-x-auto whitespace-nowrap py-1">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors flex items-center gap-1.5 font-medium">
                            <i class="fa-solid fa-house text-xs" style="color: {{ $brandColor }};"></i>
                            <span>Home</span>
                        </a>
                        <i class="fa-solid fa-chevron-right text-[10px] text-white/40"></i>
                        <a href="{{ route('home') }}#products" class="hover:text-white transition-colors text-white/90 font-medium">
                            {{ ucwords(str_replace('_', ' ', $product->category ?? 'PVA Accounts')) }}
                        </a>
                        <i class="fa-solid fa-chevron-right text-[10px] text-white/40"></i>
                        <span class="text-white font-semibold">{{ $product->product_name }}</span>
                    </nav>

                    <!-- Category & Status Badges with Dynamic Product Tint -->
                    <div class="flex flex-wrap items-center justify-start gap-2 pt-1">
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3.5 py-1 rounded-full shadow-sm backdrop-blur-md"
                              style="background-color: rgba({{ $brandRgb }}, 0.18); border: 1px solid rgba({{ $brandRgb }}, 0.35); color: {{ $brandColor }};">
                            <i class="fa-solid fa-shield-check" style="color: {{ $brandColor }};"></i>
                            {{ $product->category ? ucwords(str_replace('_', ' ', $product->category)) : 'Premium PVA' }} • Verified Stock
                        </span>
                        @if($product->popularity && $product->popularity != 'normal')
                            <span class="inline-flex items-center gap-1 text-xs font-extrabold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm {{ $product->popularity == 'hot' ? 'bg-gradient-to-r from-red-600 to-rose-500 text-white animate-pulse' : 'bg-gradient-to-r from-amber-500 to-orange-500 text-white' }}">
                                <i class="fa-solid fa-fire text-xs"></i>
                                {{ ucfirst($product->popularity) }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Main Product Heading -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight drop-shadow-md text-left">
                        {{ $product->product_name }}
                    </h1>

                    <!-- Subtitle / Short Description -->
                    <p class="text-sm sm:text-base text-slate-200/90 leading-relaxed max-w-2xl font-normal drop-shadow-sm text-left">
                        {{ $product->short_description ?? '100% Phone Verified Real Physical SIM Accounts with Instant Delivery & 48-Hour Replacement Guarantee.' }}
                    </p>

                    <!-- Trust Highlights Badges in Banner with Dynamic Product Accent -->
                    <div class="flex flex-wrap items-center justify-start gap-2 sm:gap-3 text-xs font-semibold text-slate-200 pt-1">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm text-white/95">
                            <i class="fa-solid fa-bolt" style="color: {{ $brandColor }};"></i> Instant Auto-Delivery
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm text-white/95">
                            <i class="fa-solid fa-sim-card" style="color: {{ $brandColor }};"></i> Real Physical SIMs
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm text-white/95">
                            <i class="fa-solid fa-shield-halved" style="color: {{ $brandColor }};"></i> 48-Hour Warranty
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white/10 border border-white/15 backdrop-blur-sm text-white/95">
                            <i class="fa-solid fa-globe" style="color: {{ $brandColor }};"></i> Clean Residential IPs
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Main Product Details Container -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl pt-10 sm:pt-12">
        <!-- Back Link Navigation -->
        <div class="flex items-center justify-between mb-8">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Product Specifications & Order Configuration</span>
            <a href="{{ route('home') }}#products" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-600 bg-white px-3.5 py-1.5 rounded-full border border-slate-200 shadow-sm transition">
                <i class="fa-solid fa-arrow-left text-[11px]"></i>
                <span>Back to Catalog</span>
            </a>
        </div>

        <!-- Main Product Section: Two Column Content Layout (No Redundant Image Box) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 mb-16 items-start">
            
            <!-- MAIN CONTENT AREA (Left 8 Cols): Order Configuration + Account Description & Features -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Card 1: Interactive Order & Pricing Configuration (Alpine.js) -->
                <div x-data="{ 
                        qty: 10,
                        baseUnitPrice: 0.85,
                        get discountRate() {
                            if (this.qty >= 100) return 0.25;
                            if (this.qty >= 50) return 0.15;
                            if (this.qty >= 25) return 0.10;
                            return 0;
                        },
                        get effectiveUnitPrice() {
                            return (this.baseUnitPrice * (1 - this.discountRate)).toFixed(2);
                        },
                        get originalTotalPrice() {
                            return (this.qty * this.baseUnitPrice).toFixed(2);
                        },
                        get totalPrice() {
                            return (this.qty * this.baseUnitPrice * (1 - this.discountRate)).toFixed(2);
                        },
                        get savedAmount() {
                            return (this.originalTotalPrice - this.totalPrice).toFixed(2);
                        }
                    }" 
                    class="glass-card rounded-3xl p-6 sm:p-8 space-y-6 border border-slate-200/90 shadow-sm hover:shadow-md transition">
                    
                    <!-- Section Header -->
                    <div class="flex items-center justify-between flex-wrap gap-3 pb-5 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full inline-flex items-center gap-1.5 mb-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                In Stock • Instant Dispatch
                            </span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Configure Your Order Package</h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Select your preferred batch quantity. Automatic bulk volume discounts apply at checkout.</p>
                        </div>

                        <div class="text-right hidden sm:block">
                            <span class="text-[11px] text-slate-400 uppercase tracking-wider font-semibold block">Starting Price</span>
                            <span class="text-lg font-black text-emerald-700">$0.85 <span class="text-xs text-slate-400 font-normal">/account</span></span>
                        </div>
                    </div>

                    <!-- Quantity Package Selection -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-800 flex items-center gap-1.5">
                                <i class="fa-solid fa-cubes-stacked text-emerald-600"></i>
                                Select Quantity Tier:
                            </label>
                            
                            <template x-if="discountRate > 0">
                                <span class="text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full flex items-center gap-1 shadow-2xs">
                                    <i class="fa-solid fa-tag text-emerald-600"></i>
                                    <span x-text="(discountRate * 100) + '% Volume Discount Unlocked'"></span>
                                </span>
                            </template>
                        </div>

                        <!-- Tier Cards Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <!-- 10 Pack -->
                            <button type="button" 
                                    @click="qty = 10" 
                                    :class="qty === 10 ? 'border-emerald-600 bg-emerald-50/80 text-emerald-950 ring-2 ring-emerald-500/20 shadow-sm' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/50'"
                                    class="tier-card p-3.5 sm:p-4 rounded-2xl border text-center transition-all cursor-pointer relative overflow-hidden flex flex-col justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Starter Pack</span>
                                <span class="text-base sm:text-lg font-black block text-slate-900">10 Accounts</span>
                                <span class="text-xs font-semibold text-slate-500 mt-1.5 block">$0.85 <span class="text-[10px] font-normal">/ea</span></span>
                            </button>

                            <!-- 25 Pack -->
                            <button type="button" 
                                    @click="qty = 25" 
                                    :class="qty === 25 ? 'border-emerald-600 bg-emerald-50/80 text-emerald-950 ring-2 ring-emerald-500/20 shadow-sm' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/50'"
                                    class="tier-card p-3.5 sm:p-4 rounded-2xl border text-center transition-all cursor-pointer relative overflow-hidden flex flex-col justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Save 10%</span>
                                <span class="text-base sm:text-lg font-black block text-slate-900">25 Accounts</span>
                                <span class="text-xs font-semibold text-emerald-700 mt-1.5 block">$0.77 <span class="text-[10px] font-normal">/ea</span></span>
                            </button>

                            <!-- 50 Pack -->
                            <button type="button" 
                                    @click="qty = 50" 
                                    :class="qty === 50 ? 'border-emerald-600 bg-emerald-50/80 text-emerald-950 ring-2 ring-emerald-500/20 shadow-sm' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/50'"
                                    class="tier-card p-3.5 sm:p-4 rounded-2xl border text-center transition-all cursor-pointer relative overflow-hidden flex flex-col justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Popular • 15%</span>
                                <span class="text-base sm:text-lg font-black block text-slate-900">50 Accounts</span>
                                <span class="text-xs font-semibold text-emerald-700 mt-1.5 block">$0.72 <span class="text-[10px] font-normal">/ea</span></span>
                            </button>

                            <!-- 100 Pack -->
                            <button type="button" 
                                    @click="qty = 100" 
                                    :class="qty === 100 ? 'border-emerald-600 bg-emerald-50/80 text-emerald-950 ring-2 ring-emerald-500/20 shadow-sm' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50/50'"
                                    class="tier-card p-3.5 sm:p-4 rounded-2xl border text-center transition-all cursor-pointer relative overflow-hidden flex flex-col justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-rose-600 font-extrabold block mb-1">Best Value • 25%</span>
                                <span class="text-base sm:text-lg font-black block text-slate-900">100+ Pack</span>
                                <span class="text-xs font-semibold text-emerald-700 mt-1.5 block">$0.64 <span class="text-[10px] font-normal">/ea</span></span>
                            </button>
                        </div>
                    </div>

                    <!-- Price Breakdown & Summary Card -->
                    <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-emerald-500/10 via-emerald-50/50 to-teal-50/40 border border-emerald-200/90 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <span class="text-xs font-medium text-slate-500 block">Total Calculated Order Price</span>
                            <div class="flex items-baseline gap-2.5 mt-0.5">
                                <span class="text-3xl sm:text-4xl font-black text-emerald-800 tracking-tight" x-text="'$' + totalPrice"></span>
                                
                                <template x-if="discountRate > 0">
                                    <span class="text-sm font-semibold text-slate-400 line-through" x-text="'$' + originalTotalPrice"></span>
                                </template>

                                <span class="text-xs text-slate-600 font-semibold" x-text="'(' + qty + ' accounts @ $' + effectiveUnitPrice + '/ea)'"></span>
                            </div>

                            <template x-if="discountRate > 0">
                                <p class="text-xs text-emerald-700 font-bold mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-sparkles text-[11px]"></i>
                                    You save <span x-text="'$' + savedAmount"></span> on this package!
                                </p>
                            </template>
                        </div>

                        <div class="text-left sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 w-full sm:w-auto">
                            <div class="inline-flex items-center gap-1.5 text-xs text-emerald-800 bg-white/90 border border-emerald-200 px-3.5 py-1.5 rounded-xl shadow-xs font-bold">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                                <span>Guaranteed Active Stock</span>
                            </div>
                            <span class="text-[11px] text-slate-500 block mt-1">Automatic verification prior to dispatch</span>
                        </div>
                    </div>

                    <!-- Primary Action Buttons (Add to Cart & Direct Checkout) -->
                    <div class="space-y-3 pt-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <!-- Add to Cart Button -->
                            <button type="button" 
                                    @click="window.AccueCart && window.AccueCart.add({
                                        id: {{ $product->id }},
                                        product_name: '{{ addslashes($product->product_name) }}',
                                        category: '{{ addslashes($product->category) }}',
                                        tag: '{{ addslashes($product->tag ?? '100% PVA') }}',
                                        product_logo: '{{ $product->product_logo ? asset('storage/' . $product->product_logo) : asset('no_image.jpg') }}',
                                        bg_color_1: '{{ $product->bg_color_1 ?? '#064e3b' }}',
                                        bg_color_2: '{{ $product->bg_color_2 ?? '#022c22' }}',
                                        product_color: '{{ $product->product_color ?? '#10b981' }}',
                                        unit_price: effectiveUnitPrice
                                    }, qty, $event)"
                                    class="flex items-center justify-center gap-2.5 bg-white hover:bg-emerald-50/60 text-emerald-800 border-2 border-emerald-600 font-extrabold py-4 px-6 rounded-2xl transition-all duration-200 text-center cursor-pointer shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
                                <i class="fa-solid fa-cart-plus text-lg text-emerald-600"></i>
                                <span>Add to Cart</span>
                            </button>

                            <!-- Direct Checkout Button -->
                            <a href="{{ route('checkout', $product->id) }}"
                               class="flex items-center justify-center gap-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/40 transition-all duration-200 text-center transform hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
                                <i class="fa-solid fa-bolt text-amber-300"></i>
                                <span>Buy Now Instantly</span>
                            </a>
                        </div>

                        <!-- Direct Order Channels -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <a href="{{ $whatsappLink }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-center gap-2 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 hover:border-emerald-300 font-bold py-3 px-4 rounded-xl transition text-center text-xs sm:text-sm">
                                <i class="fa-brands fa-whatsapp text-lg text-emerald-600"></i>
                                <span>Order via WhatsApp</span>
                            </a>

                            <a href="{{ $mailtoLink }}" 
                               class="flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-bold py-3 px-4 rounded-xl transition text-center text-xs sm:text-sm">
                                <i class="fa-solid fa-envelope text-slate-500"></i>
                                <span>Order via Email</span>
                            </a>
                        </div>
                    </div>

                    <!-- Accepted Payment Methods & Security -->
                    <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-slate-500 text-xs">
                        <span class="font-bold text-slate-700 flex items-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                            Accepted Payment Methods:
                        </span>
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                            <span class="flex items-center gap-1 text-slate-600 font-medium bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200/60">
                                <i class="fa-brands fa-bitcoin text-amber-500 text-xs"></i> USDT / Crypto
                            </span>
                            <span class="flex items-center gap-1 text-slate-600 font-medium bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200/60">
                                <i class="fa-brands fa-paypal text-blue-600 text-xs"></i> PayPal
                            </span>
                            <span class="flex items-center gap-1 text-slate-600 font-medium bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200/60">
                                <i class="fa-regular fa-credit-card text-emerald-600 text-xs"></i> Visa / Card
                            </span>
                            <span class="flex items-center gap-1 text-slate-600 font-medium bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200/60">
                                <i class="fa-solid fa-building-columns text-teal-600 text-xs"></i> Wire Transfer
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Card 2: Full Product Overview & Features Included -->
                <div class="glass-card rounded-3xl p-6 sm:p-8 space-y-6 border border-slate-200/90 shadow-sm">
                    <div class="flex items-center justify-between gap-3 flex-wrap pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Product Details & Specs</span>
                            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">Account Overview & Quality Standards</h3>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                                {{ ucwords(str_replace('_', ' ', $product->category ?? 'PVA Account')) }}
                            </span>
                            <span class="text-xs font-medium text-slate-400 bg-slate-100 px-3 py-1 rounded-full">
                                SKU: #ACC-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        <p>
                            {{ $product->product_desc ?? 'Premium phone-verified PVA accounts registered via authentic residential IPs and dedicated SIMs. Includes full credentials, recovery email access, and clean activity record suitable for high-volume marketing, lead generation, and business operations.' }}
                        </p>
                    </div>

                    <!-- Key Account Features Checklist Grid -->
                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-emerald-600"></i>
                            Key Features & Guaranteed Inclusions:
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($features as $feature)
                                <div class="flex items-start gap-3 p-3 rounded-2xl bg-slate-50/80 border border-slate-200/70 hover:bg-emerald-50/40 hover:border-emerald-200 transition">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5 shadow-2xs">
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    </div>
                                    <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <!-- SIDEBAR COLUMN (Right 4 Cols): Specifications, Trust Guarantee & Volume Assistance -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                
                <!-- Quick Fulfillment Specifications Card -->
                <div class="glass-card rounded-3xl p-6 border border-slate-200/90 shadow-sm space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-gauge-high text-emerald-600 text-sm"></i>
                        Fulfillment Specifications
                    </h4>

                    <div class="space-y-3 pt-1">
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bolt text-lg"></i>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-500 block font-medium">Delivery Speed</span>
                                <span class="font-bold text-xs text-slate-800">1 - 5 Minutes Instant</span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-file-csv text-lg"></i>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-500 block font-medium">Delivered Format</span>
                                <span class="font-bold text-xs text-slate-800">Excel / CSV / Text File</span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-sim-card text-lg"></i>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-500 block font-medium">Authentication</span>
                                <span class="font-bold text-xs text-slate-800">Real Physical SIM Cards</span>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-network-wired text-lg"></i>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-500 block font-medium">Registration IP</span>
                                <span class="font-bold text-xs text-slate-800">Clean Residential Proxies</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Guarantee Pillars Card -->
                <div class="glass-card rounded-3xl p-6 space-y-4 border-emerald-100 bg-emerald-50/20 shadow-sm">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-award text-emerald-600 text-sm"></i>
                        The AccueVault Guarantee
                    </h4>
                    
                    <div class="space-y-3 pt-1">
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-rotate-left text-xs"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block text-xs">48-Hour Replacement Warranty</span>
                                <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">Immediate 1-to-1 account replacement if any login credential fails upon delivery.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-sim-card text-xs"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block text-xs">Non-VoIP Physical Numbers</span>
                                <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">Created only with real SIM cards from tier-1 telecom carriers worldwide.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-headset text-xs"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block text-xs">Dedicated Account Support</span>
                                <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">Direct WhatsApp & Email assistance with average under 10-minute response time.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wholesale / Bulk Inquiries Card -->
                <div class="p-6 rounded-3xl bg-slate-900 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full blur-2xl pointer-events-none"
                         style="background-color: {{ $brandColor }}; opacity: 0.35;"></div>
                    <div class="relative z-10 space-y-3">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-white/10 text-emerald-400 border border-white/15">
                            <i class="fa-solid fa-crown text-[9px]"></i> VIP Wholesale
                        </span>
                        <h4 class="text-base font-extrabold text-white">Need 250+ or Custom Volume?</h4>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            For agencies and high-volume marketing teams requiring specialized IP locations or custom batches, chat with our wholesale team.
                        </p>
                        <a href="{{ $whatsappLink }}"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-md">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Chat with Wholesale Desk</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <!-- Information Tabs Section -->
        <div x-data="{ 
                activeTab: 'specs',
                faqOpen: null,
                toggleFaq(index) {
                    this.faqOpen = this.faqOpen === index ? null : index;
                }
            }" 
            class="glass-card rounded-3xl overflow-hidden mb-16 shadow-md border border-slate-200/80">
            
            <!-- Tab Navigation Header -->
            <div class="flex border-b border-slate-200 bg-slate-50/70 overflow-x-auto text-xs sm:text-sm font-bold p-1.5 gap-1.5">
                <button type="button" 
                        @click="activeTab = 'specs'" 
                        :class="activeTab === 'specs' ? 'bg-white text-emerald-700 shadow-sm border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60'"
                        class="py-3 px-5 rounded-2xl transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                    <i class="fa-solid fa-list-check text-emerald-600"></i>
                    <span>Account Specifications</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'guidelines'" 
                        :class="activeTab === 'guidelines' ? 'bg-white text-emerald-700 shadow-sm border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60'"
                        class="py-3 px-5 rounded-2xl transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                    <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                    <span>Login & Proxy Guidelines</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'warranty'" 
                        :class="activeTab === 'warranty' ? 'bg-white text-emerald-700 shadow-sm border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60'"
                        class="py-3 px-5 rounded-2xl transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                    <i class="fa-solid fa-award text-emerald-600"></i>
                    <span>Replacement Policy</span>
                </button>

                <button type="button" 
                        @click="activeTab = 'faq'" 
                        :class="activeTab === 'faq' ? 'bg-white text-emerald-700 shadow-sm border border-slate-200/90' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100/60'"
                        class="py-3 px-5 rounded-2xl transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
                    <i class="fa-solid fa-circle-question text-emerald-600"></i>
                    <span>FAQ & Help</span>
                </button>
            </div>

            <!-- Tab Panels -->
            <div class="p-6 sm:p-8 text-slate-600 text-sm leading-relaxed bg-white">
                
                <!-- Tab 1: Specs & What You Receive -->
                <div x-show="activeTab === 'specs'" class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Detailed Account Structure & Delivered Package</h3>
                        <p class="text-slate-600">
                            Every <span class="font-semibold text-slate-900">{{ $product->product_name }}</span> provided by {{ $configer?->name ?? 'AccueVault' }} undergoes multi-stage verification. Accounts are individually generated on clean residential IP pools and verified with physical, authentic mobile network SIM cards.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-file-shield text-base"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 text-sm mb-1.5">Delivered Credentials</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Complete package includes Login ID/Username, Secure Generated Password, Associated Recovery Email, and recovery mail access password.
                            </p>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80">
                            <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-fingerprint text-base"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 text-sm mb-1.5">Zero Recycled History</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                100% fresh creation. Never shared or resold to multiple clients. Each batch is quarantined and checked before instant customer handoff.
                            </p>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-network-wired text-base"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 text-sm mb-1.5">Versatile Application</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Ready for social media automation tools, outreach pipelines, affiliate setups, developer sandbox testing, and multi-profile browsers.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Guidelines -->
                <div x-show="activeTab === 'guidelines'" style="display: none;" class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Recommended Setup & Login Best Practices</h3>
                        <p class="text-slate-600">
                            To ensure optimal longevity and protect your accounts against automated platform security triggers, follow these standard practices:
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3.5">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-globe text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Match Proxy Geolocation</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Use residential or 4G/5G mobile proxies matching the registered location to prevent geolocation suspicion.</p>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3.5">
                            <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-window-restore text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Use Anti-Detect Browsers</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Utilize tools such as AdsPower, Multilogin, Dolphin{anty}, or GoLogin to isolate browser fingerprints and cookies.</p>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3.5">
                            <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-temperature-arrow-up text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Gradual Warm-Up Period</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Avoid aggressive bulk operations (e.g., hundreds of posts or direct messages) within the initial 24 to 48 hours.</p>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3.5">
                            <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-cookie-bite text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Retain Session Cookies</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Do not repeatedly clear browser cache and cookies after successful login to maintain persistent trust scores.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Replacement Policy -->
                <div x-show="activeTab === 'warranty'" style="display: none;" class="space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Our 48-Hour Full Replacement Guarantee</h3>
                        <p class="text-slate-600">
                            We pride ourselves on 100% verified deliverability. If any credential provided by {{ $configer?->name ?? 'AccueVault' }} encounters issues upon initial handoff, we make it right immediately.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-emerald-950 space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">1</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-emerald-950">Immediate 1-to-1 Replacement</h4>
                                <p class="text-xs text-emerald-800 mt-0.5 leading-relaxed">Any account failing login authentication, showing password mismatch, or disabled on first login will be replaced at zero cost.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">2</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-emerald-950">Frictionless Claim Verification</h4>
                                <p class="text-xs text-emerald-800 mt-0.5 leading-relaxed">Simply message our support team on WhatsApp or Email with your Order ID and a screenshot of the login prompt.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">3</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-emerald-950">48-Hour Coverage Window</h4>
                                <p class="text-xs text-emerald-800 mt-0.5 leading-relaxed">Warranty is active for 48 hours following delivery to give you ample time to inspect and load credentials.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: FAQ (Accordion) -->
                <div x-show="activeTab === 'faq'" style="display: none;" class="space-y-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Frequently Asked Questions</h3>
                        <p class="text-slate-600">Find quick answers to common questions regarding ordering and account usage.</p>
                    </div>

                    <div class="space-y-3">
                        
                        <!-- Question 1 -->
                        <div class="border border-slate-200/90 rounded-2xl overflow-hidden bg-slate-50/50">
                            <button type="button" 
                                    @click="toggleFaq(1)" 
                                    class="w-full py-4 px-5 text-left flex items-center justify-between font-bold text-slate-900 text-xs sm:text-sm hover:bg-slate-100/50 transition">
                                <span>How quickly will I receive my accounts after checkout?</span>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200" :class="faqOpen === 1 ? 'rotate-180 text-emerald-600' : ''"></i>
                            </button>
                            <div x-show="faqOpen === 1" x-collapse class="px-5 pb-4 pt-1 text-xs text-slate-600 border-t border-slate-100 leading-relaxed bg-white">
                                Most orders are fulfilled automatically within 1 to 5 minutes following payment confirmation. You will receive an email containing a downloadable Excel (.xlsx) and CSV file with full credential lists.
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="border border-slate-200/90 rounded-2xl overflow-hidden bg-slate-50/50">
                            <button type="button" 
                                    @click="toggleFaq(2)" 
                                    class="w-full py-4 px-5 text-left flex items-center justify-between font-bold text-slate-900 text-xs sm:text-sm hover:bg-slate-100/50 transition">
                                <span>Are the SIM phone numbers reused or virtual VoIP numbers?</span>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200" :class="faqOpen === 2 ? 'rotate-180 text-emerald-600' : ''"></i>
                            </button>
                            <div x-show="faqOpen === 2" x-collapse class="px-5 pb-4 pt-1 text-xs text-slate-600 border-t border-slate-100 leading-relaxed bg-white">
                                Absolutely not. We exclusively verify our accounts with genuine physical telecom carrier SIM cards. We never use shared virtual or VoIP numbers that could risk suspension.
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="border border-slate-200/90 rounded-2xl overflow-hidden bg-slate-50/50">
                            <button type="button" 
                                    @click="toggleFaq(3)" 
                                    class="w-full py-4 px-5 text-left flex items-center justify-between font-bold text-slate-900 text-xs sm:text-sm hover:bg-slate-100/50 transition">
                                <span>Can I request custom batch quantities (500+ accounts)?</span>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200" :class="faqOpen === 3 ? 'rotate-180 text-emerald-600' : ''"></i>
                            </button>
                            <div x-show="faqOpen === 3" x-collapse class="px-5 pb-4 pt-1 text-xs text-slate-600 border-t border-slate-100 leading-relaxed bg-white">
                                Yes! For wholesale orders exceeding 250 or 500 accounts, click the "Order via WhatsApp" button or email us directly for VIP tier pricing and reserved dedicated proxy setups.
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="border border-slate-200/90 rounded-2xl overflow-hidden bg-slate-50/50">
                            <button type="button" 
                                    @click="toggleFaq(4)" 
                                    class="w-full py-4 px-5 text-left flex items-center justify-between font-bold text-slate-900 text-xs sm:text-sm hover:bg-slate-100/50 transition">
                                <span>What payment methods are supported?</span>
                                <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform duration-200" :class="faqOpen === 4 ? 'rotate-180 text-emerald-600' : ''"></i>
                            </button>
                            <div x-show="faqOpen === 4" x-collapse class="px-5 pb-4 pt-1 text-xs text-slate-600 border-t border-slate-100 leading-relaxed bg-white">
                                We accept Crypto (USDT TRC20/ERC20, BTC, ETH), PayPal, Visa, Mastercard, and direct bank wire transfers. All payments are processed securely with SSL encryption.
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <!-- Related Products Section -->
        @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        <div class="mt-16">
            <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                <div>
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-3 py-1 rounded-full uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-sparkles text-emerald-600"></i>
                        Frequently Bought Together
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Complementary PVA Accounts</h2>
                    <p class="text-slate-500 text-xs sm:text-sm mt-1">Explore other verified accounts commonly bundled with {{ $product->product_name }}</p>
                </div>
                <a href="{{ route('home') }}#products" class="text-emerald-700 hover:text-emerald-800 font-bold text-xs sm:text-sm flex items-center gap-1.5 transition bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-xs">
                    <span>View All Accounts</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="group relative bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200/90 flex flex-col justify-between hover:border-emerald-300">
                        <div>
                            <!-- Tag Badge -->
                            <div class="absolute top-3.5 left-3.5 z-10">
                                <span class="bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-sm tracking-wide">
                                    {{ $related->tag ?? '100% PVA' }}
                                </span>
                            </div>

                            <!-- Image Container with Gradient -->
                            <a href="{{ route('product.detail', $related->id) }}"
                               style="background: linear-gradient(135deg, {{ $related->bg_color_1 ?? '#064e3b' }}, {{ $related->bg_color_2 ?? '#022c22' }});"
                               class="h-44 flex items-center justify-center p-2 block overflow-hidden relative">
                                
                                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px]"></div>

                                @if($related->product_logo)
                                    <img src="{{ asset('storage/' . $related->product_logo) }}" 
                                         alt="{{ $related->product_name }}"
                                         class="h-20 w-auto object-contain group-hover:scale-110 transition-transform duration-300 filter drop-shadow-md relative z-10"
                                         onerror="this.onerror=null; this.src='{{ asset('no_image.jpg') }}';">
                                @else
                                    <img src="{{ asset('no_image.jpg') }}" 
                                         alt="{{ $related->product_name }}"
                                         class="h-20 w-auto object-contain group-hover:scale-110 transition-transform duration-300 opacity-80 relative z-10">
                                @endif
                            </a>

                            <!-- Card Body -->
                            <div class="p-4">
                                <div class="flex items-center justify-between text-xs text-slate-400 mb-1.5">
                                    <span class="font-semibold text-emerald-700 uppercase tracking-wider text-[10px]">{{ ucwords(str_replace('_', ' ', $related->category ?? 'Account')) }}</span>
                                    <span class="flex items-center gap-1 text-amber-500 font-bold"><i class="fa-solid fa-star text-[10px]"></i> 4.9</span>
                                </div>

                                <h3 class="text-base font-extrabold text-slate-900 mb-1.5 truncate group-hover:text-emerald-700 transition-colors">
                                    <a href="{{ route('product.detail', $related->id) }}">
                                        {{ $related->product_name }}
                                    </a>
                                </h3>
                                
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                    {{ $related->product_desc ?? '100% phone verified PVA accounts with instant credentials delivery and recovery access.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-4 pt-0 mt-auto space-y-2">
                            <div class="flex items-center justify-between text-xs pb-3 border-t border-slate-100 pt-3">
                                <span class="text-slate-500">Starting from</span>
                                <span class="text-sm font-extrabold text-emerald-700">$0.85 <span class="text-[10px] text-slate-400 font-normal">/ea</span></span>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <button type="button"
                                        @click="window.AccueCart && window.AccueCart.add({
                                            id: {{ $related->id }},
                                            product_name: '{{ addslashes($related->product_name) }}',
                                            category: '{{ addslashes($related->category) }}',
                                            tag: '{{ addslashes($related->tag ?? '100% PVA') }}',
                                            product_logo: '{{ $related->product_logo ? asset('storage/' . $related->product_logo) : asset('no_image.jpg') }}',
                                            bg_color_1: '{{ $related->bg_color_1 ?? '#064e3b' }}',
                                            bg_color_2: '{{ $related->bg_color_2 ?? '#022c22' }}',
                                            product_color: '{{ $related->product_color ?? '#10b981' }}',
                                            unit_price: 0.85
                                        }, 10, $event)"
                                        class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 hover:border-emerald-300 text-xs font-bold transition">
                                    <i class="fa-solid fa-cart-plus text-emerald-600"></i>
                                    <span>Add</span>
                                </button>

                                <a href="{{ route('product.detail', $related->id) }}" 
                                   class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-xs">
                                    <span>Details</span>
                                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>

</div>

@endsection
