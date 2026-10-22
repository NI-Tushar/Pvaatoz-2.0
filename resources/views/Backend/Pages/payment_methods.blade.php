@extends('Backend.Layouts.master')
@section('title', 'Payment Methods & API Credentials')

@push('css')
<style>
    .admin-card {
        background-color: #1e293b;
        border: 1px solid rgba(51, 65, 85, 0.8);
        border-radius: 1.25rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }
    .admin-input {
        width: 100%;
        background-color: #0f172a;
        border: 1px solid #334155;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: #f8fafc;
        transition: all 0.2s ease;
    }
    .admin-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25);
        background-color: #0b1120;
    }
    .admin-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin-bottom: 0.5rem;
    }
    .crypto-tab-btn {
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .crypto-tab-btn.active {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(6, 78, 59, 0.3) 100%);
        border-color: #10b981;
        color: #ffffff;
        box-shadow: 0 4px 15px -3px rgba(16, 185, 129, 0.3);
    }
</style>
@endpush

@section('master-content')

@php
    $activeSlug = request('active', $methods->first()?->slug ?? 'usdt_trc20');
    $enabledCount = $methods->where('is_enabled', true)->count();
    $totalCount = $methods->count();
@endphp

<div class="p-6 md:p-8 max-w-7xl mx-auto space-y-8" 
     x-data="{ 
        activeTab: '{{ $activeSlug }}',
        copiedField: null,
        copyToClipboard(text, id) {
            if (!text) return;
            navigator.clipboard.writeText(text);
            this.copiedField = id;
            setTimeout(() => { this.copiedField = null; }, 2000);
        }
     }">

    <!-- Top Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-700/80">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <i class="fa-solid fa-wallet text-[11px]"></i> Payment Gateways
                </span>
                <span class="text-xs text-slate-400">
                    • {{ $enabledCount }} of {{ $totalCount }} Active on Checkout
                </span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Payment Methods & API Credentials</h1>
            <p class="text-slate-400 text-sm mt-1">Configure receiving wallet addresses, API keys, QR codes, and checkout availability.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('checkout') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 text-xs font-bold transition shadow-sm">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-emerald-400"></i>
                <span>Preview Checkout</span>
            </a>
        </div>
    </div>

    <!-- Flash Success Message -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 flex items-center justify-between text-sm shadow-md animate-fade-in">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200 text-sm font-bold p-1">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    <!-- Validation Errors -->
    @if(isset($errors) && $errors->any())
        <div class="p-4 rounded-2xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-sm space-y-1">
            <div class="font-bold flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Please correct the following errors:
            </div>
            <ul class="list-disc pl-5 text-xs text-rose-300/90 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top Method Selection Buttons -->
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <label class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                <i class="fa-solid fa-coins text-emerald-400"></i>
                Select Payment Method to Configure:
            </label>
            <span class="text-xs text-slate-400">Click a button to switch settings form</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
            @foreach($methods as $m)
                @php
                    $isUsdt = str_contains($m->slug, 'usdt');
                    $isUsdc = str_contains($m->slug, 'usdc');
                    $isSol = str_contains($m->slug, 'solana');
                    $isBtc = str_contains($m->slug, 'btc');

                    $iconClass = $isUsdt ? 'fa-solid fa-coins text-emerald-400' 
                               : ($isUsdc ? 'fa-solid fa-circle-dollar-to-slot text-blue-400' 
                               : ($isSol ? 'fa-solid fa-bolt text-purple-400' 
                               : 'fa-brands fa-bitcoin text-amber-400'));
                @endphp
                <button type="button" 
                        id="tab-btn-{{ $m->slug }}"
                        @click="activeTab = '{{ $m->slug }}'"
                        onclick="switchPaymentTab('{{ $m->slug }}')"
                        :class="activeTab === '{{ $m->slug }}' ? 'active' : 'bg-slate-800/80 hover:bg-slate-800 text-slate-300 border-slate-700/80'"
                        class="crypto-tab-btn p-4 rounded-2xl border text-left flex flex-col justify-between gap-3 cursor-pointer group shadow-sm {{ $m->slug === $activeSlug ? 'active' : '' }}">
                    
                    <div class="flex items-center justify-between w-full">
                        <div class="w-10 h-10 rounded-xl bg-slate-900/80 border border-slate-700 flex items-center justify-center text-lg">
                            <i class="{{ $iconClass }}"></i>
                        </div>

                        <!-- Status Dot -->
                        @if($m->is_enabled)
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                Enabled
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-slate-700/60 text-slate-400 border border-slate-600/60">
                                Disabled
                            </span>
                        @endif
                    </div>

                    <div>
                        <span class="font-extrabold text-white text-sm block group-hover:text-emerald-300 transition-colors">
                            {{ $m->name }}
                        </span>
                        <span class="text-xs text-slate-400 block font-mono mt-0.5">
                            {{ $m->network ?? $m->currency }}
                        </span>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Forms for Each Payment Method -->
    @foreach($methods as $method)
        <div id="payment-form-{{ $method->slug }}"
             class="payment-method-form space-y-6"
             x-show="activeTab === '{{ $method->slug }}'" 
             x-cloak
             style="{{ $method->slug === $activeSlug ? '' : 'display: none !important;' }}">

            <!-- Card Container -->
            <div class="admin-card">
                
                <!-- Card Header with Toggle Switch -->
                <div class="p-5 sm:p-6 bg-slate-900/60 border-b border-slate-700/80 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-2xl text-emerald-400 shrink-0">
                            @if(str_contains($method->slug, 'usdt'))
                                <i class="fa-solid fa-coins text-emerald-400"></i>
                            @elseif(str_contains($method->slug, 'usdc'))
                                <i class="fa-solid fa-circle-dollar-to-slot text-blue-400"></i>
                            @elseif(str_contains($method->slug, 'solana'))
                                <i class="fa-solid fa-bolt text-purple-400"></i>
                            @else
                                <i class="fa-brands fa-bitcoin text-amber-400"></i>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="text-xl font-extrabold text-white">{{ $method->name }} Configuration</h2>
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold font-mono bg-slate-800 text-slate-300 border border-slate-700">
                                    {{ $method->currency }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Network: <strong class="text-slate-200">{{ $method->network ?? 'Direct Transfer' }}</strong></p>
                        </div>
                    </div>

                    <!-- Direct Enable / Disable Toggle Button -->
                    <div class="flex items-center gap-3">
                        <form method="POST" action="{{ route('admin.payment-methods.toggle', $method->id) }}" class="inline m-0">
                            @csrf
                            @if($method->is_enabled)
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs bg-emerald-500/20 hover:bg-rose-500/20 text-emerald-400 hover:text-rose-400 border border-emerald-500/30 hover:border-rose-500/30 transition shadow-sm cursor-pointer group"
                                        title="Click to Disable this payment method">
                                    <i class="fa-solid fa-toggle-on text-base text-emerald-400 group-hover:hidden"></i>
                                    <i class="fa-solid fa-toggle-off text-base text-rose-400 hidden group-hover:inline-block"></i>
                                    <span class="group-hover:hidden">Active on Checkout</span>
                                    <span class="hidden group-hover:inline-block">Click to Disable</span>
                                </button>
                            @else
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs bg-slate-800 hover:bg-emerald-500/20 text-slate-400 hover:text-emerald-400 border border-slate-700 hover:border-emerald-500/30 transition shadow-sm cursor-pointer group"
                                        title="Click to Enable this payment method">
                                    <i class="fa-solid fa-toggle-off text-base text-slate-400 group-hover:hidden"></i>
                                    <i class="fa-solid fa-toggle-on text-base text-emerald-400 hidden group-hover:inline-block"></i>
                                    <span class="group-hover:hidden">Disabled (Hidden)</span>
                                    <span class="hidden group-hover:inline-block">Click to Enable</span>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Form Body -->
                <form method="POST" 
                      action="{{ route('admin.payment-methods.update', $method->id) }}" 
                      enctype="multipart/form-data" 
                      class="p-6 md:p-8 space-y-6">
                    @csrf

                    <!-- Status Checkbox (Synchronized) -->
                    <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 flex items-center justify-between">
                        <div>
                            <span class="text-sm font-bold text-white block">Checkout Display Status</span>
                            <span class="text-xs text-slate-400">When enabled, customers can choose this method on the website checkout page.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_enabled" value="1" {{ $method->is_enabled ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>

                    <!-- Method Display Title & Currency -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="admin-label">Display Method Name <span class="text-emerald-400">*</span></label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name', $method->name) }}" 
                                   required 
                                   placeholder="e.g. USDT (TRC20)" 
                                   class="admin-input">
                        </div>

                        <div>
                            <label class="admin-label">Network / Blockchain Protocol</label>
                            <input type="text" 
                                   name="network" 
                                   value="{{ old('network', $method->network) }}" 
                                   placeholder="e.g. TRON TRC20, Solana Mainnet" 
                                   class="admin-input">
                        </div>
                    </div>

                    <!-- Receiving Wallet Address -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="admin-label mb-0">Receiving Wallet Address <span class="text-emerald-400">*</span></label>
                            @if(!empty($method->wallet_address))
                                <button type="button" 
                                        @click="copyToClipboard('{{ addslashes($method->wallet_address) }}', '{{ $method->slug }}_wallet')"
                                        class="text-xs text-emerald-400 hover:text-emerald-300 font-bold flex items-center gap-1 transition">
                                    <i class="fa-solid fa-copy text-[11px]"></i>
                                    <span x-text="copiedField === '{{ $method->slug }}_wallet' ? 'Copied!' : 'Copy Address'"></span>
                                </button>
                            @endif
                        </div>
                        <div class="relative">
                            <input type="text" 
                                   name="wallet_address" 
                                   value="{{ old('wallet_address', $method->wallet_address) }}" 
                                   placeholder="Paste your {{ $method->name }} public receiving address here" 
                                   class="admin-input font-mono text-xs sm:text-sm pr-10">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-500">
                                <i class="fa-solid fa-wallet text-sm"></i>
                            </div>
                        </div>
                        <span class="text-[11px] text-slate-500 mt-1 block">This address is displayed to customers on checkout along with a one-click copy button.</span>
                    </div>

                    <!-- API Credentials Section (API Key & Secret) -->
                    <div class="p-5 rounded-2xl bg-slate-900/40 border border-slate-800 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-300 flex items-center gap-2">
                                <i class="fa-solid fa-key text-emerald-400"></i>
                                API Credentials (For Gateway / Automation Integration)
                            </h3>
                            <span class="text-[11px] text-slate-500">Optional if using direct wallet transfer</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- API Key -->
                            <div x-data="{ showKey: false }">
                                <div class="flex items-center justify-between mb-1">
                                    <label class="admin-label mb-0">API Key / Public Key</label>
                                    <button type="button" @click="showKey = !showKey" class="text-[11px] text-slate-400 hover:text-slate-200">
                                        <i :class="showKey ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                                        <span x-text="showKey ? 'Hide' : 'Show'"></span>
                                    </button>
                                </div>
                                <input :type="showKey ? 'text' : 'password'" 
                                       name="api_key" 
                                       value="{{ old('api_key', $method->api_key) }}" 
                                       placeholder="Enter your API Key" 
                                       class="admin-input font-mono text-xs">
                            </div>

                            <!-- API Secret / Private Key -->
                            <div x-data="{ showSecret: false }">
                                <div class="flex items-center justify-between mb-1">
                                    <label class="admin-label mb-0">API Secret / Private Key</label>
                                    <button type="button" @click="showSecret = !showSecret" class="text-[11px] text-slate-400 hover:text-slate-200">
                                        <i :class="showSecret ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                                        <span x-text="showSecret ? 'Hide' : 'Show'"></span>
                                    </button>
                                </div>
                                <input :type="showSecret ? 'text' : 'password'" 
                                       name="api_secret" 
                                       value="{{ old('api_secret', $method->api_secret) }}" 
                                       placeholder="Enter your API Secret / Private Key" 
                                       class="admin-input font-mono text-xs">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Merchant ID -->
                            <div>
                                <label class="admin-label">Merchant ID / Account ID</label>
                                <input type="text" 
                                       name="merchant_id" 
                                       value="{{ old('merchant_id', $method->merchant_id) }}" 
                                       placeholder="e.g. MERCH-123456" 
                                       class="admin-input font-mono text-xs">
                            </div>

                            <!-- IPN / Webhook Secret -->
                            <div>
                                <label class="admin-label">IPN Secret / Webhook Secret</label>
                                <input type="text" 
                                       name="ipn_secret" 
                                       value="{{ old('ipn_secret', $method->ipn_secret) }}" 
                                       placeholder="Webhook secret for payment verification" 
                                       class="admin-input font-mono text-xs">
                            </div>
                        </div>
                    </div>

                    <!-- QR Code Upload & Checkout Instructions -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                        
                        <!-- QR Code Upload (4 Cols) -->
                        <div class="lg:col-span-4 p-5 rounded-2xl bg-slate-900/40 border border-slate-800 space-y-3">
                            <label class="admin-label mb-1">Wallet QR Code (Optional)</label>
                            
                            @if($method->qr_code)
                                <div class="space-y-3">
                                    <div class="w-36 h-36 mx-auto rounded-xl p-2 bg-white flex items-center justify-center border border-slate-700 shadow-inner">
                                        <img src="{{ asset('storage/' . $method->qr_code) }}" alt="QR Code" class="max-h-full max-w-full object-contain">
                                    </div>
                                    <label class="flex items-center justify-center gap-2 text-xs text-rose-400 hover:text-rose-300 cursor-pointer">
                                        <input type="checkbox" name="remove_qr_code" value="1" class="rounded text-rose-600 focus:ring-0">
                                        <span>Remove this QR code</span>
                                    </label>
                                </div>
                            @else
                                <div class="w-32 h-32 mx-auto rounded-xl bg-slate-800/80 border-2 border-dashed border-slate-700 flex flex-col items-center justify-center text-slate-500 text-center p-3">
                                    <i class="fa-solid fa-qrcode text-3xl mb-1 text-slate-600"></i>
                                    <span class="text-[10px]">No QR code uploaded</span>
                                </div>
                            @endif

                            <div class="pt-2">
                                <label class="text-[11px] text-slate-400 block mb-1">Upload New QR Code:</label>
                                <input type="file" 
                                       name="qr_code" 
                                       accept="image/*" 
                                       class="block w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-700 file:text-slate-200 hover:file:bg-slate-600 cursor-pointer">
                            </div>
                        </div>

                        <!-- Customer Instructions (8 Cols) -->
                        <div class="lg:col-span-8 space-y-2">
                            <label class="admin-label">Payment Instructions Shown to Customers on Checkout</label>
                            <textarea name="instructions" 
                                      rows="5" 
                                      placeholder="e.g. Send exact USDT amount via TRC20 network. Double check your TRC20 destination wallet address before sending."
                                      class="admin-input leading-relaxed">{{ old('instructions', $method->instructions) }}</textarea>
                            <span class="text-[11px] text-slate-500 block">Provide clear instructions regarding network selection, confirmation wait times, or transaction ID submissions.</span>
                        </div>

                    </div>

                    <!-- Submit Button Footer -->
                    <div class="pt-6 border-t border-slate-700/80 flex items-center justify-between flex-wrap gap-4">
                        <div class="text-xs text-slate-400 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-emerald-400"></i>
                            <span>Settings apply instantly across the website checkout system.</span>
                        </div>

                        <button type="submit" 
                                class="inline-flex items-center gap-2.5 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-extrabold text-sm transition-all shadow-lg shadow-emerald-900/30 cursor-pointer transform hover:-translate-y-0.5 active:translate-y-0">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Save {{ $method->name }} Credentials</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>
    @endforeach

</div>

@endsection

@push('scripts')
<script>
    function switchPaymentTab(slug) {
        // Hide all payment method forms
        document.querySelectorAll('.payment-method-form').forEach(function(el) {
            el.style.setProperty('display', 'none', 'important');
        });

        // Show selected form
        var activeForm = document.getElementById('payment-form-' + slug);
        if (activeForm) {
            activeForm.style.setProperty('display', 'block', 'important');
        }

        // Update button visual styles
        document.querySelectorAll('.crypto-tab-btn').forEach(function(btn) {
            btn.classList.remove('active');
        });
        var activeBtn = document.getElementById('tab-btn-' + slug);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }

        // If Alpine is initialized, sync state
        try {
            var root = document.querySelector('[x-data]');
            if (root && root._x_dataStack && root._x_dataStack.length > 0) {
                root._x_dataStack[0].activeTab = slug;
            }
        } catch(e) {}
    }
</script>
@endpush

