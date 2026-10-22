@extends('layouts.app')
@section('title', 'Contact Us | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .light-contact-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .light-contact-card:hover {
        transform: translateY(-3px);
        border-color: rgba(16, 185, 129, 0.4);
        box-shadow: 0 16px 24px -6px rgba(0, 0, 0, 0.06), 0 6px 10px -4px rgba(16, 185, 129, 0.08);
    }
    .form-input-light {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: #1e293b;
        transition: all 0.2s ease;
    }
    .form-input-light:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }
    .emerald-gradient-text {
        background: linear-gradient(135deg, #059669 0%, #10b981 50%, #0d9488 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endpush

@section('app-content')

@php
    $phone = $configer?->phone ?? '+1 (555) 019-2834';
    $rawPhone = preg_replace('/[^0-9]/', '', $phone);
    if (empty($rawPhone)) {
        $rawPhone = '15550192834';
    }
    $email = $configer?->email ?? 'support@accuevault.com';
    $address = $configer?->address ?? '742 Evergreen Terrace, New York, USA';
@endphp

<div class="bg-slate-50 text-slate-800 antialiased min-h-screen pb-20 font-['Inter',sans-serif]">

    <!-- Full-Width Hero Banner Section -->
    <section class="relative w-full overflow-hidden pt-28 sm:pt-36 pb-16 sm:pb-24 border-b border-emerald-950/40">
        <!-- Background Image with Dark Blur Effect (Full Width) -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <img src="{{ asset('Frontend/images/contact-banner.jpg') }}" 
                 alt="Contact Us Banner" 
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
                <span class="text-white font-semibold">Contact Us</span>
            </nav>

            <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs sm:text-sm font-bold px-4 py-1.5 rounded-full mb-5 shadow-sm backdrop-blur-md">
                <i class="fa-solid fa-headset text-emerald-400"></i>
                <span>Average Response Time Under 15 Minutes</span>
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-4 drop-shadow-md">
                Let's Talk About Your <br class="hidden sm:inline" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-green-400">PVA & Account Needs</span>
            </h1>

            <p class="text-sm sm:text-base lg:text-lg text-emerald-100/90 max-w-2xl mx-auto leading-relaxed font-normal drop-shadow-sm mb-8">
                Have questions about bulk orders, custom country SIM verification, or warranty replacements? Reach out to our dedicated support specialists anytime.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="https://wa.me/{{ $rawPhone }}?text={{ urlencode('Hello, I am interested in purchasing PVA accounts from ' . ($configer?->name ?? 'AccueVault')) }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-emerald-500/30 transition-all transform hover:-translate-y-0.5">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Instant WhatsApp Chat</span>
                </a>
                <a href="#contact-form-section" 
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-extrabold text-xs sm:text-sm border border-white/20 backdrop-blur-sm shadow-sm transition-all transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-envelope text-emerald-400 text-xs"></i>
                    <span>Send Message Below</span>
                </a>
            </div>

        </div>
    </section>

    <!-- Main Page Content in Standard Container -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl pt-12 sm:pt-16">

        <!-- Flash Success Notification -->
        @if(session('success'))
            <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3.5 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-emerald-900 text-sm">Message Sent Successfully!</h4>
                    <p class="text-xs sm:text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 p-4 sm:p-5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3.5 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-rose-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation text-sm"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-rose-900 text-sm">Please review the following errors:</h4>
                    <ul class="text-xs sm:text-sm text-rose-700 list-disc list-inside mt-1 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- 4 Quick Direct Contact Channels -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-14">
            <!-- WhatsApp -->
            <a href="https://wa.me/{{ $rawPhone }}?text={{ urlencode('Hello, I am interested in purchasing PVA accounts from ' . ($configer?->name ?? 'AccueVault')) }}" 
               target="_blank" rel="noopener noreferrer"
               class="light-contact-card rounded-2xl p-6 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full uppercase">Instant</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">WhatsApp Chat</h3>
                    <p class="text-xs text-slate-500 mb-2">Fastest channel for orders & instant inquiries</p>
                    <span class="text-xs font-semibold text-emerald-600 group-hover:text-emerald-700 flex items-center gap-1.5">
                        <span>Message Now</span>
                        <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </div>
            </a>

            <!-- Phone Call -->
            <a href="tel:{{ $phone }}" 
               class="light-contact-card rounded-2xl p-6 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center text-xl group-hover:bg-teal-600 group-hover:text-white transition-all">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <span class="text-[11px] font-semibold text-teal-600 bg-teal-50 px-2.5 py-1 rounded-full uppercase">Direct</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Call Us</h3>
                    <p class="text-xs text-slate-500 mb-2">{{ $phone }}</p>
                    <span class="text-xs font-semibold text-teal-600 group-hover:text-teal-700 flex items-center gap-1.5">
                        <span>Click to Call</span>
                        <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </div>
            </a>

            <!-- Email Support -->
            <a href="mailto:{{ $email }}" 
               class="light-contact-card rounded-2xl p-6 flex flex-col justify-between group">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center text-xl group-hover:bg-cyan-600 group-hover:text-white transition-all">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <span class="text-[11px] font-semibold text-cyan-600 bg-cyan-50 px-2.5 py-1 rounded-full uppercase">Official</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Email Inquiries</h3>
                    <p class="text-xs text-slate-500 mb-2 truncate" title="{{ $email }}">{{ $email }}</p>
                    <span class="text-xs font-semibold text-cyan-600 group-hover:text-cyan-700 flex items-center gap-1.5">
                        <span>Send Email</span>
                        <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </div>
            </a>

            <!-- Office / Hours -->
            <div class="light-contact-card rounded-2xl p-6 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full uppercase">24/7/365</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">Global Delivery HQ</h3>
                    <p class="text-xs text-slate-500 leading-snug">{{ $address }}</p>
                    <span class="text-xs font-semibold text-slate-600 mt-2 block">Worldwide dispatch network</span>
                </div>
            </div>
        </div>

        <!-- Main Form + Info Two-Column Section -->
        <div id="contact-form-section" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start mb-20 scroll-mt-32">

            <!-- Left: Contact Form -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-lg">
                    <div class="mb-8">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                            Send Us a Message
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
                            Direct Inquiry Form
                        </h2>
                        <p class="text-slate-600 text-xs sm:text-sm mt-1.5">
                            Fill out the form below. Our dedicated account managers will review your requirements and respond promptly.
                        </p>
                    </div>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Row 1: Name & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Your Full Name <span class="text-emerald-600">*</span>
                                </label>
                                <input type="text" name="name" id="name" required
                                       value="{{ old('name') }}"
                                       placeholder="e.g. Alex Johnson"
                                       class="form-input-light @error('name') border-rose-400 @enderror">
                                @error('name')
                                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Email Address <span class="text-emerald-600">*</span>
                                </label>
                                <input type="email" name="email" id="email" required
                                       value="{{ old('email') }}"
                                       placeholder="e.g. alex@company.com"
                                       class="form-input-light @error('email') border-rose-400 @enderror">
                                @error('email')
                                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Row 2: Phone & Service Category -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Phone / WhatsApp (Optional)
                                </label>
                                <input type="tel" name="phone" id="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="+1 (555) 000-0000"
                                       class="form-input-light">
                            </div>

                            <div>
                                <label for="service" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                    Interested PVA Service
                                </label>
                                <select name="service" id="service" class="form-input-light cursor-pointer">
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Google & Gmail PVA">Google & Gmail PVA Accounts</option>
                                    <option value="WhatsApp PVA">WhatsApp PVA Accounts</option>
                                    <option value="Telegram PVA">Telegram PVA Accounts</option>
                                    <option value="Outlook & Hotmail PVA">Outlook & Hotmail PVA Accounts</option>
                                    <option value="Social Media Accounts">Social Media Accounts (FB, IG, X)</option>
                                    <option value="Custom Bulk Order">Custom Bulk Enterprise Order (500+)</option>
                                    <option value="Warranty / Replacement">Warranty / Replacement Support</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 3: Subject -->
                        <div>
                            <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Subject
                            </label>
                            <input type="text" name="subject" id="subject"
                                   value="{{ old('subject') }}"
                                   placeholder="e.g. Bulk order pricing for US Gmail accounts"
                                   class="form-input-light">
                        </div>

                        <!-- Row 4: Message -->
                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Your Message & Requirements <span class="text-emerald-600">*</span>
                            </label>
                            <textarea name="message" id="message" rows="5" required
                                      placeholder="Please describe your requirements (e.g. account quantity, target countries, preferred format, or any special instructions)..."
                                      class="form-input-light @error('message') border-rose-400 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full sm:w-auto px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/25 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane text-sm"></i>
                                <span>Send Message Now</span>
                            </button>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center gap-2 text-xs text-slate-500">
                            <i class="fa-solid fa-lock text-emerald-600"></i>
                            <span>Your details are 100% confidential. We never spam or share your contact info.</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Support Highlights, SLA & FAQ -->
            <div class="lg:col-span-5 space-y-6">

                <!-- SLA Card -->
                <div class="bg-gradient-to-br from-emerald-500/10 via-teal-500/5 to-slate-50 rounded-3xl p-7 border border-emerald-200">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-base">Rapid Response Guarantee</h3>
                            <p class="text-xs text-emerald-700 font-medium">Active Customer Support</p>
                        </div>
                    </div>

                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                        We prioritize fast resolution times so your business operations never hit a standstill.
                    </p>

                    <div class="space-y-3 pt-2">
                        <div class="flex items-center justify-between text-xs bg-white p-3 rounded-xl border border-slate-200/80">
                            <span class="text-slate-600 font-medium">WhatsApp / Live Chat</span>
                            <span class="font-bold text-emerald-600">5 – 15 Minutes</span>
                        </div>
                        <div class="flex items-center justify-between text-xs bg-white p-3 rounded-xl border border-slate-200/80">
                            <span class="text-slate-600 font-medium">Email Inquiries</span>
                            <span class="font-bold text-emerald-600">1 – 3 Hours</span>
                        </div>
                        <div class="flex items-center justify-between text-xs bg-white p-3 rounded-xl border border-slate-200/80">
                            <span class="text-slate-600 font-medium">Account Replacements</span>
                            <span class="font-bold text-emerald-600">Same-Day Priority</span>
                        </div>
                    </div>
                </div>

                <!-- Common Questions Accordion/Cards -->
                <div class="bg-white rounded-3xl p-7 border border-slate-200/90 shadow-sm space-y-4">
                    <h3 class="font-bold text-slate-900 text-base pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-emerald-600"></i>
                        <span>Frequently Asked Questions</span>
                    </h3>

                    <div class="space-y-3">
                        <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                            <h4 class="text-xs font-bold text-slate-900 mb-1">How fast will I receive my accounts?</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Standard orders are delivered instantly or within 10 to 30 minutes after payment confirmation.
                            </p>
                        </div>

                        <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                            <h4 class="text-xs font-bold text-slate-900 mb-1">What if I have trouble logging into an account?</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Simply message our WhatsApp or email with your order ID within 48 hours for a quick replacement.
                            </p>
                        </div>

                        <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                            <h4 class="text-xs font-bold text-slate-900 mb-1">Do you offer custom country accounts?</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Yes! We provide USA, UK, Canada, Australia, Germany, and worldwide custom geo-located PVA accounts.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Embedded Location Map -->
        <div class="bg-white rounded-3xl p-4 sm:p-6 border border-slate-200/90 shadow-sm">
            <div class="flex items-center justify-between mb-4 px-2">
                <div>
                    <h3 class="font-bold text-slate-900 text-base">Global Service Coverage</h3>
                    <p class="text-xs text-slate-500">Supporting global clients across North America, Europe, Asia, and Oceania</p>
                </div>
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Global Network
                </span>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.254363514!2d-74.11976373946229!3d40.69766374933333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY!5e0!3m2!1sen!2sus!4v1714500000000!5m2!1sen!2sus"
                        height="360" width="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</div>

@endsection