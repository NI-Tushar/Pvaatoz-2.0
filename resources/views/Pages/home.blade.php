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

                            <!-- Grid of Accounts -->
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
    <section id="services">
      <div class="container" data-aos="fade-up">

        <header class="section-header wow fadeInUp">
            <h3>Why Choose PVAAtoZ</h3>
            <p class="mt-2">We provide 100% verified PVA and aged accounts to help you achieve your digital goals. With years of experience in the industry, we ensure secure, reliable, and fast delivery for businesses and professionals. Trust PVAATOZ for high-quality accounts and exceptional service that scales with your needs.</p>
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

    <!-- ======= Featured Services Section Section ======= -->
    <section id="featured-services">
      <div class="container">
        <div class="row">

            <div class="col-lg-4 box">
                <img class="h-[60px] w-auto" src="{{ asset('Frontend/icons/text_icon/genuine.png') }}" alt="">
                <h4 class="title"><a href="">Genuine PVA Accounts</a></h4>
                <p class="description">
                    We provide 100% genuine and verified PVA accounts created with real information to ensure safety, stability, and long-term usability.
                </p>
            </div>

            <div class="col-lg-4 box box-bg">
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
    <section id="about">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h3>Our Amazing Features</h3>
                <p class="mt-2">Our platform offers a complete range of premium PVA account services, including 100% genuine and manually created accounts, multiple package options, fast and reliable delivery, aged accounts for better performance, flexible payment methods, and a trusted replacement guarantee. Every feature is designed to ensure security, authenticity, and a smooth experience from purchase to delivery.</p>
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
                <h3>Our Amazing Features</h3>
                <p class="mt-2">Our platform offers a complete range of premium PVA account services, including 100% genuine and manually created accounts, multiple package options, fast and reliable delivery, aged accounts for better performance, flexible payment methods, and a trusted replacement guarantee. Every feature is designed to ensure security, authenticity, and a smooth experience from purchase to delivery.</p>
            </header>
            <article class="w-full mx-auto px-4 py-16">

                <!-- SECTION 1: Our PVA Service -->
                <section class="mb-4 border-b border-gray-200 pb-10">
                    <!-- Header: Taller Icon, Shorter Text -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-lg border-2 border-emerald-500 bg-white flex items-center justify-center shrink-0">
                            <img class="h-[35px] w-auto" src="{{ asset('Frontend/icons/text_icon/call.png') }}" alt="">
                        </div>
                        <h2 class="text-[20px] md:text-[25px] font-serif font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            OUR PVA SERVICE:
                        </h2>
                    </div>
                    
                    <div class="space-y-6 text-lg leading-relaxed text-slate-600">
                        <p class="first-letter:text-5xl first-letter:font-serif first-letter:font-bold first-letter:text-emerald-600 first-letter:float-left first-letter:mr-2">
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
                        <h2 class="text-[20px] md:text-[25px] font-serif font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            WHY YOU SHOULD BUY ACCOUNTS FROM pvaatoz?
                        </h2>
                    </div>
                    
                    <ul class="space-y-3 pl-1 md:pl-8">
                        <!-- Item 1 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">01.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
                                pvaatoz is one of the foremost well-known social media account providers.
                            </p>
                        </li>
                        <!-- Item 2 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">02.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
                                You can purchase your AOL accounts with PayPal right away; nearly 5 to 10 minutes will take to provide your wanted AOL package.
                            </p>
                        </li>
                        <!-- Item 3 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">03.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
                                You have a 7 days cash back ensure for any kind of problem.
                            </p>
                        </li>
                        <!-- Item 4 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">04.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
                                You can arrange more seasoned or fresher indeed any matured AOL PVA account.
                            </p>
                        </li>
                        <!-- Item 5 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">05.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
                                We continuously center on our committed client bolster so we are accessible to any kind of social media stage where you'll get moment offer assistance from us.
                            </p>
                        </li>
                        <!-- Item 6 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">06.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
                                We accept diverse sorts of installment strategies so you don’t ought to stress almost your installments framework to pay us.
                            </p>
                        </li>
                        <!-- Item 7 -->
                        <li class="flex items-start">
                            <span class="font-serif font-bold text-emerald-600 mr-4 mt-1">07.</span>
                            <p class="text-slate-600 leading-relaxed border-l-2 border-gray-200 pl-6 italic">
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
                        <h2 class="text-[20px] md:text-[25px] font-serif font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            HOW TO BUY ACCOUNTS FROM pvaatoz
                        </h2>
                    </div>
                    
                    <div class="space-y-4 text-lg leading-relaxed text-slate-600 bg-white p-8 border border-gray-100 rounded-lg">
                        <p>
                            It is exceptionally simple to purchase Accounts on the off chance that you have got cash. Our accounts can be effectively opened if you'll verify them effectively along with your phone number or Facebook.
                        </p>
                        <p>
                            You'll be able effortlessly to make an AOL account from your pc or versatile phone but you cannot make boundless AOL PVA accounts. So you ought to confirm the AOL PVA with a phone number. But you should keep in mind that your service supplier will not let you employ the phone number once more and again. That’s why you would like to discover a website who will assist you to purchase AOL accounts with a watchword at a sensible cost at the same time. You'll purchase moreover purchase Facebook accounts.
                        </p>
                        <p class="border-t border-gray-100 pt-6">
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 1: Browse & Select</strong>
                            To purchase ancient AOL accounts from pvaatoz you've got to browse the landing page to begin with. At that point you've got to go to the benefit segment once you will see the AOL account administrations recorded.
                        </p>
                        <p>
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 2: Choose Package</strong>
                            Go to the AOL account page and you may see distinctive sorts of packages. From there fair select your craved bundle that you simply need to purchase. Select or tap any bundles and it'll let you divert to the installment page where you'll be able to pay with a diverse installment choice.
                        </p>
                        <p>
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 3: Payment</strong>
                            pvaatoz basically acknowledges all sorts of installment alternatives such as PayPal, MasterCard installment, culminate cash and Bitcoin. In some cases pvaatoz offer a few rebates for particular bulk AOL accounts bundles which is astonishing. You'll be able to snatch our rebate offer by paying with a particular installment alternative.
                        </p>
                        <p>
                            <strong class="text-slate-900 uppercase tracking-widest text-sm mb-2 block">Step 4: Delivery</strong>
                            After installment you have got to wait for a minute and you may be informed before long to provide your accounts by email. pvaatoz mainly conveys accounts in a spreadsheet which may be exceptionally helpful highlight that will assist you to oversee the accounts effectively.
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
                        <h2 class="text-[20px] md:text-[25px] font-serif font-bold text-slate-900 border-b-2 border-emerald-500 pb-2 inline-block leading-tight">
                            WHY WOULD YOU BUY OLD ACCOUNT AT REASONABLE PRICE
                        </h2>
                    </div>
                    
                    <div class="space-y-4 text-lg leading-relaxed text-slate-600">
                        <p>
                            You'll have a part of websites which give AOL mail for your marketing. Regular we need to spend a part of cash to induce appropriate administrations. But the thing is that most of the websites on the web don’t give quality benefit particularly they by and large take the cash from the client but in return they give exceptionally poor services.
                        </p>
                        <p>
                            So to buy AOL channel, pvaatoz can be a trusted source since it is solid and it has a dedicated team bolster. You are doing not ought to stress almost the quality of any sorts of accounts. Pvanet some of the time offers astounding rebates and you'll snatch it from there on the off chance that you're a customary client otherwise you can contact us for a special offer by subscribing to our bulletin. We'll inform you through e-mail on the off chance that any offer is running.
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
