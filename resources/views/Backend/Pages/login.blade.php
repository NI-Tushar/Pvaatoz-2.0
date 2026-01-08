@extends('Backend.Layouts.app')
@section('title', 'Admin | Login')
@section('app-content')
@php
    $configer = App\Models\Configer::latest()->first();
@endphp
  
<div class="bg-gray-100 min-h-screen flex items-center justify-center font-sans text-gray-700">

    <!-- Main Container -->
    <div class="w-full max-w-sm p-4">
        
        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden border border-gray-100">
            
            <!-- Card Body -->
            <div class="p-8">
                
                <!-- Logo Area -->
                <div style="width: 100%; margin: auto; text-align: center; margin-bottom: 20px;">
                    <h2 class="font-bold text-[30px]">
                        <a href="{{ route('home') }}">
                            <!-- Using CSS variable for the specific green requested -->
                            <span class="text-[var(--brand-green)]">{{$configer->name}}
                        </a>
                    </h2>
                </div>

                <!-- Login Form -->
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                  
                    <!-- Email Input Group -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="email" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--brand-green)] focus:border-[var(--brand-green)] placeholder-gray-400 text-sm transition-colors" 
                                name="email" 
                                placeholder="Email"
                                required>
                            
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="fas fa-envelope text-gray-400"></span>
                            </div>
                        </div>
                        <!-- Error Message Placeholder (Blade Logic) -->
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input Group -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="password" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--brand-green)] focus:border-[var(--brand-green)] placeholder-gray-400 text-sm transition-colors" 
                                name="password" 
                                placeholder="Password"
                                required>
                            
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="fas fa-lock text-gray-400"></span>
                            </div>
                        </div>
                        <!-- Error Message Placeholder (Blade Logic) -->
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions Row -->
                    <div class="flex items-center justify-between mb-6">
                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" 
                                class="h-4 w-4 text-[var(--brand-green)] focus:ring-[var(--brand-green)] border-gray-300 rounded cursor-pointer">
                            <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer select-none">
                                Remember Me
                            </label>
                        </div>
                        
                        <!-- Forgot Password (Optional layout retention) -->
                        <div class="text-sm">
                            <a href="#" class="font-medium text-[var(--brand-green)] hover:opacity-75 transition-opacity">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-[var(--brand-green)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--brand-green)] transition-all">
                        Sign In
                    </button>

                </form>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    &copy; 2023 <span class="font-semibold text-gray-700">PVAAtoZ</span>. All rights reserved.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection