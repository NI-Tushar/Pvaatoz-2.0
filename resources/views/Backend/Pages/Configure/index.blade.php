@extends('Backend.Layouts.master')
@section('title', 'Website Configurations')

@push('css')
<style>
    .admin-card {
        background-color: #1e293b;
        border: 1px solid rgba(51, 65, 85, 0.8);
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }
    .admin-card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(51, 65, 85, 0.8);
        background: rgba(15, 23, 42, 0.4);
    }
    .admin-input {
        width: 100%;
        background-color: #0f172a;
        border: 1px solid #334155;
        border-radius: 0.75rem;
        padding: 0.65rem 1rem;
        font-size: 0.875rem;
        color: #f8fafc;
        transition: all 0.2s ease;
    }
    .admin-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        background-color: #0b1120;
    }
    .admin-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin-bottom: 0.375rem;
    }
</style>
@endpush

@section('master-content')

@php
    $logoUrl = $configer?->logo 
        ? (str_starts_with($configer->logo, 'http') || str_starts_with($configer->logo, 'storage/') ? asset($configer->logo) : asset('storage/' . $configer->logo)) 
        : asset('img-preview.png');
    $faviconUrl = $configer?->logo_two 
        ? (str_starts_with($configer->logo_two, 'http') || str_starts_with($configer->logo_two, 'storage/') ? asset($configer->logo_two) : asset('storage/' . $configer->logo_two)) 
        : asset('small-logo.png');
@endphp

<div class="p-6 md:p-8 max-w-7xl mx-auto space-y-6">

    <!-- Top Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-700/80">
        <div>
            <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-2.5">
                <i class="fa-solid fa-sliders text-emerald-400"></i>
                <span>Website Configurations & Settings</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Customize brand identity, logo, favicon, contact credentials, social links, and company details.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-600 font-semibold px-4 py-2.5 rounded-xl transition-all text-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                <span>View Live Site</span>
            </a>
            <button type="submit" form="configForm" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-xs sm:text-sm">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </div>

    <!-- Flash Notifications -->
    @if(session('success') || session('message'))
        <div class="p-4 rounded-xl bg-emerald-950/70 border border-emerald-800 text-emerald-300 flex items-center gap-3 shadow-md">
            <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
            <span class="text-sm font-medium">{{ session('success') ?? session('message') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-950/70 border border-rose-800 text-rose-300 space-y-1 shadow-md">
            <div class="flex items-center gap-2 text-sm font-bold text-rose-200">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Please fix the following errors:</span>
            </div>
            <ul class="text-xs list-disc list-inside space-y-0.5 text-rose-300">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Configuration Form -->
    <form id="configForm" 
          action="{{ ($configer && $configer->exists) ? route('admin.configer.update', $configer->id) : route('admin.configer.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @if($configer && $configer->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN (7 COLS): Basic Info & Branding -->
            <div class="lg:col-span-7 space-y-8">
                
                <!-- Card 1: Basic Company Information -->
                <div class="admin-card">
                    <div class="admin-card-header flex items-center justify-between">
                        <h3 class="text-emerald-400 font-bold text-base flex items-center gap-2">
                            <i class="fa-solid fa-building"></i>
                            <span>Basic Company Information</span>
                        </h3>
                        <span class="text-xs text-slate-400">Core Contact Info</span>
                    </div>
                    
                    <div class="p-6 space-y-5">
                        
                        <!-- Company Name -->
                        <div>
                            <label for="name" class="admin-label">
                                Company / Brand Name <span class="text-emerald-400">*</span>
                            </label>
                            <input type="text" name="name" id="name" required
                                   value="{{ old('name', $configer?->name) }}" 
                                   placeholder="e.g. AccueVault"
                                   class="admin-input @error('name') border-rose-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email & Phone (Grid) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="admin-label">
                                    Support Email <span class="text-emerald-400">*</span>
                                </label>
                                <input type="email" name="email" id="email" required
                                       value="{{ old('email', $configer?->email) }}" 
                                       placeholder="support@accuevault.com"
                                       class="admin-input @error('email') border-rose-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="admin-label">
                                    Phone / WhatsApp Number <span class="text-emerald-400">*</span>
                                </label>
                                <input type="text" name="phone" id="phone" required
                                       value="{{ old('phone', $configer?->phone) }}" 
                                       placeholder="+1 (555) 019-2834"
                                       class="admin-input @error('phone') border-rose-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Company Address -->
                        <div>
                            <label for="address" class="admin-label">
                                Business Address / Headquarters
                            </label>
                            <textarea name="address" id="address" rows="2" 
                                      placeholder="123 Market Street, Suite 400, New York, NY 10001"
                                      class="admin-input @error('address') border-rose-500 @enderror">{{ old('address', $configer?->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Promo Video -->
                        <div>
                            <label for="video" class="admin-label">
                                Promotional Video Embed URL
                            </label>
                            <input type="text" name="video" id="video" 
                                   value="{{ old('video', $configer?->video) }}" 
                                   placeholder="https://www.youtube.com/embed/..."
                                   class="admin-input @error('video') border-rose-500 @enderror">
                            <span class="text-[11px] text-slate-500 mt-1 block">
                                Embed format (e.g. <code>https://www.youtube.com/embed/dQw4w9WgXcQ</code>)
                            </span>
                            @error('video')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Card 2: Website Branding (Logo & Favicon) -->
                <div class="admin-card">
                    <div class="admin-card-header flex items-center justify-between">
                        <h3 class="text-emerald-400 font-bold text-base flex items-center gap-2">
                            <i class="fa-solid fa-palette"></i>
                            <span>Website Branding (Logo & Favicon)</span>
                        </h3>
                        <span class="text-xs text-slate-400">Live Preview</span>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Logo Section -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="admin-label text-slate-200 mb-0">
                                    Primary Website Logo
                                </label>
                                @if($configer?->logo)
                                    <span class="text-[11px] font-semibold text-emerald-400 bg-emerald-950/70 border border-emerald-800/80 px-2 py-0.5 rounded-full flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> Current Logo Active
                                    </span>
                                @else
                                    <span class="text-[11px] text-slate-400 bg-slate-800 px-2 py-0.5 rounded-full">
                                        Default Text Logo
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-xs text-slate-400">
                                Displayed in website header, footer, admin sidebar, and login page. Recommended: PNG, SVG, or WebP.
                            </p>

                            <!-- Logo Preview Box -->
                            <div class="relative w-full h-[150px] bg-slate-950/90 border border-slate-700/80 rounded-xl p-4 flex items-center justify-center overflow-hidden group">
                                <img id="ImagePreview" 
                                     class="max-h-full max-w-full object-contain filter drop-shadow-md transition-transform duration-300 group-hover:scale-105" 
                                     src="{{ $logoUrl }}" 
                                     alt="Website Logo"
                                     onerror="this.onerror=null; this.src='{{ asset('img-preview.png') }}';">
                                
                                <!-- Hover Overlay for Easy Click -->
                                <label for="image" class="absolute inset-0 bg-slate-950/75 opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer flex flex-col items-center justify-center gap-1.5 text-white">
                                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-emerald-400"></i>
                                    <span class="text-xs font-semibold">Click to Change Logo</span>
                                </label>
                                <input type="file" name="logo" id="image" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="hidden">
                            </div>

                            <div class="flex items-center justify-between gap-3 pt-1">
                                <label for="image" class="cursor-pointer inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition shadow">
                                    <i class="fa-solid fa-upload text-[11px]"></i> Choose Logo Image
                                </label>
                                <span id="logoFileName" class="text-xs text-slate-400 truncate max-w-[240px]">
                                    {{ $configer?->logo ? basename($configer->logo) : 'No new file chosen' }}
                                </span>
                            </div>
                            @error('logo')
                                <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="border-slate-700/80">

                        <!-- Favicon Section -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="admin-label text-slate-200 mb-0">
                                    Website Favicon (Browser Tab Icon)
                                </label>
                                @if($configer?->logo_two)
                                    <span class="text-[11px] font-semibold text-emerald-400 bg-emerald-950/70 border border-emerald-800/80 px-2 py-0.5 rounded-full flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> Current Favicon Active
                                    </span>
                                @else
                                    <span class="text-[11px] text-slate-400 bg-slate-800 px-2 py-0.5 rounded-full">
                                        Default Favicon
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-xs text-slate-400">
                                Displayed in browser tabs, bookmarks, and mobile shortcuts. Recommended: Square ratio (.ico, .png, .svg).
                            </p>

                            <!-- Favicon Preview Box with Browser Tab Simulation -->
                            <div class="relative w-full h-[150px] bg-slate-950/90 border border-slate-700/80 rounded-xl p-3 flex flex-col items-center justify-center gap-2.5 overflow-hidden group">
                                
                                <!-- Simulated Browser Tab Preview -->
                                <div class="bg-slate-800/90 border border-slate-700/80 rounded-t-lg px-3 py-1 flex items-center gap-2 max-w-[240px] shadow-sm">
                                    <img id="FaviconTabPreview" 
                                         class="w-4 h-4 object-contain rounded" 
                                         src="{{ $faviconUrl }}" 
                                         alt="Tab Favicon"
                                         onerror="this.onerror=null; this.src='{{ asset('small-logo.png') }}';">
                                    <span class="text-[11px] text-slate-200 truncate font-medium">{{ $configer?->name ?? 'AccueVault' }}</span>
                                    <i class="fa-solid fa-xmark text-[9px] text-slate-500 ml-auto"></i>
                                </div>

                                <!-- Favicon Square Box -->
                                <div class="w-12 h-12 bg-slate-900 rounded-lg border border-slate-700/80 p-2 flex items-center justify-center shadow-inner">
                                    <img id="ImagePreview_two" 
                                         class="w-full h-full object-contain filter drop-shadow" 
                                         src="{{ $faviconUrl }}" 
                                         alt="Favicon"
                                         onerror="this.onerror=null; this.src='{{ asset('img-preview.png') }}';">
                                </div>

                                <!-- Hover Overlay -->
                                <label for="image_two" class="absolute inset-0 bg-slate-950/75 opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer flex flex-col items-center justify-center gap-1.5 text-white">
                                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-emerald-400"></i>
                                    <span class="text-xs font-semibold">Click to Change Favicon</span>
                                </label>
                                <input type="file" name="logo_two" id="image_two" accept="image/png,image/jpeg,image/webp,image/svg+xml,image/x-icon" class="hidden">
                            </div>

                            <div class="flex items-center justify-between gap-3 pt-1">
                                <label for="image_two" class="cursor-pointer inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition shadow">
                                    <i class="fa-solid fa-upload text-[11px]"></i> Choose Favicon File
                                </label>
                                <span id="faviconFileName" class="text-xs text-slate-400 truncate max-w-[240px]">
                                    {{ $configer?->logo_two ? basename($configer->logo_two) : 'No new file chosen' }}
                                </span>
                            </div>
                            @error('logo_two')
                                <p class="text-xs text-rose-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN (5 COLS): Social Media & Company Story -->
            <div class="lg:col-span-5 space-y-8">
                
                <!-- Card 3: Social Media Links -->
                <div class="admin-card">
                    <div class="admin-card-header flex items-center justify-between">
                        <h3 class="text-emerald-400 font-bold text-base flex items-center gap-2">
                            <i class="fa-solid fa-share-nodes"></i>
                            <span>Social Media Profiles</span>
                        </h3>
                        <span class="text-xs text-slate-400">External Links</span>
                    </div>

                    <div class="p-6 space-y-4">
                        
                        <!-- Facebook -->
                        <div>
                            <label for="facebook" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-facebook text-blue-400"></i> Facebook URL
                            </label>
                            <input type="text" name="facebook" id="facebook" 
                                   value="{{ old('facebook', $configer?->facebook) }}" 
                                   placeholder="https://facebook.com/yourbrand"
                                   class="admin-input">
                            @error('facebook')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Twitter / X -->
                        <div>
                            <label for="twitter" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-x-twitter text-slate-300"></i> Twitter / X URL
                            </label>
                            <input type="text" name="twitter" id="twitter" 
                                   value="{{ old('twitter', $configer?->twitter) }}" 
                                   placeholder="https://x.com/yourbrand"
                                   class="admin-input">
                            @error('twitter')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label for="instagram" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-instagram text-pink-400"></i> Instagram URL
                            </label>
                            <input type="text" name="instagram" id="instagram" 
                                   value="{{ old('instagram', $configer?->instagram) }}" 
                                   placeholder="https://instagram.com/yourbrand"
                                   class="admin-input">
                            @error('instagram')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- WhatsApp -->
                        <div>
                            <label for="whatsapp" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp text-emerald-400"></i> WhatsApp Number or Link
                            </label>
                            <input type="text" name="whatsapp" id="whatsapp" 
                                   value="{{ old('whatsapp', $configer?->whatsapp) }}" 
                                   placeholder="+15550192834 or https://wa.me/15550192834"
                                   class="admin-input">
                            <span class="text-[11px] text-slate-500 mt-1 block">
                                Phone number with country code (e.g. <code>+15550192834</code>) or direct wa.me link.
                            </span>
                            @error('whatsapp')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telegram -->
                        <div>
                            <label for="telegram" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-telegram text-sky-400"></i> Telegram Username or Link
                            </label>
                            <input type="text" name="telegram" id="telegram" 
                                   value="{{ old('telegram', $configer?->telegram) }}" 
                                   placeholder="https://t.me/yourusername"
                                   class="admin-input">
                            @error('telegram')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Discord -->
                        <div>
                            <label for="discord" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-discord text-indigo-400"></i> Discord URL or Server Invite
                            </label>
                            <input type="text" name="discord" id="discord" 
                                   value="{{ old('discord', $configer?->discord) }}" 
                                   placeholder="https://discord.gg/yourinvite"
                                   class="admin-input">
                            @error('discord')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- YouTube -->
                        <div>
                            <label for="youtube" class="admin-label flex items-center gap-1.5">
                                <i class="fa-brands fa-youtube text-red-500"></i> YouTube URL
                            </label>
                            <input type="text" name="youtube" id="youtube" 
                                   value="{{ old('youtube', $configer?->youtube) }}" 
                                   placeholder="https://youtube.com/@yourchannel"
                                   class="admin-input">
                            @error('youtube')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Card 4: Company Profile / Description -->
                <div class="admin-card">
                    <div class="admin-card-header flex items-center justify-between">
                        <h3 class="text-emerald-400 font-bold text-base flex items-center gap-2">
                            <i class="fa-solid fa-align-left"></i>
                            <span>Company Profile & Bio</span>
                        </h3>
                        <span class="text-xs text-slate-400">Footer & About</span>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <label for="companydetail" class="admin-label">
                                Company Details / About Description
                            </label>
                            <textarea name="companydetail" id="companydetail" rows="7" 
                                      placeholder="Brief overview of your company, services, and trust mission for visitors..."
                                      class="admin-input leading-relaxed">{{ old('companydetail', $configer?->companydetail) }}</textarea>
                            <span class="text-[11px] text-slate-400 mt-1 block">
                                This text appears in the website footer and about overview.
                            </span>
                            @error('companydetail')
                                <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Bottom Save Button Bar -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-700/80 mt-8">
            <button type="submit" class="inline-flex items-center gap-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-sm transform hover:-translate-y-0.5 active:translate-y-0">
                <i class="fa-solid fa-floppy-disk text-base"></i>
                <span>Save All Configurations</span>
            </button>
        </div>

    </form>

</div>

@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupLivePreview(inputId, previewImgId, nameDisplayId, tabPreviewId) {
            const inputEl = document.getElementById(inputId);
            const previewEl = document.getElementById(previewImgId);
            const nameEl = document.getElementById(nameDisplayId);
            const tabEl = tabPreviewId ? document.getElementById(tabPreviewId) : null;

            if (!inputEl || !previewEl) return;

            inputEl.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewEl.src = e.target.result;
                        if (tabEl) {
                            tabEl.src = e.target.result;
                        }
                    };

                    reader.readAsDataURL(file);

                    if (nameEl) {
                        const sizeKb = (file.size / 1024).toFixed(1);
                        nameEl.innerHTML = `<span class="text-emerald-400 font-bold"><i class="fa-solid fa-check text-[10px]"></i> ${file.name}</span> <span class="text-slate-400 text-[11px]">(${sizeKb} KB)</span>`;
                    }
                }
            });
        }

        setupLivePreview('image', 'ImagePreview', 'logoFileName');
        setupLivePreview('image_two', 'ImagePreview_two', 'faviconFileName', 'FaviconTabPreview');
    });
</script>
@endpush
