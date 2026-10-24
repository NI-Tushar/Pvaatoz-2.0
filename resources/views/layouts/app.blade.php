
<!doctype html>
<html class="no-js" lang="zxx">
@php
    $configer = App\Models\Configer::latest()->first();
@endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Default') | {{ $configer?->name ?? config('app.name', 'AccueVault') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $siteFavicon = $configer?->logo_two 
            ? (str_starts_with($configer->logo_two, 'http') || str_starts_with($configer->logo_two, 'storage/') ? asset($configer->logo_two) : asset('storage/' . $configer->logo_two))
            : asset('small-logo.png');
        $siteLogo = $configer?->logo 
            ? (str_starts_with($configer->logo, 'http') || str_starts_with($configer->logo, 'storage/') ? asset($configer->logo) : asset('storage/' . $configer->logo))
            : null;
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $siteFavicon }}">
    <link rel="manifest" href="site.webmanifest">
    <meta name="keywords" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $siteFavicon }}">
    <link rel="apple-touch-icon" href="{{ $siteFavicon }}">

    <!-- Style & Responsive style sheet -->
    <!-- <link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}"> -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- _______________ FOR BANGLA Font-->
    <link href="https://cdn.msar.me/fonts/mukti/font.css" rel="stylesheet">

    <!-- Flipbook StyleSheet -->
    <link href="{{ url('front/dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500;700&family=Open+Sans:wght@300;400;500;700&family=Poppins:wght@200;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9f57283aa3.js" crossorigin="anonymous"></script>

    <!-- updated font list start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&family=Parkinsans:wght@300..800&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- updated font list end -->

    <!-- ________________ FOR BANGLA FONT STYLE START -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla&display=swap" rel="stylesheet">

    <!-- ________________ for theme -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/swiper/swiper-bundle.min.css') }}">
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/css/style.css') }}">

    <style>
        body{
             font-family: 'Anek Bangla', sans-serif !important;
             /* font-family: 'Hind Siliguri', sans-serif; */
             /* font-family: 'Tiro Bangla', serif !important; */
        }
        h1,h2,h3,h4,h5,h6,p,span,a,label,strong{
            font-family: 'Anek Bangla', sans-serif !important;
            /* font-family: 'Hind Siliguri', sans-serif; */
            /* font-family: 'Tiro Bangla', serif !important; */
        }
    </style>
    <!-- ________________ FOR BANGLA FONT STYLE START -->

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     
    <!-- for using tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- SweetAlert2 for modern confirmation alerts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <!-- Custom CSS for Animations (Replacing Tailwind Config) -->
    <!-- Custom CSS for Animations (Replacing Tailwind Config) -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 7s ease-in-out 3s infinite;
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        #header .logo, .logo {
            border-left: none !important;
            padding-left: 0 !important;
        }

        /* ================= Header Scroll Transitions & Styling ================= */
        #header {
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, height 0.3s ease !important;
        }

        /* 1. While scrolled down: Navbar background becomes white */
        #header.header-scrolled {
            background: #ffffff !important;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.04) !important;
        }

        /* 2. While scrolled down: Nav options color is black */
        #header.header-scrolled .navbar > ul > li > a,
        #header.header-scrolled .navbar > ul > li > a:focus {
            color: #000000 !important;
        }

        #header.header-scrolled .navbar > ul > li > a:hover,
        #header.header-scrolled .navbar > ul > li > a.active,
        #header.header-scrolled .navbar > ul > li > a.active:focus,
        #header.header-scrolled .navbar > ul > li:hover > a {
            color: var(--brand-green, #019546) !important;
        }

        /* Scrolled Header: Dropdown arrow icon becomes black */
        #header.header-scrolled .navbar .dropdown > a i,
        #header.header-scrolled .navbar .dropdown > a:focus i {
            color: #000000 !important;
        }

        #header.header-scrolled .navbar .dropdown:hover > a i {
            color: var(--brand-green, #019546) !important;
        }

        /* Scrolled Header: Mobile toggle icon becomes black */
        #header.header-scrolled .mobile-nav-toggle {
            color: #000000 !important;
        }

        /* Scrolled Header: Cart icon button on white background */
        #header.header-scrolled .cart-trigger-btn {
            background-color: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #000000 !important;
        }

        #header.header-scrolled .cart-trigger-btn:hover {
            background-color: #e2e8f0 !important;
            color: var(--brand-green, #019546) !important;
        }

        /* 3. While scrolled down: Remove the white background of the logo */
        .header-logo-container {
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease !important;
        }

        #header.header-scrolled .header-logo-container {
            background-color: transparent !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        /* If text logo is used, keep text readable on white background */
        #header.header-scrolled .logo a,
        #header.header-scrolled .logo h1 {
            color: #000000 !important;
        }

        /* Login / Auth & Profile Button Styles */
        .nav-login-btn {
            position: relative !important;
            z-index: 30 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
            color: #ffffff !important;
            border: 1px solid rgba(16, 185, 129, 0.4) !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25) !important;
            transition: all 0.2s ease-in-out !important;
            text-transform: none !important;
            text-decoration: none !important;
            cursor: pointer !important;
            pointer-events: auto !important;
        }

        .nav-login-btn * {
            pointer-events: none !important;
        }

        .nav-login-btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35) !important;
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .nav-profile-btn {
            position: relative !important;
            z-index: 30 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
        }

        .nav-profile-btn * {
            pointer-events: none !important;
        }

        .nav-logout-btn {
            background-color: rgba(6, 78, 59, 0.6);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #ffffff;
            transition: all 0.2s ease-in-out;
        }

        .nav-logout-btn:hover {
            background-color: #ef4444;
            border-color: #ef4444;
            color: #ffffff;
        }

        #header.header-scrolled .nav-logout-btn {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: #475569;
        }

        /* ================= Navbar Dropdown Text Left-Alignment ================= */
        .navbar .dropdown ul,
        .navbar .dropdown ul li,
        .navbar .dropdown ul a,
        .navbar .dropdown ul div,
        .navbar .dropdown ul span,
        .navbar-mobile .dropdown ul,
        .navbar-mobile .dropdown ul li,
        .navbar-mobile .dropdown ul a,
        .navbar-mobile .dropdown ul div,
        .navbar-mobile .dropdown ul span,
        .nav-profile-dropdown,
        .nav-profile-dropdown * {
            text-align: left !important;
        }

        .navbar .dropdown ul a,
        .navbar-mobile .dropdown ul a {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            text-align: left !important;
        }

        /* ================= Enforce Consistent 7xl Container Alignment ================= */
        .container,
        .container-fluid.max-w-7xl,
        .max-w-7xl {
            max-width: 80rem !important; /* Exactly 1280px (Tailwind max-w-7xl) */
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        @media (min-width: 1024px) {
            .container {
                max-width: 80rem !important;
                padding-left: 2rem !important;  /* px-8 (5rem gutter equivalent) */
                padding-right: 2rem !important; /* px-8 */
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            .container {
                padding-left: 1.5rem !important; /* px-6 */
                padding-right: 1.5rem !important; /* px-6 */
            }
        }

        @media (max-width: 639px) {
            .container {
                padding-left: 1rem !important; /* px-4 */
                padding-right: 1rem !important; /* px-4 */
            }
        }

        .container .container {
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    </style>

    @stack('css')
    @php
        $name = $configer?->name ?? config('app.name', 'AccueVault');
        $contact_num = $configer?->phone ?? '+1 (555) 019-2834';
        $contact_email = $configer?->email ?? 'support@accuevault.com';
        $address = $configer?->address ?? 'New York, USA';
        
        // website name
        if (strpos($name, ' ') !== false) {
            // If there is a space, split into 2 parts
            $nameParts = explode(' ', $name, 2);
            $firstWord = $nameParts[0];
            $secondWord = $nameParts[1];
            $fullName = $firstWord . $secondWord;
        } else {
            // No space: split the word in half
            $length = strlen($name);
            $mid = ceil($length / 2);
            $firstWord = substr($name, 0, $mid);
            $secondWord = substr($name, $mid);
            $fullName = $firstWord . $secondWord;
        }
        
        // product name for navbar
        use App\Models\Product;
        
        // Get active products, select id, name, category, order by name
        $products = Product::where('status', 'active')
        ->select('id', 'product_name', 'category', 'product_logo', 'bg_color_1', 'bg_color_2', 'product_color', 'tag')
        ->orderBy('product_name')
        ->get()
        ->groupBy('category'); // group by category using Collection 
    @endphp
</head>
<body>
    <div class="main">
        <!-- Header -->
        <header id="header" class="fixed-top d-flex align-items-center {{ Route::is('home') ? 'header-transparent' : 'header-scrolled' }}" style="{{ !Route::is('home') ? 'background: #021a14; border-bottom: 1px solid rgba(16, 185, 129, 0.2);' : '' }}">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl d-flex align-items-center justify-content-between">
                <div class="logo d-flex align-items-center py-1 flex-shrink-0">
                        <a href="{{ route('home') }}" class="header-logo-container d-flex align-items-center gap-2 rounded-lg p-2">
                            @if($siteLogo)
                                <img src="{{ $siteLogo }}" alt="{{ $name }}" class="img-fluid" style="max-height: 42px; object-fit: contain;" onerror="this.style.display='none'; document.getElementById('main-text-logo').style.display='inline-block';">
                                <h1 id="main-text-logo" class="logo mb-0" style="display:none;">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-400">{{ $firstWord }}</span>{{ $secondWord }}
                                </h1>
                            @else
                                <h1 class="logo mb-0">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-400">{{ $firstWord }}</span>{{ $secondWord }}
                                </h1>
                            @endif
                        </a>
                    </div>
                <div class="flex items-center justify-end md:justify-center flex-grow">

                        <nav id="navbar" class="navbar">
                            <ul>
                                <li><a class="nav-link tracking-[3px] {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                                <li><a class="nav-link tracking-[3px] {{ Route::is('products') ? 'active' : '' }}" href="{{ route('products') }}">All Products</a></li>
                                @foreach($products as $category => $items)
                                @php
                                    $catName = trim((string)$category);
                                    $hasCategory = !empty($catName) && strtolower($catName) !== 'others' && strtolower($catName) !== 'other';
                                    $displayCat = $hasCategory ? ucwords(str_replace('_', ' ', $catName)) : "Other's";
                                    $limitedItems = $items->take(6);
                                @endphp

                                @if(!$hasCategory)
                                    <li>
                                        <a class="nav-link tracking-[3px] {{ request('category') == 'others' ? 'active' : '' }}" href="{{ route('products') }}">
                                            {{ $displayCat }}
                                        </a>
                                    </li>
                                @else
                                    <li class="dropdown">
                                        <a href="#">
                                            <span class="font-semibold tracking-[2px]">{{ $displayCat }}</span>
                                            <i class="bi bi-chevron-down"></i>
                                        </a>
                                        <ul class="d-flex flex-column rounded shadow-2xl p-2 gap-1 text-start text-left"
                                            style="background-color: rgba(6, 30, 23, 0.96);
                                                backdrop-filter: blur(14px);
                                                -webkit-backdrop-filter: blur(14px);
                                                border: 1px solid rgba(16, 185, 129, 0.25);
                                                min-width: 280px;
                                                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
                                                text-align: left;">
                                            <div class="d-flex flex-column gap-1 text-start text-left" style="text-align: left;">
                                                @foreach($limitedItems as $product)
                                                <li style="min-width: 250px; text-align: left;" class="text-start text-left">
                                                    <a href="{{ route('product.detail', $product->id) }}"
                                                       class="d-flex align-items-center justify-content-start gap-3 text-white hover:!text-[#34d399] tracking-[1px] py-2 px-3 rounded-md transition-all group hover:bg-emerald-950/40 text-start text-left"
                                                       style="text-transform: none; text-align: left; justify-content: flex-start;">
                                                        
                                                        <!-- Left Side Product Image -->
                                                        <div class="d-flex align-items-center justify-content-center rounded overflow-hidden flex-shrink-0 transition-transform group-hover:scale-110"
                                                             style="width: 32px; height: 32px; background: linear-gradient(135deg, {{ $product->bg_color_1 ?? '#064e3b' }}, {{ $product->bg_color_2 ?? '#022c22' }}); border: 1px solid rgba(255,255,255,0.15);">
                                                            @if($product->product_logo)
                                                                <img src="{{ asset('storage/' . $product->product_logo) }}" 
                                                                     alt="{{ $product->product_name }}" 
                                                                     class="w-full h-full object-contain p-1"
                                                                     onerror="this.onerror=null; this.src='{{ asset('no_image.jpg') }}';">
                                                            @else
                                                                <img src="{{ asset('no_image.jpg') }}" 
                                                                     alt="{{ $product->product_name }}" 
                                                                     class="w-full h-full object-contain p-1 opacity-80">
                                                            @endif
                                                        </div>

                                                        <!-- Product Name & Tag -->
                                                        <div class="d-flex flex-column text-start text-left leading-tight overflow-hidden" style="text-align: left;">
                                                            <span class="font-medium text-slate-100 group-hover:text-emerald-400 text-sm truncate text-start text-left" style="text-align: left;">
                                                                {{ $product->product_name }}
                                                            </span>
                                                            @if($product->tag)
                                                                <span class="text-[10px] text-emerald-400 font-semibold tracking-wider uppercase mt-0.5 text-start text-left" style="text-align: left;">
                                                                    {{ $product->tag }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </div>

                                            <!-- Other's All Products Button -->
                                            <li class="pt-2 mt-1 border-t border-emerald-500/20" style="text-align: center;">
                                                <a href="{{ route('products', ['category' => $category]) }}" 
                                                   class="d-flex align-items-center justify-content-center gap-2 text-xs font-bold text-emerald-300 hover:text-white bg-emerald-900/60 hover:bg-emerald-600/80 py-2 px-3 rounded-md transition-all text-center tracking-wider uppercase shadow-xs"
                                                   style="text-transform: uppercase;">
                                                    <span>Other's All Products</span>
                                                    <i class="fa-solid fa-arrow-right text-[11px]"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @endforeach


                                <li>
                                    <a class="nav-link tracking-[3px] {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                                </li>

                                <li>
                                    <a class="nav-link tracking-[3px] {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                                </li>

                            </ul>

                            <i class="bi bi-list mobile-nav-toggle"></i>
                        </nav><!-- .navbar -->

                        <!-- Cart Trigger Button -->
                        <div class="ms-3 d-flex align-items-center relative z-20">
                            <button type="button" 
                                    onclick="window.AccueCart && window.AccueCart.open()"
                                    class="cart-trigger-btn relative inline-flex items-center justify-center w-10 h-8 rounded bg-emerald-950/70 hover:bg-emerald-900 text-white hover:text-emerald-300 transition-all shadow-md backdrop-blur-sm cursor-pointer group"
                                    title="View Shopping Cart">
                                <i class="fa-solid fa-cart-shopping text-sm group-hover:scale-110 transition-transform pointer-events-none"></i>
                                <!-- Dynamic Cart Badge -->
                                <span class="cart-badge-count hidden absolute -top-1.5 -right-1.5 bg-gradient-to-r from-red-600 to-rose-500 text-white text-[10px] font-extrabold w-5 h-5 rounded-full items-center justify-center shadow-md border-2 border-slate-900 pointer-events-none">
                                    0
                                </span>
                            </button>
                        </div>

                        <!-- Login / User Profile Dropdown Button -->
                        <div class="ms-2 d-flex align-items-center relative z-20">
                            @php
                                $navAuthUser = auth()->guard('admin')->check() 
                                    ? auth()->guard('admin')->user() 
                                    : (auth()->check() ? auth()->user() : null);

                                $navUserPhoto = null;
                                if ($navAuthUser && !empty($navAuthUser->image)) {
                                    if (str_starts_with($navAuthUser->image, 'http') || str_starts_with($navAuthUser->image, 'storage/')) {
                                        $navUserPhoto = asset($navAuthUser->image);
                                    } else {
                                        $navUserPhoto = asset('storage/' . $navAuthUser->image);
                                    }
                                }
                                if (!$navUserPhoto) {
                                    $navUserPhoto = asset('no-profile-img.png');
                                }
                                $isNavAdmin = auth()->guard('admin')->check();
                                $navAccountUrl = route('dashboard');
                                $navLogoutAction = $isNavAdmin ? route('admin.logout') : route('logout');
                            @endphp

                            @if($navAuthUser)
                                <!-- Profile Picture with Dropdown -->
                                <div class="relative" x-data="{ profileMenuOpen: false }" @click.outside="profileMenuOpen = false">
                                    <button type="button" 
                                            id="nav-user-profile-btn"
                                            @click="profileMenuOpen = !profileMenuOpen"
                                            class="nav-profile-btn relative flex items-center justify-center p-0.5 rounded-full border-2 border-emerald-500/60 hover:border-emerald-400 transition-all focus:outline-none focus:ring-2 focus:ring-emerald-400/40 shadow-sm cursor-pointer group"
                                            title="{{ $navAuthUser->name ?? 'User Profile' }}">
                                        <img src="{{ $navUserPhoto }}" 
                                             alt="{{ $navAuthUser->name ?? 'User' }}" 
                                             class="w-9 h-9 rounded-full object-cover group-hover:scale-105 transition-transform pointer-events-none"
                                             onerror="this.onerror=null; this.src='{{ asset('no-profile-img.png') }}';">
                                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-slate-900 pointer-events-none"></span>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="profileMenuOpen" 
                                         x-transition:enter="transition ease-out duration-150"
                                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                         x-transition:leave="transition ease-in duration-100"
                                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                         style="display: none; text-align: left;"
                                         class="nav-profile-dropdown absolute right-0 mt-2.5 w-56 rounded-2xl bg-white shadow-2xl border border-slate-200/90 py-2 z-50 text-slate-800 text-left">
                                        
                                        <!-- User Header -->
                                        <div class="px-4 py-2.5 border-b border-slate-100 flex items-center gap-2.5 text-left">
                                            <img src="{{ $navUserPhoto }}" 
                                                 alt="{{ $navAuthUser->name }}" 
                                                 class="w-8 h-8 rounded-full object-cover border border-slate-200 shrink-0"
                                                 onerror="this.onerror=null; this.src='{{ asset('no-profile-img.png') }}';">
                                            <div class="min-w-0 flex-1 text-left">
                                                <span class="text-xs font-bold text-slate-900 block truncate text-left">{{ $navAuthUser->name }}</span>
                                                <span class="text-[11px] text-slate-500 block truncate text-left">{{ $navAuthUser->email }}</span>
                                            </div>
                                        </div>

                                        <div class="py-1 text-left">
                                            <!-- Option 1: Accounts (Redirects to Dashboard) -->
                                            <a href="{{ $navAccountUrl }}" 
                                               class="flex items-center justify-start gap-2.5 px-4 py-2.5 text-xs font-bold text-slate-700 hover:text-emerald-700 hover:bg-emerald-50/70 transition text-left"
                                               style="text-align: left; justify-content: flex-start;">
                                                <i class="fa-solid fa-gauge-high text-emerald-600 text-sm w-4 text-center"></i>
                                                <span class="text-left">Accounts</span>
                                            </a>

                                            <!-- Option 2: Logout with SweetAlert confirmation -->
                                            <form id="nav-logout-form" method="POST" action="{{ $navLogoutAction }}" class="m-0">
                                                @csrf
                                            </form>
                                            <button type="button" 
                                                    onclick="confirmNavLogout(event)"
                                                    class="w-full flex items-center justify-start gap-2.5 px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-50/80 transition text-left cursor-pointer"
                                                    style="text-align: left; justify-content: flex-start;">
                                                <i class="fa-solid fa-arrow-right-from-bracket text-sm w-4 text-center"></i>
                                                <span class="text-left">Logout</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function confirmNavLogout(event) {
                                        if (event) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        
                                        if (typeof Swal !== 'undefined') {
                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: 'Do you really want to log out of the system?',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#059669',
                                                cancelButtonColor: '#64748b',
                                                confirmButtonText: '<i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Yes, Log Out',
                                                cancelButtonText: 'Cancel',
                                                reverseButtons: true,
                                                customClass: {
                                                    popup: 'rounded-3xl shadow-2xl border border-slate-200 font-sans',
                                                    confirmButton: 'rounded-xl font-bold px-5 py-2.5 shadow-md',
                                                    cancelButton: 'rounded-xl font-bold px-5 py-2.5'
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var form = document.getElementById('nav-logout-form');
                                                    if (form) form.submit();
                                                }
                                            });
                                        } else {
                                            if (confirm('Are you sure you want to log out of the system?')) {
                                                var form = document.getElementById('nav-logout-form');
                                                if (form) form.submit();
                                            }
                                        }
                                        return false;
                                    }
                                </script>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="nav-login-btn relative z-30 inline-flex items-center justify-center gap-2 px-4 py-2 rounded text-xs font-bold transition-all shadow-md cursor-pointer select-none !text-white !no-underline"
                                   title="Sign In">
                                    <i class="fa-solid fa-arrow-right-to-bracket text-xs pointer-events-none"></i>
                                    <span class="pointer-events-none">Login</span>
                                </a>
                            @endif
                        </div>
                </div>
            </div>
        </header>
        <!-- End Header -->
       

        <div class="" style="min-height: 90vh">
            <!-- App Content -->
            @yield('app-content')
            <!-- App Content end-->
        </div>

        <!-- Footer -->
        <footer id="footer">
            <div class="footer-top">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
                <div class="row">

                <div class="col-lg-3 col-md-6 footer-info">
                    @if($siteLogo)
                        <a href="{{ route('home') }}" class="d-inline-block mb-3">
                            <img src="{{ $siteLogo }}" alt="{{ $name }}" class="img-fluid" style="max-height: 45px; object-fit: contain;" onerror="this.style.display='none'; document.getElementById('footer-text-logo').style.display='block';">
                        </a>
                        <h3 id="footer-text-logo" style="display:none;"><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-400">{{ $firstWord }}</span>{{ $secondWord }}</h3>
                    @else
                        <h3><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-400">{{ $firstWord }}</span>{{ $secondWord }}</h3>
                    @endif
                    <p>{{ $fullName }} is a trusted provider of genuine PVA accounts for businesses and marketers.
                        We deliver manually created, secure, and high-quality accounts with fast delivery
                        and reliable customer support.</p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul class="mt-3">
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('products') }}">All Products</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('about') }}">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact') }}">Contact us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('terms.condition') }}">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contact Us</h4>
                    <p class="mt-3">
                        {{ $address }} <br>
                        <strong>Phone:</strong> {{ $contact_num }}<br>
                        <strong>Email:</strong> {{ $contact_email }}<br>
                    </p>

                    <div class="social-links mt-3 flex items-center flex-wrap gap-2">
                        @if(!empty($configer?->facebook) && $configer->facebook !== '#')
                            <a href="{{ $configer->facebook }}" target="_blank" rel="noopener noreferrer" class="facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if(!empty($configer?->twitter) && $configer->twitter !== '#')
                            <a href="{{ $configer->twitter }}" target="_blank" rel="noopener noreferrer" class="twitter" title="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if(!empty($configer?->instagram) && $configer->instagram !== '#')
                            <a href="{{ $configer->instagram }}" target="_blank" rel="noopener noreferrer" class="instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if(!empty($configer?->youtube) && $configer->youtube !== '#')
                            <a href="{{ $configer->youtube }}" target="_blank" rel="noopener noreferrer" class="youtube" title="YouTube"><i class="bi bi-youtube"></i></a>
                        @endif
                        @if(!empty($configer?->telegram) && $configer->telegram !== '#')
                            <a href="{{ str_starts_with($configer->telegram, 'http') ? $configer->telegram : 'https://t.me/' . ltrim($configer->telegram, '@') }}" target="_blank" rel="noopener noreferrer" class="telegram" title="Telegram"><i class="bi bi-telegram"></i></a>
                        @endif
                        @php
                            $ftWaNumber = !empty($configer?->whatsapp) ? trim($configer->whatsapp) : (!empty($configer?->phone) ? trim($configer->phone) : null);
                            $ftWaUrl = null;
                            if ($ftWaNumber && $ftWaNumber !== '#') {
                                if (str_starts_with($ftWaNumber, 'http://') || str_starts_with($ftWaNumber, 'https://')) {
                                    $ftWaUrl = $ftWaNumber;
                                } else {
                                    $digits = preg_replace('/[^0-9]/', '', $ftWaNumber);
                                    $ftWaUrl = !empty($digits) ? 'https://wa.me/' . $digits . '?text=' . rawurlencode('Hello ' . ($configer?->name ?? 'AccueVault') . ', I would like to inquire about your PVA accounts & services.') : null;
                                }
                            }
                        @endphp
                        @if($ftWaUrl)
                            <a href="{{ $ftWaUrl }}" target="_blank" rel="noopener noreferrer" class="whatsapp" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p class="mt-3">Subscribe to receive updates on new PVA account packages, special offers,
                        service updates, and exclusive discounts from {{ $fullName }}.</p>
                    <form action="" method="post" class="mt-3">
                        <input type="email" name="email"><input type="submit" value="Send">
                    </form>
                </div>

                </div>
            </div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
             <div class="copyright">
                &copy; Copyright <strong>{{ $fullName }}</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="https://accuvault.com/">{{ $fullName }}</a>
                </div>
            </div>
        </footer>
        <!-- Footr End -->

    </div>

    <!-- Global Cart Drawer Component -->
    @include('layouts.cart-drawer')

    <!-- Sticky Social Icons & Smooth Scroll-To-Top Button -->
    @include('layouts.sticky-widgets')
</body>



    <!-- Vendor JS Files -->
    <script src="{{ asset('Frontend/theme/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('Frontend/theme/assets/js/main.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        // Get the current URL, removing any fragment
        var documentUrl = document.location.href.replace(/#.*$/, '')

        // Iterate through all links
        var linkEls = document.getElementsByTagName('A')
            for (var linkIndex = 0; linkIndex < linkEls.length; linkIndex++) {
                var linkEl = linkEls[linkIndex]

                // Ignore links that don't begin with #
                if (!linkEl.getAttribute('href').match(/^#/)) {
                continue;
                }

                // Convert to an absolute URL
                linkEl.setAttribute('href', documentUrl + linkEl.getAttribute('href'))
            }
        })    
    </script>

    <!-- Flipbook main Js file -->
    <script src="{{ url('dflip/js/libs/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('dflip/js/dflip.min.js') }}" type="text/javascript"></script>



</html>
