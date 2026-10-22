@extends('layouts.app')
@section('title', 'About Us | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .light-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .light-card:hover {
        transform: translateY(-4px);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(16, 185, 129, 0.1);
    }
    .emerald-gradient-text {
        background: linear-gradient(135deg, #059669 0%, #10b981 50%, #0d9488 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endpush

@section('app-content')

<div class="bg-slate-50 text-slate-800 antialiased min-h-screen pb-20 font-['Inter',sans-serif]">

    <!-- Full-Width Hero Banner Section -->
    <section class="relative w-full overflow-hidden pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-emerald-950/40">
        <!-- Background Image with Dark Blur Effect (Full Width) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <img src="{{ asset('Frontend/images/about-banner.jpg') }}" 
                 alt="About Us Banner" 
                 class="w-full h-full object-cover object-center scale-110 filter blur-sm">
            <!-- Full-Width Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/50 via-emerald-950/50 to-slate-950/50 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[400px] bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <!-- Foreground Content (Responsive Centered Container) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10 text-center">
            
            <!-- Breadcrumbs on Dark Banner -->
            <nav class="flex items-center justify-center gap-2 text-xs sm:text-sm text-emerald-200/70 mb-6 overflow-x-auto whitespace-nowrap py-1">
                <a href="{{ route('home') }}" class="hover:text-emerald-300 transition-colors flex items-center gap-1.5 font-medium">
                    <i class="fa-solid fa-house text-xs text-emerald-400"></i>
                    <span>Home</span>
                </a>
                <i class="fa-solid fa-chevron-right text-[10px] text-emerald-400/50"></i>
                <span class="text-white font-semibold">About Us</span>
            </nav>

            <!-- Trust Pill Badge -->
            <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs sm:text-sm font-bold px-4 py-1.5 rounded-full mb-6 shadow-sm backdrop-blur-md">
                <i class="fa-solid fa-shield-halved text-emerald-400"></i>
                <span>Trusted by 50,000+ Marketers & Agencies Worldwide</span>
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-6 drop-shadow-md">
                Your Premier Destination for <br class="hidden sm:inline" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-green-400">100% Verified PVA Accounts</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-sm sm:text-base lg:text-lg text-emerald-100/90 leading-relaxed max-w-2xl mx-auto mb-8 font-normal drop-shadow-sm">
                {{ $configer?->name ?? 'AccueVault' }} is an industry-leading supplier of high-reputation Phone Verified Accounts. We deliver manually registered, safe, and spam-free accounts built to supercharge your marketing campaigns and automation pipelines.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}#products" 
                   class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-extrabold rounded-xl shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
                    <i class="fa-solid fa-basket-shopping text-sm"></i>
                    <span>Explore PVA Catalog</span>
                </a>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-white/10 hover:bg-white/20 text-white font-extrabold rounded-xl border border-white/20 backdrop-blur-sm shadow-sm transition-all transform hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
                    <i class="fa-solid fa-headset text-emerald-400 text-sm"></i>
                    <span>Contact Support</span>
                </a>
            </div>

        </div>
    </section>

    <!-- Main Page Content in Standard Container -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl pt-12 sm:pt-16">

        <!-- Trust Stats Banner -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 mb-20">
            <div class="light-card rounded-2xl p-6 text-center">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-600 mb-1">50K+</div>
                <div class="text-sm font-medium text-slate-600">Accounts Delivered</div>
                <p class="text-xs text-slate-400 mt-1">Across 120+ Countries</p>
            </div>
            <div class="light-card rounded-2xl p-6 text-center">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-600 mb-1">99.8%</div>
                <div class="text-sm font-medium text-slate-600">Satisfaction Rate</div>
                <p class="text-xs text-slate-400 mt-1">Real-SIM Verification</p>
            </div>
            <div class="light-card rounded-2xl p-6 text-center">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-600 mb-1">48-Hr</div>
                <div class="text-sm font-medium text-slate-600">Replacement Policy</div>
                <p class="text-xs text-slate-400 mt-1">Zero-Risk Guarantee</p>
            </div>
            <div class="light-card rounded-2xl p-6 text-center">
                <div class="text-3xl sm:text-4xl font-extrabold text-emerald-600 mb-1">24/7</div>
                <div class="text-sm font-medium text-slate-600">Dedicated Support</div>
                <p class="text-xs text-slate-400 mt-1">Via WhatsApp & Email</p>
            </div>
        </div>

        <!-- Story & Mission Section (Two Column) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-24">
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center gap-2 bg-emerald-100/70 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Our Mission & Vision
                </div>
                
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug">
                    Eliminating Suspensions with <br/>
                    <span class="text-emerald-600">Authentic, Clean-History Accounts</span>
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    In today's algorithmic landscape, automated bot registrations and recycled VoIP numbers get flagged within hours. We created <strong>{{ $configer?->name ?? 'AccueVault' }}</strong> to solve this fundamental problem for growth marketers, agencies, developers, and businesses worldwide.
                </p>

                <p class="text-slate-600 leading-relaxed">
                    Every account we deliver is created with meticulous precision: real physical SIM phone verification, unique residential IP addresses, clean browser fingerprints, and verified recovery emails. Whether you need accounts for customer outreach, lead generation, social media management, or market research, we guarantee enterprise-grade security.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-sim-card text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Real Physical SIMs</h4>
                            <p class="text-xs text-slate-500">No cheap virtual VoIP numbers that trigger automatic bans.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-globe text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Residential IP Proxies</h4>
                            <p class="text-xs text-slate-500">Created with genuine ISP IPs from the US, UK, Canada & EU.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-bolt text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Instant Credential Dispatch</h4>
                            <p class="text-xs text-slate-500">Fast delivery formatted neatly in CSV / Excel with full logins.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-rotate-left text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900 text-sm">Replacement Warranty</h4>
                            <p class="text-xs text-slate-500">Free, no-hassle replacements within 48 hours if any issue arises.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column Visual Graphic Card -->
            <div class="lg:col-span-6">
                <div class="relative">
                    <div class="absolute -inset-2 bg-gradient-to-r from-emerald-400/20 to-teal-400/20 rounded-3xl blur-xl -z-10"></div>
                    <div class="light-card rounded-3xl p-8 sm:p-10 border border-emerald-100">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $configer?->name ?? 'AccueVault' }} Verification Standard</h3>
                                <p class="text-xs text-slate-500">Enterprise PVA Quality Assurance Checklist</p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Live Audited
                            </span>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">Phone Verification Method</div>
                                        <div class="text-xs text-slate-500">Tier-1 Real Carrier SIMs (AT&T, Verizon, T-Mobile, Vodafone)</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100/60 px-2.5 py-1 rounded-md">100% Passed</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">IP Subnet Quality Score</div>
                                        <div class="text-xs text-slate-500">Dedicated Residential IP per account, zero datacenter flags</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100/60 px-2.5 py-1 rounded-md">A+ Rating</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">Recovery Info Setup</div>
                                        <div class="text-xs text-slate-500">Matching recovery emails and 2FA secrets included</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100/60 px-2.5 py-1 rounded-md">Verified</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">Spam History & Blacklist Audit</div>
                                        <div class="text-xs text-slate-500">Zero prior warnings, zero shadow-bans, pristine inbox reputation</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100/60 px-2.5 py-1 rounded-md">Clean</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>Last Process Audit: {{ date('M Y') }}</span>
                            <span class="font-semibold text-emerald-600 flex items-center gap-1">
                                <i class="fa-solid fa-lock"></i> ISO-compliant privacy
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4-Step Pipeline Section -->
        <div class="mb-24">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">
                    Transparent Workflow
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
                    How We Create & Deliver Premium Accounts
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Every order goes through our 4-stage strict quality verification pipeline before arriving in your hands.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="light-card rounded-2xl p-6 relative">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 font-extrabold text-xl flex items-center justify-center mb-5">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Carrier SIM Binding</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        We connect physical SIM cards from trusted national carriers to ensure unchallengeable SMS phone verification.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="light-card rounded-2xl p-6 relative">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 font-extrabold text-xl flex items-center justify-center mb-5">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Residential Fingerprint</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Accounts are initialized on dedicated browser profiles using clean residential IP ranges matching the phone country.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="light-card rounded-2xl p-6 relative">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 font-extrabold text-xl flex items-center justify-center mb-5">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Warmup & Security</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Each account receives secondary recovery credentials, 2FA secret backups, and a natural warm-up buffer period.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="light-card rounded-2xl p-6 relative">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 font-extrabold text-xl flex items-center justify-center mb-5">
                        04
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Instant Dispatch</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Login credentials, recovery passwords, and proxies are formatted cleanly and dispatched immediately with full warranty.
                    </p>
                </div>
            </div>
        </div>

        <!-- Core Guarantees Grid (6 Cards) -->
        <div class="mb-24">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">
                    Why Choose Us
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
                    6 Pillars of Our PVA Reliability
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="light-card rounded-2xl p-7">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">48-Hour Replacement Guarantee</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        If any account encounters a login challenge or disabled state within 48 hours of purchase, our support team replaces it free of charge.
                    </p>
                </div>

                <div class="light-card rounded-2xl p-7">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Real Human VIP Support</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Direct access to account specialists via WhatsApp, Telegram, and Email with typical response times under 15 minutes.
                    </p>
                </div>

                <div class="light-card rounded-2xl p-7">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Bulk Pricing & Tier Discounts</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Automated volume discounts up to 35% off for agencies and enterprise teams needing consistent daily account pipelines.
                    </p>
                </div>

                <div class="light-card rounded-2xl p-7">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">100% Privacy & Discretion</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        We never retain customer login credentials post-handover. Your purchase history and account identities remain strictly confidential.
                    </p>
                </div>

                <div class="light-card rounded-2xl p-7">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Fresh & Aged Inventory</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Choose between brand-new fresh accounts ready for setup, or aged accounts (3 to 24+ months) for immediate high-trust activities.
                    </p>
                </div>

                <div class="light-card rounded-2xl p-7">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-file-csv"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Universal Compatibility</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Formatted cleanly for all major anti-detect browsers (AdsPower, Dolphin{anty}, Multilogin, GoLogin) and automation tools.
                    </p>
                </div>
            </div>
        </div>

        <!-- Light CTA Card -->
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 text-white p-8 sm:p-12 shadow-xl">
            <!-- Background circles -->
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -left-10 -top-10 w-72 h-72 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto text-center space-y-6">
                <span class="inline-block bg-white/20 backdrop-blur-md text-white text-xs font-semibold px-4 py-1.5 rounded-full uppercase tracking-wider">
                    Ready to Scale Your Marketing?
                </span>
                
                <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Get Instant Access to Verified Accounts Today
                </h2>

                <p class="text-white/90 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                    Join thousands of high-growth agencies, media buyers, and developers who rely on {{ $configer?->name ?? 'AccueVault' }} for zero-ban PVA solutions.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                    <a href="{{ route('home') }}" class="px-8 py-3.5 bg-white text-emerald-700 hover:bg-slate-100 font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                        Browse All Accounts
                    </a>
                    <a href="{{ route('contact') }}" class="px-8 py-3.5 bg-emerald-800/60 hover:bg-emerald-800 text-white font-semibold rounded-xl border border-white/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                        Request Custom Order
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection