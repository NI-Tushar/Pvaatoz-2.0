@extends('layouts.app')
@section('title', 'Sign In | ' . ($configer?->name ?? config('app.name', 'AccueVault')))

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
            
            <!-- Left Column: Brand Showcase & Trust Elements (5 Cols) -->
            <div class="lg:col-span-5 p-8 sm:p-10 text-white flex flex-col justify-between relative overflow-hidden"
                 style="background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);">
                
                <!-- Ambient Radial Glow -->
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
                            <i class="fa-solid fa-shield-check text-[11px]"></i> Verified Client Portal
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-tight">
                            Access Your PVA Orders & Active Cart
                        </h2>
                        <p class="text-xs sm:text-sm text-emerald-100/80 mt-2 leading-relaxed">
                            Sign in to review credentials, track pending deliveries, manage shopping carts, and configure profile security.
                        </p>
                    </div>

                    <!-- Trust Pillars -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bolt text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <strong class="text-white block font-bold">Instant Order Dispatch</strong>
                                <span class="text-emerald-200/70 text-[11px]">Delivered to your email within 1-5 minutes</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                            <div class="w-8 h-8 rounded-xl bg-teal-500/20 text-teal-300 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-sim-card text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <strong class="text-white block font-bold">100% Real Physical SIMs</strong>
                                <span class="text-emerald-200/70 text-[11px]">Private, non-VoIP genuine verification</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
                            <div class="w-8 h-8 rounded-xl bg-blue-500/20 text-blue-300 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-rotate-left text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <strong class="text-white block font-bold">48-Hour Replacement Guarantee</strong>
                                <span class="text-emerald-200/70 text-[11px]">Hassle-free 1-to-1 account replacement</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 pt-6 mt-6 border-t border-white/10 flex items-center justify-between text-[11px] text-emerald-200/70">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-lock text-emerald-400"></i> 256-Bit SSL Encrypted</span>
                    <span>24/7 Live Support</span>
                </div>

            </div>

            <!-- Right Column: Sign In Form (7 Cols) -->
            <div class="lg:col-span-7 p-8 sm:p-12 bg-white flex flex-col justify-center">
                
                <div class="max-w-md w-full mx-auto space-y-6">
                    
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Sign In</h1>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">
                            Enter your registered email and password to enter your dashboard.
                        </p>
                    </div>

                    <!-- Flash & Validation Errors -->
                    @if ($errors->any())
                        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-start gap-3">
                            <i class="fa-solid fa-circle-exclamation text-rose-500 text-base shrink-0 mt-0.5"></i>
                            <div>
                                <strong class="font-bold block">Authentication Failed</strong>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @elseif (session('error'))
                        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-center gap-3">
                            <i class="fa-solid fa-circle-exclamation text-rose-500 text-base shrink-0"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <!-- Sign In Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

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
                                       autofocus 
                                       placeholder="name@example.com"
                                       class="auth-input">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div x-data="{ showPass: false }">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                    Password <span class="text-emerald-600">*</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-lock text-sm"></i>
                                </div>
                                <input :type="showPass ? 'text' : 'password'" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password" 
                                       placeholder="••••••••"
                                       class="auth-input pr-10">
                                <button type="button" 
                                        @click="showPass = !showPass" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 cursor-pointer">
                                    <i :class="showPass ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between pt-1">
                            <label class="inline-flex items-center gap-2 cursor-pointer text-xs text-slate-600 select-none">
                                <input type="checkbox" name="remember" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                                <span>Keep me signed in</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2.5 py-3.5 px-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/35 transition-all duration-200 cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0">
                                <span>Sign In to Your Dashboard</span>
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </button>
                        </div>

                    </form>

                    <!-- Sign Up Redirect -->
                    <div class="pt-4 border-t border-slate-100 text-center">
                        <p class="text-xs text-slate-500">
                            Don't have an account yet?
                            <a href="{{ route('register') }}" class="font-extrabold text-emerald-600 hover:text-emerald-700 ml-1 transition">
                                Create an Account
                            </a>
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
