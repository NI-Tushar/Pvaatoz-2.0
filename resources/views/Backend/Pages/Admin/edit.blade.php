@extends('Backend.Layouts.master')
@section('title', 'Edit User')

@push('css')
<style>
    .form-card {
        background-color: #1e293b;
        border: 1px solid rgba(51, 65, 85, 0.8);
        border-radius: 1.25rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    .form-input {
        background-color: #0f172a;
        border: 1px solid #334155;
        border-radius: 0.75rem;
        padding: 0.65rem 1rem;
        color: #f8fafc;
        font-size: 0.875rem;
        width: 100%;
        transition: all 0.2s ease;
    }
    .form-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }
    .form-input::placeholder {
        color: #64748b;
    }
</style>
@endpush

@section('master-content')

@php
    $currentAvatar = $user->image 
        ? (str_starts_with($user->image, 'http') || str_starts_with($user->image, 'storage/') ? asset($user->image) : asset('storage/' . $user->image))
        : null;
@endphp

<div class="p-4 sm:p-6 md:p-8 max-w-4xl mx-auto space-y-6"
     x-data="{
        showPassword: false,
        passwordVal: '',
        repasswordVal: '',
        imagePreview: '{{ $currentAvatar }}',
        fileName: '',
        handleImageUpload(e) {
            const file = e.target.files[0];
            if (file) {
                this.fileName = file.name;
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.imagePreview = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        generatePassword() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*';
            let pass = '';
            for (let i = 0; i < 12; i++) {
                pass += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            this.passwordVal = pass;
            this.repasswordVal = pass;
            document.getElementById('password-input').value = pass;
            document.getElementById('repassword-input').value = pass;
            this.showPassword = true;
        }
     }">

    <!-- Breadcrumb & Top Bar -->
    <div class="flex items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-400 mb-1">
                <a href="{{ route('admin.user.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1">
                    <i class="fa-solid fa-users"></i>
                    <span>Users Directory</span>
                </a>
                <span>/</span>
                <span class="text-slate-200 font-semibold">Edit User</span>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight m-0">
                Edit {{ $accountType === 'customer' ? 'Customer' : 'Staff' }}: {{ $user->name }}
            </h1>
        </div>

        <a href="{{ route('admin.user.index', ['tab' => $accountType === 'customer' ? 'customers' : 'admins']) }}" 
           class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700 text-xs font-bold transition flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Users</span>
        </a>
    </div>

    <!-- Error Summary Card if Any -->
    @if (isset($errors) && $errors->any())
        <div class="p-4 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs sm:text-sm">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Please correct the errors below:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Edit Form -->
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="account_type" value="{{ $accountType }}">

        <!-- Account Details -->
        <div class="form-card p-6 space-y-5">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <h3 class="text-base font-bold text-white m-0 flex items-center gap-2">
                    <i class="fa-solid fa-address-card text-emerald-400"></i>
                    <span>Profile Information</span>
                </h3>
                <span class="text-xs font-bold font-mono px-2.5 py-1 rounded-full {{ $accountType === 'customer' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30' }}">
                    {{ ucfirst($accountType) }} Account
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Full Name -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                        Full Name <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                            <i class="fa-solid fa-user text-xs"></i>
                        </span>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $user->name) }}"
                               required
                               placeholder="e.g. John Doe" 
                               class="form-input pl-10 @error('name') !border-rose-500 @enderror">
                    </div>
                    @error('name')
                        <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                        Email Address <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}"
                               required
                               placeholder="e.g. john@example.com" 
                               class="form-input pl-10 @error('email') !border-rose-500 @enderror">
                    </div>
                    @error('email')
                        <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone / WhatsApp -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                        Phone / WhatsApp Number
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input type="text" 
                               name="phone" 
                               value="{{ old('phone', $user->phone) }}"
                               placeholder="e.g. +1 555-0199" 
                               class="form-input pl-10 @error('phone') !border-rose-500 @enderror">
                    </div>
                    @error('phone')
                        <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role Selector (if staff) or Status (if customer) -->
                <div>
                    @if($accountType === 'staff')
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                            Assigned Staff Role <span class="text-rose-400">*</span>
                        </label>
                        <select name="role" class="form-input cursor-pointer font-semibold text-white">
                            <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>🛡️ Full Administrator (Total Access)</option>
                            <option value="Editor" {{ old('role', $user->role) === 'Editor' ? 'selected' : '' }}>✏️ Editor (Products & Orders)</option>
                            <option value="Moderator" {{ old('role', $user->role) === 'Moderator' ? 'selected' : '' }}>👁️ Moderator (Inquiries & Viewing)</option>
                        </select>
                    @else
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                            Verification Status
                        </label>
                        <select name="is_verified" class="form-input cursor-pointer font-semibold text-white">
                            <option value="1" {{ old('is_verified', $user->is_verified) === 'Verified' ? 'selected' : '' }}>✅ Verified Account</option>
                            <option value="0" {{ old('is_verified', $user->is_verified) !== 'Verified' ? 'selected' : '' }}>⏳ Pending Verification</option>
                        </select>
                    @endif
                </div>
            </div>

            <!-- Optional Password Reset Section -->
            <div class="pt-4 border-t border-slate-800">
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-wider m-0">
                        Change Password (Leave blank to keep current)
                    </label>
                    <button type="button" 
                            @click="generatePassword()" 
                            class="text-xs text-emerald-400 hover:text-emerald-300 font-bold flex items-center gap-1.5 transition cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        <span>Generate Password</span>
                    </button>
                </div>
                <p class="text-xs text-slate-500 mb-3">Only enter a new password if you want to override the existing one.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- New Password Field -->
                    <div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" 
                                   name="password" 
                                   id="password-input"
                                   x-model="passwordVal"
                                   placeholder="New password (optional)" 
                                   class="form-input pr-10 @error('password') !border-rose-500 @enderror">
                            <button type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300 cursor-pointer">
                                <i class="fa-solid" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm New Password Field -->
                    <div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" 
                                   name="repassword" 
                                   id="repassword-input"
                                   x-model="repasswordVal"
                                   placeholder="Confirm new password" 
                                   class="form-input pr-10 @error('repassword') !border-rose-500 @enderror">
                        </div>
                        @error('repassword')
                            <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Avatar Upload -->
        <div class="form-card p-6 space-y-4">
            <h3 class="text-base font-bold text-white m-0 flex items-center gap-2 border-b border-slate-800 pb-3">
                <i class="fa-solid fa-image text-emerald-400"></i>
                <span>Profile Photo</span>
            </h3>

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <!-- Avatar Preview Area -->
                <div class="relative w-24 h-24 rounded-2xl border-2 border-dashed border-slate-700 bg-slate-900 flex items-center justify-center overflow-hidden shrink-0">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!imagePreview">
                        <div class="text-center text-slate-500">
                            <i class="fa-solid fa-user text-2xl block mb-1"></i>
                            <span class="text-[9px] uppercase font-bold tracking-wider block">No Photo</span>
                        </div>
                    </template>
                </div>

                <!-- File Selector -->
                <div class="flex-1 space-y-2">
                    <label for="image-input" 
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white border border-slate-700 text-xs font-bold cursor-pointer transition shadow-sm">
                        <i class="fa-solid fa-cloud-arrow-up text-emerald-400"></i>
                        <span x-text="fileName ? 'Change Photo (' + fileName + ')' : 'Upload New Photo'"></span>
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image-input" 
                           accept="image/png,image/jpeg,image/webp" 
                           @change="handleImageUpload($event)"
                           class="hidden">
                    <p class="text-[11px] text-slate-400 m-0">Leave unchanged to keep existing photo. Supports PNG, JPG, or WEBP.</p>
                    @error('image')
                        <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.user.index', ['tab' => $accountType === 'customer' ? 'customers' : 'admins']) }}" 
               class="px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold transition">
                Cancel
            </a>

            <button type="submit" 
                    class="px-8 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-lg shadow-emerald-600/30 transition flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save Changes</span>
            </button>
        </div>

    </form>

</div>

@endsection
