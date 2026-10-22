@extends('layouts.app')
@section('title', 'All Products | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .product-filter-pill {
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .product-filter-pill:hover {
        transform: translateY(-1px);
    }
    .pagination-custom .active span {
        background-color: #059669 !important;
        border-color: #059669 !important;
        color: #ffffff !important;
    }
</style>
@endpush

@section('app-content')

<div class="bg-slate-50 text-slate-800 antialiased min-h-screen pb-20 font-['Inter',sans-serif]">

    <!-- Full-Width Hero Banner Section with Dark Blur Effect -->
    <section class="relative w-full overflow-hidden pt-28 sm:pt-36 pb-16 sm:pb-20 border-b border-emerald-950/40">
        <!-- Background Image with Dark Blur Effect (Full Width) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <img src="{{ asset('Frontend/images/about-banner.jpg') }}" 
                 alt="All Products Banner" 
                 class="w-full h-full object-cover object-center scale-110 filter blur-sm">
            <!-- Full-Width Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/70 via-emerald-950/60 to-slate-950/70 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>
            
            <!-- Glowing Emerald Orbs -->
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[400px] bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 right-10 w-[400px] h-[300px] bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <!-- Foreground Banner Content (Centered Container) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10 text-center">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center justify-center gap-2 text-xs sm:text-sm text-emerald-200/70 mb-4 overflow-x-auto whitespace-nowrap py-1">
                <a href="{{ route('home') }}" class="hover:text-emerald-300 transition-colors flex items-center gap-1.5 font-medium">
                    <i class="fa-solid fa-house text-xs text-emerald-400"></i>
                    <span>Home</span>
                </a>
                <i class="fa-solid fa-chevron-right text-[10px] text-emerald-400/50"></i>
                <span class="text-white font-semibold">All Products</span>
            </nav>

            <!-- Trust Pill Badge -->
            <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs sm:text-sm font-bold px-4 py-1.5 rounded-full mb-4 shadow-sm backdrop-blur-md">
                <i class="fa-solid fa-shield-halved text-emerald-400"></i>
                <span>{{ $totalActiveCount }}+ Premium PVA & Aged Accounts Ready for Instant Delivery</span>
            </div>

            <!-- Page Title -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-3">
                Explore Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-300">Account Vault</span>
            </h1>

            <p class="text-emerald-100/80 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Browse our complete catalog of phone-verified, aged, and freshly created social media, email, and marketing accounts. Filter by category or search our inventory below.
            </p>
        </div>
    </section>

    <!-- Main Products Explorer Section -->
    <section class="py-10 lg:py-14">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

            <!-- Search & Filters Container Card -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-200/90 mb-8 transition-all">
                <form method="GET" action="{{ route('products') }}" id="products-filter-form" class="space-y-4">
                    
                    <!-- Search Bar Row -->
                    <div class="flex flex-col md:flex-row gap-3 items-stretch md:items-center justify-between">
                        <!-- Search Box -->
                        <div class="relative flex-1">
                            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none"></i>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by account name, category, or keyword (e.g. Gmail, PVA, Telegram)..." 
                                   class="w-full pl-11 pr-24 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 transition-all">
                            
                            @if(request('search'))
                                <a href="{{ route('products', array_merge(request()->except('search', 'page'))) }}" 
                                   class="absolute right-14 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400 hover:text-slate-600 transition"
                                   title="Clear search">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif

                            <button type="submit" 
                                    class="absolute right-2 top-1/2 -translate-y-1/2 px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition shadow-sm cursor-pointer flex items-center gap-1.5">
                                <span>Search</span>
                            </button>
                        </div>

                        <!-- Sort Controller Dropdown -->
                        <div class="flex items-center gap-2 shrink-0">
                            <label for="sort" class="text-xs font-bold text-slate-600 whitespace-nowrap">Sort By:</label>
                            <select name="sort" 
                                    id="sort" 
                                    onchange="document.getElementById('products-filter-form').submit()"
                                    class="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 cursor-pointer">
                                <option value="latest" @selected(request('sort', 'latest') == 'latest')>Newest First</option>
                                <option value="name_asc" @selected(request('sort') == 'name_asc')>Name: A to Z</option>
                                <option value="name_desc" @selected(request('sort') == 'name_desc')>Name: Z to A</option>
                                <option value="oldest" @selected(request('sort') == 'oldest')>Oldest First</option>
                            </select>
                        </div>
                    </div>

                    <!-- Preserve Category input in form if changed by pills -->
                    <input type="hidden" name="category" id="filter-category-input" value="{{ request('category', 'all') }}">

                    <!-- Category Pills List (Desktop & Tablet) -->
                    <div class="pt-2 border-t border-slate-100">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-layer-group text-emerald-600"></i>
                                Filter by Category
                            </span>
                            @if(request('category') && request('category') !== 'all' || request('search'))
                                <a href="{{ route('products') }}" 
                                   class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition flex items-center gap-1">
                                    <i class="fa-solid fa-rotate-left text-[11px]"></i>
                                    <span>Reset All Filters</span>
                                </a>
                            @endif
                        </div>

                        <!-- Category Buttons Bar -->
                        <div class="flex flex-wrap items-center gap-2">
                            <!-- "All Categories" Pill -->
                            <a href="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}"
                               class="product-filter-pill inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold border transition-all cursor-pointer {{ !request('category') || request('category') === 'all' ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm shadow-emerald-600/30' : 'bg-slate-50 hover:bg-slate-100 text-slate-700 border-slate-200' }}">
                                <span>All Accounts</span>
                                <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ !request('category') || request('category') === 'all' ? 'bg-emerald-700 text-white' : 'bg-slate-200 text-slate-600' }}">
                                    {{ $totalActiveCount }}
                                </span>
                            </a>

                            <!-- Specific Category Pills -->
                            @foreach($categories as $cat)
                                @php
                                    $catName = $cat->category;
                                    $isSelected = request('category') == $catName;
                                    $catLabel = ucwords(str_replace('_', ' ', $catName));
                                @endphp
                                <a href="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => $catName])) }}"
                                   class="product-filter-pill inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold border transition-all cursor-pointer {{ $isSelected ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm shadow-emerald-600/30' : 'bg-slate-50 hover:bg-slate-100 text-slate-700 border-slate-200' }}">
                                    <span>{{ $catLabel }}</span>
                                    <span class="px-1.5 py-0.5 rounded-full text-[10px] {{ $isSelected ? 'bg-emerald-700 text-white' : 'bg-slate-200 text-slate-600' }}">
                                        {{ $cat->count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </form>

                <!-- Active Filters Status Bar -->
                @if(request('search') || (request('category') && request('category') !== 'all'))
                    <div class="mt-4 pt-3 border-t border-slate-100 flex flex-wrap items-center gap-2 text-xs">
                        <span class="text-slate-500 font-medium">Active filters:</span>
                        
                        @if(request('search'))
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200 px-2.5 py-1 rounded-md font-semibold">
                                <span>Search: "{{ request('search') }}"</span>
                                <a href="{{ route('products', array_merge(request()->except('search', 'page'))) }}" class="hover:text-red-500 transition">
                                    <i class="fa-solid fa-xmark text-[11px]"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('category') && request('category') !== 'all')
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200 px-2.5 py-1 rounded-md font-semibold">
                                <span>Category: {{ ucwords(str_replace('_', ' ', request('category'))) }}</span>
                                <a href="{{ route('products', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" class="hover:text-red-500 transition">
                                    <i class="fa-solid fa-xmark text-[11px]"></i>
                                </a>
                            </span>
                        @endif

                        <span class="text-slate-400">({{ $products->total() }} results found)</span>
                    </div>
                @endif
            </div>

            <!-- Products Results Count Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 mb-6">
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">
                        @if(request('category') && request('category') !== 'all')
                            {{ ucwords(str_replace('_', ' ', request('category'))) }} Accounts
                        @else
                            All Verified Accounts
                        @endif
                    </h2>
                    <p class="text-xs text-slate-500">
                        Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products (20 per page)
                    </p>
                </div>
            </div>

            <!-- Product Cards Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    @foreach($products as $product)
                        <div onclick="window.location.href='{{ route('product.detail', $product->id) }}'"
                             class="group relative bg-white rounded-xl shadow-md hover:shadow-xl hover:border-emerald-500/50 transition-all duration-300 overflow-hidden border flex flex-col h-full cursor-pointer">
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 z-10 pointer-events-none">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                                    {{ $product->tag ?? '100% PVA' }}
                                </span>
                            </div>

                            @if($product->popularity && $product->popularity != 'normal')
                                <div class="absolute top-0 right-0 z-20 bg-transparent overflow-hidden w-20 h-20 pointer-events-none">
                                    <span class="absolute top-3 right-[-28px] rotate-45 
                                                bg-gradient-to-r from-red-600 via-red-500 to-rose-500
                                                text-white text-xs font-bold text-center
                                                w-32 py-1 shadow-lg pl-3">
                                        {{ $product->popularity }}
                                    </span>
                                </div>
                            @endif

                            <!-- Product Logo with dynamic gradient header -->
                            <div style="background: linear-gradient(135deg, {{ $product->bg_color_1 ?? '#064e3b' }}, {{ $product->bg_color_2 ?? '#022c22' }});"
                                 class="h-44 flex items-center justify-center overflow-hidden shrink-0">
                                <img src="{{ $product->product_logo ? asset('storage/' . $product->product_logo) : asset('no_image.jpg') }}"
                                     class="h-20 w-auto group-hover:scale-110 transition-transform duration-300 object-contain"
                                     alt="{{ $product->product_name ?? 'Product' }}"
                                     onerror="this.onerror=null; this.src='{{ asset('no_image.jpg') }}';">
                            </div>

                            <!-- Content Area -->
                            <div class="p-4 text-center flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">
                                    <span class="group-hover:text-emerald-600 transition-colors">
                                        {{ $product->product_name ?: (ucwords(str_replace('_', ' ', $product->category)) . ' PVA Account') }}
                                    </span>
                                </h3>

                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ $product->product_desc ?: 'High-quality phone verified PVA account ready for marketing and automation.' }}
                                </p>

                                <!-- Feature List (Left Aligned) -->
                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Phone Verified (PVA)
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Manually Created
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Instant Delivery
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Replacement Guarantee
                                    </li>
                                </ul>

                                <!-- Bottom Container: Pinned to bottom of the card -->
                                <div class="mt-auto pt-3 border-t border-slate-100">
                                    <!-- Price -->
                                    <div class="mb-3">
                                        <span class="text-2xl font-extrabold text-emerald-600">$0.35</span>
                                        <span class="text-sm text-gray-500">/ account</span>
                                    </div>

                                    <!-- Actions: Add to Cart & Buy Now -->
                                    <div class="grid grid-cols-2 gap-2">
                                        <!-- Add to Cart Button -->
                                        <button type="button" 
                                                onclick="window.AccueCart && window.AccueCart.add({
                                                    id: {{ $product->id }},
                                                    product_name: '{{ addslashes($product->product_name ?: (ucwords(str_replace('_', ' ', $product->category)) . ' PVA Account')) }}',
                                                    category: '{{ addslashes($product->category) }}',
                                                    tag: '{{ addslashes($product->tag ?? '100% PVA') }}',
                                                    product_logo: '{{ $product->product_logo ? asset('storage/' . $product->product_logo) : asset('no_image.jpg') }}',
                                                    bg_color_1: '{{ $product->bg_color_1 ?? '#064e3b' }}',
                                                    bg_color_2: '{{ $product->bg_color_2 ?? '#022c22' }}',
                                                    product_color: '{{ $product->product_color ?? '#10b981' }}',
                                                    unit_price: 0.85
                                                }, 10, event)"
                                                class="inline-flex items-center justify-center gap-1.5 w-full rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 py-2.5 font-semibold text-xs transition shadow-sm cursor-pointer"
                                                title="Add to Shopping Cart">
                                            <i class="fa-solid fa-cart-plus text-xs text-emerald-600 pointer-events-none"></i>
                                            <span class="pointer-events-none">Add to Cart</span>
                                        </button>

                                        <!-- Buy Now Button: Redirects to Checkout -->
                                        <a href="{{ route('checkout', $product->id) }}" 
                                           onclick="event.stopPropagation();"
                                           style="background-color:{{ $product->product_color ?? '#10b981' }};"
                                           class="inline-flex items-center justify-center gap-1.5 w-full rounded-lg hover:opacity-90 text-white py-2.5 font-semibold text-xs transition shadow cursor-pointer">
                                            <i class="fa-solid fa-bolt text-xs pointer-events-none"></i>
                                            <span class="pointer-events-none">Buy Now</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Container -->
                <div class="mt-8 flex flex-col items-center justify-center">
                    <div class="w-full flex justify-center">
                        {{ $products->links('vendor.pagination.tailwind') }}
                    </div>
                </div>

            @else
                <!-- No Results Empty State -->
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/90 shadow-sm max-w-2xl mx-auto my-12">
                    <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-3xl flex items-center justify-center mx-auto mb-5 text-3xl shadow-inner">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">No Products Found</h3>
                    <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                        We couldn't find any accounts matching your current search or category filter. Try refining your keywords or clearing the filter to view all products.
                    </p>
                    <a href="{{ route('products') }}" 
                       class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl transition shadow-md shadow-emerald-600/20">
                        <i class="fa-solid fa-rotate-left text-xs"></i>
                        <span>Reset All Filters</span>
                    </a>
                </div>
            @endif

        </div>
    </section>

</div>

@endsection
