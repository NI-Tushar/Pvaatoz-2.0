@extends('Backend.Layouts.master')
@section('title', 'Add New User')

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

<div class="p-4 sm:p-6 md:p-8 max-w-4xl mx-auto space-y-6"
     x-data="{
        accountType: '{{ old('account_type', 'customer') }}',
        showPassword: false,
        passwordVal: '',
        repasswordVal: '',
        imagePreview: null,
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
        removeImage() {
            this.imagePreview = null;
            this.fileName = '';
            document.getElementById('image-input').value = '';
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
                <span class="text-slate-200 font-semibold">Add New User</span>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight m-0">Add New User Account</h1>
        </div>

        <a href="{{ route('admin.user.index') }}" 
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

    <!-- Main Creation Form -->
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- 1. Account Classification Selector -->
        <div class="form-card p-6">
            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-3">
                1. Select Account Type
            </label>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Customer Card Option -->
                <label class="relative flex items-start gap-4 p-4 rounded-xl border cursor-pointer transition"
                       :class="accountType === 'customer' ? 'bg-emerald-500/10 border-emerald-500/60 ring-1 ring-emerald-500/50' : 'bg-slate-900/60 border-slate-700/80 hover:bg-slate-800/60'">
                    <input type="radio" 
                           name="account_type" 
                           value="customer" 
                           x-model="accountType" 
                           class="mt-1 text-emerald-500 focus:ring-emerald-400 bg-slate-900 border-slate-700">
                    <div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-user-tag text-emerald-400"></i>
                            <span class="font-bold text-white text-sm">Customer / Buyer Account</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1 m-0">Website consumer who purchases accounts, tracks personal order history, and manages credentials.</p>
                    </div>
                </label>

                <!-- Staff / Admin Card Option -->
                <label class="relative flex items-start gap-4 p-4 rounded-xl border cursor-pointer transition"
                       :class="accountType === 'staff' ? 'bg-indigo-500/10 border-indigo-500/60 ring-1 ring-indigo-500/50' : 'bg-slate-900/60 border-slate-700/80 hover:bg-slate-800/60'">
                    <input type="radio" 
                           name="account_type" 
                           value="staff" 
                           x-model="accountType" 
                           class="mt-1 text-indigo-500 focus:ring-indigo-400 bg-slate-900 border-slate-700">
                    <div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-shield-halved text-indigo-400"></i>
                            <span class="font-bold text-white text-sm">Administrative Staff Member</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1 m-0">Privileged personnel with dashboard login access (Administrator, Editor, or Moderator).</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- 2. Account Details & Credentials -->
        <div class="form-card p-6 space-y-5">
            <h3 class="text-base font-bold text-white m-0 flex items-center gap-2 border-b border-slate-800 pb-3">
                <i class="fa-solid fa-address-card text-emerald-400"></i>
                <span>2. Account Information & Credentials</span>
            </h3>

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
                               value="{{ old('name') }}"
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
                               value="{{ old('email') }}"
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
                               value="{{ old('phone') }}"
                               placeholder="e.g. +1 555-0199" 
                               class="form-input pl-10 @error('phone') !border-rose-500 @enderror">
                    </div>
                    @error('phone')
                        <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role Selector -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                        Assigned Role <span class="text-rose-400">*</span>
                    </label>

                    <!-- If Staff: Dropdown of Admin Roles -->
                    <template x-if="accountType === 'staff'">
                        <select name="role" class="form-input cursor-pointer font-semibold text-white">
                            <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>🛡️ Full Administrator (Total Access)</option>
                            <option value="Editor" {{ old('role') === 'Editor' ? 'selected' : '' }}>✏️ Editor (Products & Orders)</option>
                            <option value="Moderator" {{ old('role') === 'Moderator' ? 'selected' : '' }}>👁️ Moderator (Inquiries & Viewing)</option>
                        </select>
                    </template>

                    <!-- If Customer: Fixed to Customer -->
                    <template x-if="accountType === 'customer'">
                        <div class="flex items-center gap-2">
                            <input type="text" 
                                   name="role" 
                                   value="Customer" 
                                   readonly 
                                   class="form-input bg-slate-950/70 text-slate-400 font-semibold cursor-not-allowed">
                        </div>
                    </template>
                </div>
            </div>

            <!-- Passwords Section -->
            <div class="pt-4 border-t border-slate-800">
                <div class="flex items-center justify-between mb-3">
                    <label class="text-xs font-bold text-slate-300 uppercase tracking-wider m-0">
                        Password Credentials <span class="text-rose-400">*</span>
                    </label>
                    <button type="button" 
                            @click="generatePassword()" 
                            class="text-xs text-emerald-400 hover:text-emerald-300 font-bold flex items-center gap-1.5 transition cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        <span>Generate Strong Password</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Password Field -->
                    <div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" 
                                   name="password" 
                                   id="password-input"
                                   x-model="passwordVal"
                                   required
                                   placeholder="Enter account password (min. 6 chars)" 
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

                    <!-- Confirm Password Field -->
                    <div>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" 
                                   name="repassword" 
                                   id="repassword-input"
                                   x-model="repasswordVal"
                                   required
                                   placeholder="Confirm account password" 
                                   class="form-input pr-10 @error('repassword') !border-rose-500 @enderror">
                        </div>
                        @error('repassword')
                            <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Customer Verification Status Option -->
            <template x-if="accountType === 'customer'">
                <div class="pt-3 border-t border-slate-800">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" 
                               name="is_verified" 
                               value="1" 
                               checked 
                               class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 bg-slate-900 border-slate-700">
                        <div>
                            <span class="font-bold text-white text-xs block">Pre-Verify Account</span>
                            <span class="text-[11px] text-slate-400 block">Mark this customer as already email-verified so they can log in and place orders immediately.</span>
                        </div>
                    </label>
                </div>
            </template>
        </div>

        <!-- 3. Profile Avatar Upload -->
        <div class="form-card p-6 space-y-4">
            <h3 class="text-base font-bold text-white m-0 flex items-center gap-2 border-b border-slate-800 pb-3">
                <i class="fa-solid fa-image text-emerald-400"></i>
                <span>3. Profile Photo (Optional)</span>
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

                    <!-- Remove Preview Button -->
                    <template x-if="imagePreview">
                        <button type="button" 
                                @click="removeImage()" 
                                class="absolute top-1 right-1 w-5 h-5 rounded-full bg-rose-600 text-white flex items-center justify-center text-[10px] hover:bg-rose-500 shadow">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </template>
                </div>

                <!-- File Selector -->
                <div class="flex-1 space-y-2">
                    <label for="image-input" 
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white border border-slate-700 text-xs font-bold cursor-pointer transition shadow-sm">
                        <i class="fa-solid fa-cloud-arrow-up text-emerald-400"></i>
                        <span x-text="fileName ? 'Change Selected Photo' : 'Choose Profile Image'"></span>
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image-input" 
                           accept="image/png,image/jpeg,image/webp" 
                           @change="handleImageUpload($event)"
                           class="hidden">
                    <p class="text-[11px] text-slate-400 m-0">Supports PNG, JPG, or WEBP. Max file size: 2MB. Square ratio recommended.</p>
                    @error('image')
                        <span class="text-[11px] text-rose-400 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.user.index') }}" 
               class="px-6 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold transition">
                Cancel
            </a>

            <button type="submit" 
                    class="px-8 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-lg shadow-emerald-600/30 transition flex items-center gap-2">
                <i class="fa-solid fa-user-check"></i>
                <span>Save & Create User</span>
            </button>
        </div>

    </form>

</div>

@endsection
