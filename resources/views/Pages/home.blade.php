@extends('layouts.app')
@section('title', 'Home')

@push('css')
 

@endpush

@section('app-content')

    <!-- ======= hero Section ======= -->
    <section
        id="hero-wrapper"
        class="relative w-full min-h-screen text-slate-50 antialiased selection:bg-emerald-500 selection:text-white flex items-center overflow-x-hidden"
        style="font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #022c22 0%, #064e1cff 50%, #020617 100%);">

        <!-- 1. Base Grid Pattern (Green Theme) -->
        <div class="absolute inset-0 bg-[size:40px_40px] bg-[linear-gradient(to_right,#064e3b_1px,transparent_1px),linear-gradient(to_bottom,#064e3b_1px,transparent_1px)] opacity-50 pointer-events-none z-0"></div>
        
        <!-- 2. Radial Gradient Mask (Vignette) -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-emerald-950/20 via-emerald-950/80 to-emerald-950 z-0 pointer-events-none"></div>

        <!-- 3. Green Gradient Glows (Blobs) -->
        <!-- Top Left Glow (Emerald) -->
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-emerald-500/30 rounded-full blur-[120px] animate-pulse-slow z-[-1]"></div>
        
        <!-- Bottom Right Glow (Teal) -->
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-teal-400/20 rounded-full blur-[120px] animate-pulse-slow z-[-1]"></div>
        
        <!-- Center Subtle Glow (Green) -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-green-600/20 rounded-full blur-[100px] z-[-1]"></div>


        <!-- Hero Section Container -->
        <header class="relative z-10 w-full py-20 lg:py-32">
            
            <div class="container mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                    
                    <!-- Left Side: Content -->
                    <div 
                        class="lg:w-5/12 flex flex-col ">
                        <!-- Status Badge -->
                        <div style="border: 1px solid #10b98180;" 
                            class="inline-flex items-center lg:items-left gap-2 px-3 py-1 rounded-full bg-emerald-900/60 text-emerald-400 text-xs font-semibold w-fit uppercase tracking-wide mb-6 backdrop-blur-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Live Stock Available
                        </div>

                        <!-- Headline -->
                        <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
                            Bulk Accounts <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-400">
                                Supercharged
                            </span>
                        </h1>

                        <!-- Subheadline -->
                        <p class="text-lg text-emerald-100/80 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                            Get access to largest inventory of PVA and aged accounts. From Facebook to Telegram, we supply to tools you need to scale.
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mb-10">
                            <a href="#pricing"
                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold rounded-lg shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-1 text-center">
                                Get Start
                            </a>
                            <a href="#api" style="border: 1px solid #34d39980;" 
                            class="w-full sm:w-auto px-8 py-3 bg-emerald-950/50 hover:bg-emerald-900 text-white font-bold rounded-lg hover:border-emerald-400 backdrop-blur-sm transition-all text-center">
                                Contact Us
                            </a>
                        </div>

                        <!-- Trust Stats -->
                        <div class="grid grid-cols-3 gap-4 border-t border-emerald-500/20 pt-6 text-center lg:text-left">
                            <div class="items-center justify-center lg:justify-start">
                                <p class="text-2xl font-bold text-white text-left">500k+</p>
                                <p class="text-xs text-emerald-200 uppercase text-left tracking-wide">Accounts Sold</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-white text-left">24/7</p>
                                <p class="text-xs text-emerald-200 uppercase tracking-wide text-left">Live Support</p>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-white text-left">&lt;5m</p>
                                <p class="text-xs text-emerald-200 uppercase tracking-wide text-left">Delivery Time</p>
                            </div>
                        </div>

                    </div>

                    <!-- Right Side: The "Dashboard" Visual -->
                    <div class="lg:w-7/12 w-full relative">
                        
                        <!-- Main Dashboard Card -->
                        <div style="border: 1px solid #10b98140;"  
                            class="relative bg-emerald-950/60 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden animate-float">
                            
                            <!-- Dashboard Header -->
                            <div style="border-bottom: 1px solid #10b98140;" 
                                class="bg-emerald-950/40 px-6 py-4 flex justify-between items-center backdrop-blur-md">
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-1.5">
                                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                    </div>
                                    <span class="ml-2 text-sm text-emerald-100 font-mono">Bulk Accounts</span>
                                </div>
                                <div style="border: 1px solid #10b98180;" 
                                    class="text-xs font-mono text-emerald-400 bg-emerald-900/20 px-2 py-1 rounded">
                                    SYSTEM ONLINE
                                </div>
                            </div>

                            <!-- Grid of  -->
                            <div class="p-3 lg:p-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4">
                                
                                <!-- Item 1: Facebook -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80 shadow hover:border-emerald-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-emerald-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-blue-600/30">
                                            <i class="fa-brands fa-facebook-f text-lg"></i>
                                        </div>
                                        <span style="border: 1px solid #10b98140;" class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono ">IN STOCK</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Facebook</h4>
                                    <p class="text-xs text-emerald-200 mb-2">PVA + Friends</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-emerald-500 to-teal-400 w-[90%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 2: Instagram -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-green-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-green-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-pink-600/30">
                                            <i class="fa-brands fa-instagram text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono ">IN STOCK</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Instagram</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Aged & Active</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-green-500 to-emerald-400 w-[75%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 3: Gmail -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-orange-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-orange-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-red-500 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-red-600/30">
                                            <i class="fa-solid fa-envelope text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-orange-500/10 text-orange-400 px-1.5 py-0.5 rounded font-mono border border-orange-500/20">HOT</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Gmail</h4>
                                    <p class="text-xs text-emerald-200 mb-2">G-Suite Verified</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-red-500 to-orange-400 w-[95%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 4: Twitter (X) -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-gray-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-gray-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-black border border-slate-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-white/10">
                                            <i class="fa-brands fa-x-twitter text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono ">IN STOCK</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Twitter (X)</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Phone Verified</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-gray-500 to-white w-[60%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 5: TikTok -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-teal-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-teal-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-black border border-slate-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-teal-500/20">
                                            <i class="fa-brands fa-tiktok text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-lime-500/10 text-lime-400 px-1.5 py-0.5 rounded font-mono border border-lime-500/20">LOW</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">TikTok</h4>
                                    <p class="text-xs text-emerald-200 mb-2">US & UK Region</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-teal-400 to-green-500 w-[40%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 6: Telegram -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-sky-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-sky-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-sky-400 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-sky-400/30">
                                            <i class="fa-brands fa-telegram text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono ">IN STOCK</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Telegram</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Premium Members</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-sky-400 to-blue-500 w-[85%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 7: LinkedIn -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-blue-700/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-blue-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-700 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-blue-700/30">
                                            <i class="fa-brands fa-linkedin-in text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono ">IN STOCK</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">LinkedIn</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Corporate Profiles</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-700 to-blue-500 w-[55%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Item 8: Pinterest -->
                                <div style="border: 1px solid #10b98130;" 
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80  hover:border-red-600/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-red-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-red-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-red-600/30">
                                            <i class="fa-brands fa-pinterest-p text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;" class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono ">IN STOCK</span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Pinterest</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Business Accounts</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-red-600 to-red-400 w-[70%] h-full"></div>
                                    </div>
                                </div>

                                    <!-- Ticketmaster -->
                                <div style="border: 1px solid #10b98130;"
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80 hover:border-blue-600/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-blue-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-blue-600/30">
                                            <i class="fa-solid fa-ticket text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;"
                                            class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono">
                                            IN STOCK
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Ticketmaster</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Verified Accounts</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-600 to-blue-400 w-[65%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Medium -->
                                <div style="border: 1px solid #10b98130;"
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80 hover:border-black/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-black/30">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-black flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-black/40">
                                            <i class="fa-brands fa-medium text-lg"></i>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;"
                                            class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono">
                                            IN STOCK
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Medium</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Aged Writer Accounts</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-neutral-700 to-neutral-500 w-[60%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Naver -->
                                <div style="border: 1px solid #10b98130;"
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80 hover:border-green-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-green-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 h-10 rounded-lg bg-green-600 flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg shadow-green-600/30">
                                            <span class="font-extrabold text-lg">N</span>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;"
                                            class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono">
                                            IN STOCK
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Naver</h4>
                                    <p class="text-xs text-emerald-200 mb-2">Verified Accounts</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-green-600 to-green-400 w-[75%] h-full"></div>
                                    </div>
                                </div>

                                <!-- Binance -->
                                <div style="border: 1px solid #10b98130;"
                                    class="group bg-emerald-950/40 hover:bg-emerald-900/80 hover:border-yellow-500/50 rounded-xl p-2 lg:!p-4 transition-all cursor-pointer hover:shadow-lg hover:shadow-yellow-900/20">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="w-10 text-white h-10 rounded-lg bg-yellow-500 flex items-center justify-center text-black group-hover:scale-110 transition-transform shadow-lg shadow-yellow-500/30">
                                            <span class="font-extrabold text-lg">B</span>
                                        </div>
                                        <span style="border-bottom: 1px solid #10b98140;"
                                            class="text-[10px] bg-green-500/10 text-emerald-400 px-1.5 py-0.5 rounded font-mono">
                                            IN STOCK
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-white text-sm mb-1">Binance</h4>
                                    <p class="text-xs text-emerald-200 mb-2">KYC Ready Accounts</p>
                                    <div class="w-full bg-emerald-900 h-1 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-300 w-[80%] h-full"></div>
                                    </div>
                                </div>


                            </div>

                            <!-- Dashboard Footer -->
                            <div class="bg-emerald-950/40 px-6 py-3 border-t border-emerald-500/20 flex justify-between items-center text-xs text-emerald-200 backdrop-blur-md">
                                <span>Server: US-East-1</span>
                                <span class="text-emerald-400">Latency: 12ms</span>
                            </div>
                        </div>

                        <!-- Decorative Floating Elements behind dashboard -->
                        <div
                            style="border: 1px solid #34d39980;"
                            class="hidden lg:flex absolute -top-12 -right-12 w-32 h-32 bg-emerald-950/80 backdrop-blur-md rounded-2xl p-4 flex-col items-center justify-center animate-float-delayed shadow-xl z-[-1]">
                            <i class="fa-brands fa-google text-4xl text-transparent bg-clip-text bg-gradient-to-br from-red-500 via-yellow-500 to-green-500 mb-2"></i>
                            <span class="text-xs font-bold text-emerald-200">G-Suite</span>
                        </div>

                        <div
                            style="border: 1px solid #34d39980;"
                            class="hidden lg:flex absolute -bottom-10 -left-10 w-28 h-28 bg-emerald-950/80 backdrop-blur-md rounded-2xl p-4 flex-col items-center justify-center animate-float shadow-xl z-[-1]">
                            <i class="fa-brands fa-yahoo text-4xl text-purple-500 mb-2"></i>
                            <span class="text-xs font-bold text-emerald-200">Yahoo</span>
                        </div>


                    </div>
                </div>
            </div>
        </header>
    </section>
    <!-- End Hero Section -->
    
    <!-- ======= Services Section ======= -->
    <section id="services" class="">
      <div class="container" data-aos="fade-up">

        <header class="section-header wow fadeInUp">
            <h3>Why Choose {{ $configer->name}}</h3>
            <p class="mt-2 max-w-7xl mx-auto">We provide 100% verified PVA and aged accounts to help you achieve your digital goals. With years of experience in the industry, we ensure secure, reliable, and fast delivery for businesses and professionals. Trust {{ $configer->name}} for high-quality accounts and exceptional service that scales with your needs.</p>
        </header>

        <div class="row justify-content-center gap-4 pl-4 pr-4">

            <!-- Our Payment Method -->
            <div 
                class="group p-4 rounded-lg col-lg-3 col-md-6 d-flex justify-content-center cursor-pointer transform transition-transform hover:scale-105"
                style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;"
                data-aos="fade-up" data-aos-delay="100">
                <div class="text-center w-100">
                    <div class="d-flex justify-content-center mb-3">
                        <img class="h-[60px] w-auto" src="{{ asset('Frontend/icons/services/payment.png') }}" alt="">
                    </div>
                    <!-- Text changes color on card hover -->
                    <h4 class="text-center font-bold text-black group-hover:!text-[var(--brand-green)] transition-colors">
                        Our Payment Method
                    </h4>
                    <p class="text-center text-[15px] mt-2">
                        We support secure and flexible payment options to ensure fast, reliable, and hassle-free transactions.
                    </p>
                </div>
            </div>

            <!-- Our Products -->
            <div style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;"
                class="group p-4 rounded-lg col-lg-3 col-md-6 d-flex justify-content-center cursor-pointer transform transition-transform hover:scale-105"
                data-aos="fade-up" data-aos-delay="200">
                <div class="text-center w-100">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('Frontend/icons/services/products.png') }}" alt="">
                    </div>
                    <h4 class="text-center font-bold text-black group-hover:!text-[var(--brand-green)] transition-colors">Our Products</h4>
                    <p class="text-center text-[15px] mt-2">
                        Explore our wide range of verified and aged digital products designed for business needs.
                    </p>
                </div>
            </div>

            <!-- About Products -->
            <div style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;"
                class="group p-4 rounded-lg col-lg-3 col-md-6 d-flex justify-content-center cursor-pointer transform transition-transform hover:scale-105"
                data-aos="fade-up" data-aos-delay="300">
                <div class="text-center w-100">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('Frontend/icons/services/information.png') }}" alt="">
                    </div>
                    <h4 class="text-center font-bold text-black group-hover:!text-[var(--brand-green)] transition-colors">About Products</h4>
                    <p class="text-center text-[15px] mt-2">
                        Each product is tested and verified to ensure quality, security, and long-term usability.
                    </p>
                </div>
            </div>

            <!-- About Us -->
            <div style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;"
                class="group p-4 rounded-lg col-lg-3 col-md-6 d-flex justify-content-center cursor-pointer transform transition-transform hover:scale-105"
                data-aos="fade-up" data-aos-delay="200">
                <div class="text-center w-100">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('Frontend/icons/services/group.png') }}" alt="">
                    </div>
                    <h4 class="text-center font-bold text-black group-hover:!text-[var(--brand-green)] transition-colors">About Us</h4>
                    <p class="text-center text-[15px] mt-2">
                        We are a trusted digital service provider with years of experience delivering solutions worldwide.
                    </p>
                </div>
            </div>

            <!-- Our Amazing Features -->
            <div style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;"
                class="group p-4 rounded-lg col-lg-3 col-md-6 d-flex justify-content-center cursor-pointer transform transition-transform hover:scale-105"
                data-aos="fade-up" data-aos-delay="300">
                <div class="text-center w-100">
                    <div class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('Frontend/icons/services/features.png') }}" alt="">
                    </div>
                    <h4 class="text-center font-bold text-black group-hover:!text-[var(--brand-green)] transition-colors">Our Amazing Features</h4>
                    <p class="text-center text-[15px] mt-2">
                        Enjoy instant delivery, 24/7 support, high success rates, and scalable solutions.
                    </p>
                </div>
            </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Product Section start ======= -->
    <section id="about" class="">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3>Our Products</h3>
                <p class="mt-2 max-w-7xl mx-auto"> We provide a wide selection of high-quality PVA accounts built for scalability and performance. All accounts are 100% genuine, 
                    manually created, and carefully tested to ensure reliability. Our products include bulk and aged account options, fast and secure delivery, 
                    multiple package choices, flexible payment methods, and a dependable replacement guarantee—giving you complete confidence from purchase to use.
                </p>
            </header>
            <div class="container mx-auto p-2">
                <div class="max-w-7xl mx-auto px-0 md:px-4">

                <div class="w-full mx-auto">

                    <!-- ================= MOBILE VIEW (Dropdown) ================= -->
                    <!-- Hidden on md and larger screens (Desktop) -->
                    <div class="w-full mb-4">
                        <p class="block text-[18px] font-medium text-black mb-2">
                            Search, What are you looking for
                        </p>

                        <div class="flex flex-col sm:flex-row gap-3">
                            
                            <!-- Search Box -->
                            <div class="relative w-full sm:flex-1">
                                <input type="text" placeholder="Search product..." style="border: 1px solid #00000063;"
                                    class="w-full pl-3 pr-10 py-2.5 h-[50px] text-[16px] rounded-md 
                                        bg-gray-50 focus:outline-none focus:ring-2 text-black focus:ring-[#6366f1] focus:border-[#6366f1]">
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fas fa-search text-sm"></i>
                                </div>
                            </div>

                            <!-- Dropdown -->
                            <div class="relative w-full sm:w-64">
                                <select style="border: 1px solid #00000063;"
                                    id="mobileActionSelect"
                                    onchange="handleMobileAction(this)"
                                    class="block w-full pl-3 pr-10 py-2.5 h-[50px] text-[16px] rounded-md 
                                        bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#6366f1] focus:border-[#6366f1]">
                                    <option value="">All Products</option>
                                    @foreach($allProducts as $product)
                                        <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                    </div>

                    <!-- ================= DESKTOP VIEW (Parallel Buttons) ================= -->
                    <!-- Hidden on mobile, visible on md (medium) and larger -->
                    <div class="hidden w-full flex-wrap justify-center gap-3 
                                bg-white border border-gray-300 shadow-sm 
                                p-3 mb-5 rounded-lg">
                            
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px] font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6366f1] transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-layer-group mr-2"></i> All Accounts
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px] font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6366f1] transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-icons mr-2"></i> social_media
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px]  font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6366f1] transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-envelopes-bulk mr-2"></i> email_communication
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px]  font-medium rounded-md text-gray-700 bg-white hover:bg-[#4f46e5] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6366f1] transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-money-check-dollar mr-2"></i> payment_finance
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px]  font-medium rounded-md text-gray-700 bg-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-globe mr-2"></i> marketplace_ecommerce
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px]  font-medium rounded-md text-gray-700 bg-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-laptop-code mr-2"></i> development_tech
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px]  font-medium rounded-md text-gray-700 bg-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                <i style="color: var(--brand-green);" class="fa-solid fa-bullhorn mr-2"></i> advertising_marketing
                            </button>

                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-[17px]  font-medium rounded-md text-gray-700 bg-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                <i style="color: var(--brand-green);" class="fa-regular fa-circle-play mr-2"></i> entertainment_media
                            </button>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                        <!-- Facebook -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-emerald-500 to-teal-600">
                                <img src="https://t4.ftcdn.net/jpg/02/88/45/89/360_F_288458933_h5vQQloDeokQpqSgHc7fDoTZiEUC0v7X.jpg"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Facebook PVA Accounts">
                            </div>

                            <!-- Content -->
                            <div class="p-3 text-center ">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">
                                    Facebook PVA Accounts
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    100% genuine, manually created PVA accounts suitable for bulk marketing and business use.
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

                                <!-- Price -->
                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.35</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <!-- CTA -->
                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>
                            <div class="absolute top-0 right-0 z-20 overflow-hidden w-20 h-20">
                                <span
                                    class="absolute top-3 right-[-28px] rotate-45 
                                        bg-gradient-to-r from-red-600 via-red-500 to-rose-500
                                        text-white text-xs font-bold text-center
                                        w-32 py-1 shadow-lg pl-3">
                                    Hot Product
                                </span>
                            </div>


                            <!-- Image -->
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-pink-500 to-purple-600">
                                <img src="https://cdn.mos.cms.futurecdn.net/MRJ6A6Arab9wvL28KB5Leh.jpg"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Instagram PVA Accounts">
                            </div>

                            <!-- Content -->
                            <div class="p-3 text-center ">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    Instagram PVA Accounts
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    High-quality phone-verified Instagram accounts, perfect for influencers and marketing campaigns.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Phone Verified (PVA)
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Aged Options Available
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Instant Delivery
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Full Replacement
                                    </li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.45</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Gmail -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-red-500 to-orange-600">
                                <img src="https://p7.hiclipart.com/preview/825/621/186/inbox-by-gmail-email-google-account-icon-gmail-logo-png.jpg"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Gmail PVA Accounts">
                            </div>

                            <!-- Content -->
                            <div class="p-3 text-center ">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    Gmail PVA Accounts
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Reliable phone-verified Gmail accounts for business, marketing, or personal use.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Phone Verified (PVA)
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Unique IPs
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Instant Delivery
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Money-Back Guarantee
                                    </li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.25</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Twitter/X -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>
                            <div class="absolute top-0 right-0 z-20 overflow-hidden w-20 h-20">
                                <span
                                    class="absolute top-3 right-[-28px] rotate-45 
                                        bg-gradient-to-r from-red-600 via-red-500 to-rose-500
                                        text-white text-xs font-bold text-center
                                        w-32 py-1 shadow-lg pl-3">
                                    Hot Product
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-black to-gray-800">
                                <img src="https://pimpmytype.com/wp-content/uploads/2023/08/twitter-x-app-icon-1400x788.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Twitter X PVA Accounts">
                            </div>

                            <!-- Content -->
                            <div class="p-3 text-center ">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    Twitter/X PVA Accounts
                                </h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Twitter (X) accounts ready for promotions, engagement, and growth.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Phone Verified (PVA)
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Real Profile Info
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Instant Delivery
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-600 font-bold">✓</span> Lifetime Replacement
                                    </li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.50</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Wise -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-green-500 to-emerald-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968292.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">Wise Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">Verified Wise accounts for secure global payments.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fully Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Ready to Use</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fast Delivery</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement</li>
                                </ul>
                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$25</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- LinkedIn -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-700">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">LinkedIn Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">Professional LinkedIn accounts for outreach.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Phone Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Real Profiles</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Aged Options</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement</li>
                                </ul>
                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$3.5</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- Snapchat -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-yellow-400 to-yellow-500">
                                <img src="https://cdn-icons-png.flaticon.com/512/733/733622.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">Snapchat Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">High quality Snapchat accounts for promotion.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fresh Accounts</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Bulk Ready</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Support</li>
                                </ul>
                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.6</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- GitHub -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-gray-700 to-gray-900">
                                <img src="https://cdn-icons-png.flaticon.com/512/733/733553.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">GitHub Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">Verified GitHub accounts for development use.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Clean History</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Ready to Use</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement</li>
                                </ul>
                                <div class="mb-4"><span class="text-2xl font-extrabold text-emerald-600">$1.2</span></div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- PayPal -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196565.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">PayPal Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">Secure PayPal accounts for online payments.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Verified Email</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Secure Login</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Ready to Use</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement</li>
                                </ul>
                                <div class="mb-4"><span class="text-2xl font-extrabold text-emerald-600">$18</span></div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- Binance -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-yellow-500 to-orange-500">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968260.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">Binance Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">Ready Binance accounts for crypto trading.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Secure Setup</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>KYC Options</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fast Delivery</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement</li>
                                </ul>
                                <div class="mb-4"><span class="text-2xl font-extrabold text-emerald-600">$35</span></div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- Discord -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>
                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111370.png" class="h-20 group-hover:scale-110 transition" alt="">
                            </div>
                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 ">Discord Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">Verified Discord accounts for communities.</p>
                                <ul class="text-sm space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Clean Accounts</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Bulk Ready</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement</li>
                                </ul>
                                <div class="mb-4"><span class="text-2xl font-extrabold text-emerald-600">$0.9</span></div>
                                <a href="#" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-semibold">Buy Now</a>
                            </div>
                        </div>

                        <!-- Outlook  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-blue-500 to-sky-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/732/732221.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Outlook Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Outlook Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Clean and verified Outlook accounts suitable for email communication and business use.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Clean Inbox</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Delivery</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.30</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Edu Mail  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Edu Mail Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Edu Mail Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified .edu email accounts with full student benefits and long-term access.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>.EDU Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Student Access</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Long Validity</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Full Support</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$6.00</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Tinder  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-pink-500 to-red-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Tinder Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Tinder Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Phone-verified Tinder accounts ready for dating, promotion, or testing purposes.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Phone Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fresh Profiles</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Delivery</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.90</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Quora  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-red-500 to-rose-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968908.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Quora Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Quora Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    High-quality Quora accounts suitable for posting, answering, and brand visibility.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Real Profiles</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Marketing Ready</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Delivery</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.45</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Ticketmaster  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-red-500 to-orange-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968859.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Ticketmaster Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Ticketmaster Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Ready-to-use Ticketmaster accounts for ticket purchasing and event access.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fresh Accounts</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Access</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.80</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Google Voice  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-green-500 to-emerald-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Google Voice Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Google Voice Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Google Voice enabled accounts with active numbers for verification and calls.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Voice Enabled</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Phone Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Delivery</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Support</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$1.50</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Medium  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-gray-800 to-black">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968906.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Medium Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Medium Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Medium accounts ready for publishing articles and content marketing.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Publishing Ready</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Unique Profiles</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Access</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.40</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Airbnb  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-rose-500 to-red-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111320.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Airbnb Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Airbnb Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Airbnb accounts ready for booking, hosting, and platform use.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Profile Ready</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Secure Login</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Support</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$1.20</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- eBay  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-yellow-500 to-red-500">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888848.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="eBay Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">eBay Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Ready eBay accounts for buying, selling, and marketplace operations.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Clean History</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Instant Login</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Policy</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$0.75</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Paxful  -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Accounts</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-green-600 to-lime-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968756.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Paxful Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Paxful Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Paxful accounts suitable for crypto trading and P2P exchanges.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Email Verified</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>KYC Ready</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Secure Access</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Replacement Support</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$1.10</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Trustpilot Reviews -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-emerald-600 text-white text-xs font-semibold px-3 py-1 rounded-full">Bulk Service</span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-green-500 to-teal-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/5968/5968875.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Trustpilot Reviews">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Trustpilot Reviews</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    High-quality Trustpilot reviews to improve brand reputation and trust score.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Real Profiles</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Custom Ratings</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Fast Posting</li>
                                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span>Safe & Secure</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-emerald-600">$2.00</span>
                                    <span class="text-sm text-gray-500">/ review</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 font-semibold transition">
                                    Order Now
                                </a>
                            </div>
                        </div>

                        <!-- Never -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-gray-700 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-gray-600 to-slate-800">
                                <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Never Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Never Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Clean and secure Never accounts created for bulk usage with full safety assurance.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-gray-700 font-bold">✓</span> Fresh Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-gray-700 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-gray-700 font-bold">✓</span> Fast Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-gray-700 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-gray-700">$0.30</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-gray-700 hover:bg-gray-800 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Review Mail -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Review Mail Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Review Mail Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    High-quality review mail accounts ideal for feedback, reviews, and verification use.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Verified Emails</li>
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Clean History</li>
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Ready to Use</li>
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Replacement Support</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-indigo-600">$0.35</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- AliExpress -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-orange-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-orange-500 to-red-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888848.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="AliExpress Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">AliExpress Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified AliExpress buyer accounts suitable for shopping, dropshipping, and bulk orders.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Email Verified</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Fresh Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Safe Login</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-orange-600">$0.40</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-orange-600 hover:bg-orange-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Google Ads -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Google Ads Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Google Ads Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Ready-to-use Google Ads accounts for advertising, marketing, and campaign management.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-blue-600 font-bold">✓</span> Verified Setup</li>
                                    <li class="flex items-center gap-2"><span class="text-blue-600 font-bold">✓</span> Ads Ready</li>
                                    <li class="flex items-center gap-2"><span class="text-blue-600 font-bold">✓</span> Secure Access</li>
                                    <li class="flex items-center gap-2"><span class="text-blue-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-blue-600">$0.50</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Google Play Console -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-green-500 to-lime-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888857.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Google Play Console Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Google Play Console Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Google Play Console accounts ready for app management, uploads, and testing.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✓</span> Developer Access</li>
                                    <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-green-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-green-600">$0.60</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-green-600 hover:bg-green-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Twitch -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-purple-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-purple-500 to-indigo-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/733/733646.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Twitch Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Twitch Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Twitch accounts for streaming, chat engagement, and growth campaigns.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-purple-600 font-bold">✓</span> Phone Verified</li>
                                    <li class="flex items-center gap-2"><span class="text-purple-600 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-purple-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-purple-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-purple-600">$0.50</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-purple-600 hover:bg-purple-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Taboola -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-orange-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-orange-500 to-yellow-500">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888847.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Taboola Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Taboola Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Ready-to-use Taboola accounts for advertising, content promotion, and marketing campaigns.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Ads Ready</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-orange-600">$0.55</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-orange-600 hover:bg-orange-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Apple Developer -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-gray-900 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-gray-800 to-black">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888841.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Apple Developer Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Apple Developer Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Apple Developer accounts for app submission, testing, and iOS development.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-gray-900 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-gray-900 font-bold">✓</span> Developer Access</li>
                                    <li class="flex items-center gap-2"><span class="text-gray-900 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-gray-900 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-gray-900">$0.70</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-gray-900 hover:bg-black text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Nextdoor -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-green-700 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-green-500 to-green-800">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888846.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Nextdoor Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Nextdoor Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Nextdoor accounts for local marketing, promotions, and community engagement.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-green-700 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-green-700 font-bold">✓</span> Real Profiles</li>
                                    <li class="flex items-center gap-2"><span class="text-green-700 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-green-700 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-green-700">$0.40</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-green-700 hover:bg-green-800 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- BeReal -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-yellow-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-yellow-400 to-yellow-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888849.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="BeReal Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">BeReal Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified BeReal accounts for social interactions, sharing, and authentic networking.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-yellow-600 font-bold">✓</span> Phone Verified</li>
                                    <li class="flex items-center gap-2"><span class="text-yellow-600 font-bold">✓</span> Real Profiles</li>
                                    <li class="flex items-center gap-2"><span class="text-yellow-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-yellow-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-yellow-600">$0.35</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Crunchyroll -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-orange-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-orange-500 to-orange-700">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888848.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Crunchyroll Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Crunchyroll Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Crunchyroll accounts for anime streaming, watching, and premium features.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Premium Access</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-orange-600">$0.40</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-orange-600 hover:bg-orange-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Airchat -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-cyan-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-cyan-400 to-cyan-600">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888850.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Airchat Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Airchat Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Airchat accounts for instant messaging, social networking, and community interactions.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-cyan-600 font-bold">✓</span> Phone Verified</li>
                                    <li class="flex items-center gap-2"><span class="text-cyan-600 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-cyan-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-cyan-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-cyan-600">$0.35</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Supernova -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-purple-700 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-purple-500 to-purple-800">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888851.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Supernova Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Supernova Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Supernova accounts for secure access and social networking purposes.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-purple-700 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-purple-700 font-bold">✓</span> Instant Access</li>
                                    <li class="flex items-center gap-2"><span class="text-purple-700 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-purple-700 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-purple-700">$0.35</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-purple-700 hover:bg-purple-800 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Relay -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-700">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888852.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Relay Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Relay Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Secure Relay accounts for communication, messaging, and social interaction purposes.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Real Profiles</li>
                                    <li class="flex items-center gap-2"><span class="text-indigo-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-indigo-600">$0.40</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Stake -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-pink-500 to-pink-700">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888853.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Stake Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Stake Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Stake accounts for secure online transactions and investment purposes.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-pink-600 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-pink-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-pink-600 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-pink-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-pink-600">$0.45</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-pink-600 hover:bg-pink-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <!-- Payoneer -->
                        <div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-orange-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    Bulk Accounts
                                </span>
                            </div>

                            <div class="h-44 flex items-center justify-center bg-gradient-to-br from-orange-500 to-orange-700">
                                <img src="https://cdn-icons-png.flaticon.com/512/888/888854.png"
                                    class="h-20 w-auto group-hover:scale-110 transition-transform duration-300"
                                    alt="Payoneer Accounts">
                            </div>

                            <div class="p-3 text-center">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Payoneer Accounts</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    Verified Payoneer accounts for global payments, withdrawals, and online transactions.
                                </p>

                                <ul class="text-sm text-gray-700 space-y-1 mb-4 text-left pl-2">
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Verified Accounts</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Instant Delivery</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Secure Login</li>
                                    <li class="flex items-center gap-2"><span class="text-orange-600 font-bold">✓</span> Replacement Guarantee</li>
                                </ul>

                                <div class="mb-4">
                                    <span class="text-2xl font-extrabold text-orange-600">$0.50</span>
                                    <span class="text-sm text-gray-500">/ account</span>
                                </div>

                                <a href="#" class="inline-block w-full rounded-lg bg-orange-600 hover:bg-orange-700 text-white py-2.5 font-semibold transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======= Product Section end ======= -->

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="">
      <div class="container">
        <div class="row">

            <div class="col-lg-4 box">
                <img class="h-[60px] w-auto" src="{{ asset('Frontend/icons/text_icon/genuine.png') }}" alt="">
                <h4 class="title"><a href="">Genuine PVA Accounts</a></h4>
                <p class="description">
                    We provide 100% genuine and verified PVA accounts created with real information to ensure safety, stability, and long-term usability.
                </p>
            </div>

            <div class="col-lg-4 box border-l border-[#f1f1f13b] border-r shadow">
                <img class="h-[60px] w-auto" src="{{ asset('Frontend/icons/text_icon/gift-box.png') }}" alt="">
                <h4 class="title"><a href="">Multiple Packages</a></h4>
                <p class="description">
                    Choose from a variety of flexible PVA packages designed to meet different business and marketing needs at competitive prices.
                </p>
            </div>

            <div class="col-lg-4 box">
                <img class="h-[60px] w-auto" src="{{ asset('Frontend/icons/text_icon/cash-on-delivery.png') }}" alt="">
                <h4 class="title"><a href="">Fast & Secure Delivery</a></h4>
                <p class="description">
                    All orders are processed quickly with secure delivery, ensuring you receive high-quality accounts without unnecessary delays.
                </p>
            </div>

        </div>
      </div>
    </section><!-- End Featured Services Section -->

    <!-- Amazing feature card start -->
    <section id="about" class="">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3>Our Amazing Features</h3>
                <p class="mt-2 max-w-7xl mx-auto">Our platform offers a complete range of premium PVA account services, including 100% genuine and manually created accounts, multiple package options, fast and reliable delivery, aged accounts for better performance, flexible payment methods, and a trusted replacement guarantee. Every feature is designed to ensure security, authenticity, and a smooth experience from purchase to delivery.</p>
            </header>
            <div class="container mx-auto p-4">
                <!-- Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Card 1: Genuine PVA (Emerald/Teal) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <!-- Top 1/3: Multi-Color Green Gradient -->
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            
                            <!-- Carved Border (SVG Wave) -->
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>

                            <!-- 3D Absolute Icon (Sitting on the border) -->
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;" 
                                class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-emerald-600 text-2xl border-2 border-emerald-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/genuine.png') }}" alt="">
                            </div>
                        </div>

                        <!-- Bottom 2/3: Text Content -->
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Genuine PVA Accounts</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                You will get 100% Genuine PVA Accounts from us at a very low rate.
                            </p>
                        </div>
                    </div>

                    <!-- Card 2: Genuine PVA (Forest/Green) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;" 
                                class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-green-700 text-2xl border-2 border-green-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/packages.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Various PVA Packages</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Different Packages Available for your convenience at the best rate.
                            </p>
                        </div>
                    </div>

                    <!-- Card 3: Manual PVA (Lime/Chartreuse) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;" 
                                class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-lime-600 text-2xl border-2 border-lime-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/manual.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Manual PVA Creation</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                All accounts are created manually & using safety for authenticity.
                            </p>
                        </div>
                    </div>

                    <!-- Card 4: Fast Delivery (Cyan/Mint) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;"  
                                class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-teal-600 text-2xl border-2 border-teal-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/delivery.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Fast Delivery</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                All accounts are delivered as fast as possible with highest quality.
                            </p>
                        </div>
                    </div>

                    <!-- Card 5: Replacement Guarantee (Sage/Gray Green) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;" 
                                class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-green-600 text-2xl border-2 border-green-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/replace.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Replacement Guarantee</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                You can replace any PVA Accounts within seven days if anything wrong.
                            </p>
                        </div>
                    </div>

                    <!-- Card 6: Payment Methods (Mint/Jade) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;" 
                                class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-teal-500 text-2xl border-2 border-teal-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/payment.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Various Payment Methods</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Almost all major payment methods accepted for your convenience.
                            </p>
                        </div>
                    </div>

                    <!-- Card 7: Aged PVA (Olive/Moss) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;"  
                            class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-olive-600 text-2xl border-2 border-olive-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/aged.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">Aged PVA Accounts</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Aged PVA accounts for genuine marketing and better results.
                            </p>
                        </div>
                    </div>

                    <!-- Card 8: Satisfaction (Spring Green) -->
                    <div class="relative bg-white rounded  shadow-xl h-60 flex flex-col overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                        <div class="h-1/3 w-full bg-[linear-gradient(135deg,#059669_0%,#10b981_25%,#34d399_50%,#2dd4bf_75%,#0f766e_100%)] relative z-10 ">
                            <svg class="absolute bottom-0 w-full h-10 text-white" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" d="M0,160 C480,260 960,60 1440,160 L1440,320 L0,320 Z"></path>
                            </svg>
                            <div style="border: 2px solid var(--brand-green); box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;"
                            class="absolute -bottom-4 left-6 z-30 w-16 h-16  bg-white rounded-xl  flex items-center justify-center text-green-500 text-2xl border-2 border-green-100">
                                <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/features/satisfaction.png') }}" alt="">
                            </div>
                        </div>
                        <div class="h-2/3 w-full px-6 pt-1 flex flex-col justify-center">
                            <h3 class="text-lg font-extrabold text-gray-900 mb-2">100% Satisfaction</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                If you are not satisfied, you can get your money back as.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Amazing feature card end -->

    <!-- text contents start -->
    <section class="py-5">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3>About Our Products</h3>
                <p class="mt-2 max-w-7xl mx-auto">
                    Our products are carefully developed to meet the highest standards of quality, security, and reliability. Each PVA account is manually created, thoroughly verified, and tested before delivery to ensure long-term usability. We offer a variety of account types, including bulk and aged options, to support different marketing and business needs. With fast delivery, flexible payment methods, and a dependable replacement policy, our products are designed to provide a smooth, risk-free experience for every customer.
                </p>
            </header>
            <article class="w-full mx-auto px-4 py-16">

                <!-- SECTION 1: Our PVA Service -->
                <section class="mb-4 border-b border-gray-200 pb-10">
                    <!-- Header: Taller Icon, Shorter Text -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-lg border-2 border-emerald-500 bg-white flex items-center justify-center shrink-0">
                            <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/text_icon/call.png') }}" alt="">
                        </div>
                        <h2 class="text-[20px] uppercase md:text-[25px]  font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            OUR PVA SERVICE:
                        </h2>
                    </div>
                    
                    <div class="space-y-6 text-lg leading-relaxed text-slate-600">
                        <p class="first-letter:text-5xl first-letter: first-letter:font-bold first-letter:text-emerald-600 first-letter:float-left first-letter:mr-2">
                            Elevate your online business with our selection of bulk email accounts and various social profiles. Our inventory includes verified email and social accounts complete with authentic phone numbers, allowing you to expand your online presence effortlessly. Explore our cost-effective options for purchasing phone-verified social accounts and start boosting your online business today.
                        </p>
                        <p>
                            Take your online business to new heights with our assortment of bulk email accounts and other social accounts. All our accounts are verified and tied to authentic phone numbers, ensuring reliability. Don't miss out on the opportunity to acquire budget-friendly, phone-verified social accounts.
                        </p>
                        <p>
                            Boost your online business with ease by securing bulk email accounts and a variety of social accounts from our services. You can trust in the authenticity of our email and social accounts, thanks to their real phone number verifications. And the best part? You can enjoy these phone-verified social accounts at a highly competitive price.
                        </p>
                    </div>
                </section>

                <!-- SECTION 2: Why Buy From Us? -->
                <section class="mb-4 border-b border-gray-200 pb-10">
                    <!-- Header: Taller Icon, Shorter Text -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-lg border-2 border-emerald-500 bg-white flex items-center justify-center shrink-0">
                            <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/text_icon/question.png') }}" alt="">
                        </div>
                        <h2 class="text-[20px] uppercase md:text-[25px]  font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            WHY YOU SHOULD BUY ACCOUNTS FROM {{ $configer->name}}?
                        </h2>
                    </div>
                    
                    <ul class="space-y-3 pl-1 md:pl-8">
                        <!-- Item 1 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">01.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0italic">
                                {{ $configer->name}} is one of the foremost well-known social media account providers.
                            </p>
                        </li>
                        <!-- Item 2 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">02.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0 italic">
                                You can purchase your AOL accounts with PayPal right away; nearly 5 to 10 minutes will take to provide your wanted AOL package.
                            </p>
                        </li>
                        <!-- Item 3 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">03.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0italic">
                                You have a 7 days cash back ensure for any kind of problem.
                            </p>
                        </li>
                        <!-- Item 4 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">04.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0italic">
                                You can arrange more seasoned or fresher indeed any matured AOL PVA account.
                            </p>
                        </li>
                        <!-- Item 5 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">05.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0italic">
                                We continuously center on our committed client bolster so we are accessible to any kind of social media stage where you'll get moment offer assistance from us.
                            </p>
                        </li>
                        <!-- Item 6 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">06.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0italic">
                                We accept diverse sorts of installment strategies so you don’t ought to stress almost your installments framework to pay us.
                            </p>
                        </li>
                        <!-- Item 7 -->
                        <li class="flex items-start">
                            <span class=" font-bold text-emerald-600 mr-4 mt-1">07.</span>
                            <p class="text-slate-600 leading-relaxed  border-gray-200 p-0 m-0italic">
                                All AOL accounts are phone confirmed from a secure source.
                            </p>
                        </li>
                    </ul>
                </section>

                <!-- SECTION 3: How To Buy -->
                <section class="mb-4 border-b border-gray-200 pb-10">
                    <!-- Header: Taller Icon, Shorter Text -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-lg border-2 border-emerald-500 bg-white flex items-center justify-center shrink-0">
                            <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/text_icon/shopping.png') }}" alt="">
                        </div>
                        <h2 class="text-[20px] uppercase md:text-[25px] font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            HOW TO BUY ACCOUNTS FROM {{ $configer->name}}
                        </h2>
                    </div>
                    
                    <div class="space-y-4 text-lg leading-relaxed text-slate-600 bg-white p-0">
                        <p>
                            It is exceptionally simple to purchase Accounts on the off chance that you have got cash. Our accounts can be effectively opened if you'll verify them effectively along with your phone number or Facebook.
                        </p>
                        <p>
                            You'll be able effortlessly to make an AOL account from your pc or versatile phone but you cannot make boundless AOL PVA accounts. So you ought to confirm the AOL PVA with a phone number. But you should keep in mind that your service supplier will not let you employ the phone number once more and again. That’s why you would like to discover a website who will assist you to purchase AOL accounts with a watchword at a sensible cost at the same time. You'll purchase moreover purchase Facebook accounts.
                        </p>
                        <p class="border-t border-gray-100 pt-6">
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 1: Browse & Select</strong>
                            To purchase ancient AOL accounts from {{ $configer->name}} you've got to browse the landing page to begin with. At that point you've got to go to the benefit segment once you will see the AOL account administrations recorded.
                        </p>
                        <p>
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 2: Choose Package</strong>
                            Go to the AOL account page and you may see distinctive sorts of packages. From there fair select your craved bundle that you simply need to purchase. Select or tap any bundles and it'll let you divert to the installment page where you'll be able to pay with a diverse installment choice.
                        </p>
                        <p>
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 3: Payment</strong>
                            {{ $configer->name}} basically acknowledges all sorts of installment alternatives such as PayPal, MasterCard installment, culminate cash and Bitcoin. In some cases {{ $configer->name}} offer a few rebates for particular bulk AOL accounts bundles which is astonishing. You'll be able to snatch our rebate offer by paying with a particular installment alternative.
                        </p>
                        <p>
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 4: Delivery</strong>
                            After installment you have got to wait for a minute and you may be informed before long to provide your accounts by email. {{ $configer->name}} mainly conveys accounts in a spreadsheet which may be exceptionally helpful highlight that will assist you to oversee the accounts effectively.
                        </p>
                    </div>
                </section>

                <!-- SECTION 4: Why Buy Old Accounts? -->
                <section class="mb-4">
                    <!-- Header: Taller Icon, Shorter Text -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-lg border-2 border-emerald-500 bg-white flex items-center justify-center shrink-0">
                            <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/text_icon/tag.png') }}" alt="">
                        </div>
                        <h2 class="text-[20px] uppercase md:text-[25px]  font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            WHY WOULD YOU BUY OLD ACCOUNT AT REASONABLE PRICE
                        </h2>
                    </div>
                    
                    <div class="space-y-4 text-lg leading-relaxed text-slate-600">
                        <p>
                            You'll have a part of websites which give AOL mail for your marketing. Regular we need to spend a part of cash to induce appropriate administrations. But the thing is that most of the websites on the web don’t give quality benefit particularly they by and large take the cash from the client but in return they give exceptionally poor services.
                        </p>
                        <p>
                            So to buy AOL channel, {{ $configer->name}} can be a trusted source since it is solid and it has a dedicated team bolster. You are doing not ought to stress almost the quality of any sorts of accounts. Pvanet some of the time offers astounding rebates and you'll snatch it from there on the off chance that you're a customary client otherwise you can contact us for a special offer by subscribing to our bulletin. We'll inform you through e-mail on the off chance that any offer is running.
                        </p>
                    </div>
                </section>

            </article>
        </div>
    </section>
    <!-- text contents end -->

     
@endsection
@push('script')
@endpush
