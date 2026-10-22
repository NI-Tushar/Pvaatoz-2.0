@extends('layouts.app')
@section('title', 'Create an Account | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

@push('css')
<style>
    .auth-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.07), 0 4px 10px -3px rgba(0, 0, 0, 0.03);
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
    $logoUrl = $configer?->logo 
        ? (str_starts_with($configer->logo, 'http') || str_starts_with($configer->logo, 'storage/') ? asset($configer->logo) : asset('storage/' . $configer->logo)) 
        : null;
@endphp

<div class="bg-gradient-to-b from-slate-50 via-white to-slate-50 text-slate-800 antialiased min-h-screen pt-28 pb-20 font-['Inter',sans-serif] flex items-center justify-center">

    <!-- Ambient Top Glow -->
    <div class="relative overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[350px] bg-gradient-to-b from-emerald-200/40 via-teal-100/20 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">

        <div class="auth-card rounded-3xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 shadow-2xl">
            
            <!-- Left Column: Trust & Advantages Showcase (5 Cols) -->
            <div class="lg:col-span-5 p-8 sm:p-10 text-white flex flex-col justify-between relative overflow-hidden"
                 style="background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);">
                
                <!-- Ambient Glow -->
                <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full bg-emerald-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-48 h-48 rounded-full bg-teal-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

                <div class="relative z-10 space-y-6">
                    <!-- Brand Header -->
                    <div class="flex items-center gap-3">
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}" alt="Logo" class="max-h-9 w-auto object-contain">
                        @else
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400">
                                <i class="fa-solid fa-layer-group text-lg"></i>
                            </div>
                        @endif
                        <span class="font-extrabold text-xl text-white tracking-tight">{{ $configer?->name ?? 'AccueVault' }}</span>
                    </div>

                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 mb-3">
                            <i class="fa-solid fa-user-plus text-[11px]"></i> Client Registration
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-tight">
                            Join Thousands of Marketers & Businesses
                        </h2>
                        <p class="text-xs sm:text-sm text-emerald-100/80 mt-2 leading-relaxed">
                            Create your personal client dashboard to order bulk PVA accounts, sync your shopping cart, and manage delivery archives.
                        </p>
                    </div>

                    <!-- Trust Pillars -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bolt text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <strong class="text-white block font-bold">Automatic Order Tracking</strong>
                                <span class="text-emerald-200/70 text-[11px]">Instant history & delivery receipts</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                            <div class="w-8 h-8 rounded-xl bg-teal-500/20 text-teal-300 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-cart-shopping text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <strong class="text-white block font-bold">Cloud Synced Cart</strong>
                                <span class="text-emerald-200/70 text-[11px]">Cart preserved across devices & logins</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                            <div class="w-8 h-8 rounded-xl bg-blue-500/20 text-blue-300 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-headset text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <strong class="text-white block font-bold">Priority WhatsApp Support</strong>
                                <span class="text-emerald-200/70 text-[11px]">Direct 24/7 client dispatch channel</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 pt-6 mt-6 border-t border-white/10 flex items-center justify-between text-[11px] text-emerald-200/70">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-lock text-emerald-400"></i> Encrypted Credentials</span>
                    <span>100% Privacy</span>
                </div>

            </div>

            <!-- Right Column: Registration Form (7 Cols) -->
            <div class="lg:col-span-7 p-8 sm:p-12 bg-white flex flex-col justify-center">
                
                <div class="max-w-md w-full mx-auto space-y-6">
                    
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Create Account</h1>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Set up your client portal in less than 30 seconds.
                        </p>
                    </div>

                    <!-- Flash & Validation Errors -->
                    @if (isset($errors) && $errors->any())
                        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-start gap-3">
                            <i class="fa-solid fa-circle-exclamation text-rose-500 text-base shrink-0 mt-0.5"></i>
                            <div>
                                <strong class="font-bold block">Registration Error</strong>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Sign Up Form -->
                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Full Name -->
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
                                       value="{{ old('name') }}" 
                                       required 
                                       autocomplete="name" 
                                       autofocus 
                                       placeholder="John Doe"
                                       class="auth-input">
                            </div>
                            @error('name')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Email Address <span class="text-emerald-600">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-envelope text-sm"></i>
                                </div>
                                <input type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="email" 
                                       placeholder="name@example.com"
                                       class="auth-input">
                            </div>
                            @error('email')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone / WhatsApp Input -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Phone / WhatsApp Number <span class="text-slate-400 font-normal">(Optional for delivery updates)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-phone text-sm"></i>
                                </div>
                                <input type="text" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="+1 (555) 000-0000"
                                       class="auth-input">
                            </div>
                            @error('phone')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div x-data="{ showPass: false, showConf: false }">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Password <span class="text-emerald-600">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                            <i class="fa-solid fa-lock text-sm"></i>
                                        </div>
                                        <input :type="showPass ? 'text' : 'password'" 
                                               name="password" 
                                               required 
                                               autocomplete="new-password" 
                                               placeholder="••••••••"
                                               class="auth-input pr-10">
                                        <button type="button" 
                                                @click="showPass = !showPass" 
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                                            <i :class="showPass ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Confirm <span class="text-emerald-600">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                            <i class="fa-solid fa-lock text-sm"></i>
                                        </div>
                                        <input :type="showConf ? 'text' : 'password'" 
                                               name="password_confirmation" 
                                               required 
                                               autocomplete="new-password" 
                                               placeholder="••••••••"
                                               class="auth-input pr-10">
                                        <button type="button" 
                                                @click="showConf = !showConf" 
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                                            <i :class="showConf ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('password')
                                <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Terms Notice -->
                        <div class="text-[11px] text-slate-500 pt-1 leading-relaxed">
                            By creating an account, you agree to our 
                            <a href="{{ route('terms.condition') }}" class="text-emerald-700 font-semibold hover:underline">Terms of Service</a> 
                            and 48-Hour Replacement Guarantee.
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2.5 py-3.5 px-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/35 transition-all duration-200 cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0">
                                <span>Complete Registration</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </button>
                        </div>

                    </form>

                    <!-- Sign In Redirect -->
                    <div class="pt-4 border-t border-slate-100 text-center">
                        <p class="text-xs text-slate-500">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-extrabold text-emerald-600 hover:text-emerald-700 ml-1 transition">
                                Sign In here
                            </a>
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
