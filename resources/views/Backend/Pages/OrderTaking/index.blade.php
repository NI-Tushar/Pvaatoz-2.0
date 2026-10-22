@extends('Backend.Layouts.master')
@section('title', 'Order Taking Channels')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .taking-card {
        background-color: #1e293b;
        border: 1px solid rgba(51, 65, 85, 0.8);
        border-radius: 1.25rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    .taking-input {
        background-color: #0f172a;
        border: 1px solid #334155;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        color: #f8fafc;
        font-size: 0.875rem;
        width: 100%;
        transition: all 0.2s ease;
    }
    .taking-input:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }
    .taking-input::placeholder {
        color: #64748b;
    }
</style>
@endpush

@section('master-content')

<div class="p-4 sm:p-6 md:p-8 max-w-5xl mx-auto space-y-6"
     x-data="{
        showTelegramAdvanced: {{ (!empty($settings->telegram_bot_token) || !empty($settings->telegram_chat_id)) ? 'true' : 'false' }},
        showDiscordAdvanced: {{ !empty($settings->discord_webhook_url) ? 'true' : 'false' }},
        isTesting: false,
        testChannel(channel) {
            this.isTesting = true;
            fetch('{{ route('admin.order-taking.test') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ channel: channel })
            })
            .then(res => res.json())
            .then(data => {
                this.isTesting = false;
                let htmlMsg = '<div class=\'text-left text-xs space-y-2 mt-3\'>';
                for (let k in data.results) {
                    let r = data.results[k];
                    let icon = r.success ? '✅' : '⚠️';
                    htmlMsg += `<div class='p-2.5 rounded bg-slate-900 border border-slate-700'>
                        <strong class='capitalize block text-emerald-400'>${icon} ${k}:</strong>
                        <span class='text-slate-300'>${r.message}</span>
                    </div>`;
                }
                htmlMsg += '</div>';

                Swal.fire({
                    title: 'Test Notification Dispatched',
                    html: htmlMsg,
                    icon: 'info',
                    background: '#1e293b',
                    color: '#f8fafc',
                    confirmButtonColor: '#10b981'
                });
            })
            .catch(err => {
                this.isTesting = false;
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to dispatch test notification.',
                    icon: 'error',
                    background: '#1e293b',
                    color: '#f8fafc'
                });
            });
        }
     }">

    <!-- Success Toast -->
    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
             class="p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm font-semibold flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-emerald-200"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- Error Summary if Any -->
    @if ($errors->any())
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

    <!-- Top Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 border border-slate-700/80 rounded-2xl p-6 shadow-xl">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl border border-emerald-500/30">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white tracking-tight m-0">Order Taking Channels</h1>
                    <p class="text-slate-400 text-xs sm:text-sm mt-0.5">
                        Parallel automated order dispatch across Telegram, Discord, and Email.
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Test Button -->
        <button type="button" 
                @click="testChannel('all')"
                :disabled="isTesting"
                class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white border border-slate-700 text-xs font-bold transition flex items-center gap-2 shadow-sm shrink-0">
            <i class="fa-solid fa-bell text-amber-400" :class="isTesting ? 'fa-spin' : ''"></i>
            <span x-text="isTesting ? 'Sending Test...' : 'Send Test Alert to All'"></span>
        </button>
    </div>

    <!-- Active Parallel Dispatch Overview -->
    <div class="taking-card p-5 bg-gradient-to-br from-slate-900/90 to-slate-800/80">
        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-3">
            Real-Time Parallel Dispatch Status
        </span>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <!-- Telegram Status -->
            <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-700/80 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-sky-500/20 text-sky-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-brands fa-telegram"></i>
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs text-slate-400 block font-semibold">Telegram Channel</span>
                    <strong class="text-white text-xs font-mono truncate block">{{ $settings->telegram_address ?: '@licytm' }}</strong>
                    <span class="text-[10px] text-emerald-400 flex items-center gap-1 font-semibold mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Active Dispatch
                    </span>
                </div>
            </div>

            <!-- Discord Status -->
            <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-700/80 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-brands fa-discord"></i>
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs text-slate-400 block font-semibold">Discord Channel</span>
                    <strong class="text-white text-xs font-mono truncate block">{{ $settings->discord_address ?: 'lucytm1' }}</strong>
                    <span class="text-[10px] text-emerald-400 flex items-center gap-1 font-semibold mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Active Dispatch
                    </span>
                </div>
            </div>

            <!-- Email Status -->
            <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-700/80 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="overflow-hidden">
                    <span class="text-xs text-slate-400 block font-semibold">Email Channel</span>
                    <strong class="text-white text-xs font-mono truncate block">{{ $settings->email_address ?: 'nitushar06@gmail.com' }}</strong>
                    <span class="text-[10px] text-emerald-400 flex items-center gap-1 font-semibold mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Active Dispatch
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Configuration Form -->
    <form action="{{ route('admin.order-taking.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- 1. Telegram Order Taking Option -->
        <div class="taking-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-sky-500/20 text-sky-400 flex items-center justify-center text-lg">
                        <i class="fa-brands fa-telegram"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white m-0">1. Telegram Order Channel</h2>
                        <span class="text-xs text-slate-400">Receive order alerts and customer details on Telegram</span>
                    </div>
                </div>

                <!-- Channel Enable Checkbox -->
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" 
                           name="is_telegram_enabled" 
                           value="1" 
                           {{ $settings->is_telegram_enabled ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-sky-600 focus:ring-sky-500 bg-slate-900 border-slate-700">
                    <span class="text-xs font-bold text-slate-300">Enabled</span>
                </label>
            </div>

            <!-- Primary Telegram Field -->
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                    Telegram Address / Username <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-sky-400 font-bold">
                        @
                    </span>
                    <input type="text" 
                           name="telegram_address" 
                           value="{{ old('telegram_address', $settings->telegram_address ?? '@licytm') }}"
                           required
                           placeholder="e.g. @licytm" 
                           class="taking-input pl-9 font-mono font-semibold">
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">Your Telegram handle where orders will be assigned and directed.</span>
            </div>

            <!-- Advanced Telegram Bot API Settings Toggle -->
            <div class="pt-2">
                <button type="button" 
                        @click="showTelegramAdvanced = !showTelegramAdvanced"
                        class="text-xs font-semibold text-sky-400 hover:text-sky-300 flex items-center gap-1.5 transition">
                    <i class="fa-solid" :class="showTelegramAdvanced ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
                    <span x-text="showTelegramAdvanced ? 'Hide Telegram Bot Push Settings' : 'Configure Telegram Bot Direct Push (Optional)'"></span>
                </button>

                <div x-show="showTelegramAdvanced" x-transition class="mt-3 p-4 rounded-xl bg-slate-900/80 border border-slate-700/80 space-y-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">
                                Telegram Bot Token
                            </label>
                            <input type="text" 
                                   name="telegram_bot_token" 
                                   value="{{ old('telegram_bot_token', $settings->telegram_bot_token) }}"
                                   placeholder="e.g. 123456789:ABCdefGhIJKlmNoPQRsTUVwxyZ" 
                                   class="taking-input text-xs font-mono">
                            <span class="text-[10px] text-slate-400 mt-0.5 block">Create for free via @BotFather on Telegram.</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">
                                Telegram Chat ID
                            </label>
                            <input type="text" 
                                   name="telegram_chat_id" 
                                   value="{{ old('telegram_chat_id', $settings->telegram_chat_id) }}"
                                   placeholder="e.g. 987654321 or @yourchannel" 
                                   class="taking-input text-xs font-mono">
                            <span class="text-[10px] text-slate-400 mt-0.5 block">Get your Chat ID via @userinfobot on Telegram.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Discord Order Taking Option -->
        <div class="taking-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-lg">
                        <i class="fa-brands fa-discord"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white m-0">2. Discord Order Channel</h2>
                        <span class="text-xs text-slate-400">Receive order alerts and line items on Discord</span>
                    </div>
                </div>

                <!-- Channel Enable Checkbox -->
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" 
                           name="is_discord_enabled" 
                           value="1" 
                           {{ $settings->is_discord_enabled ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500 bg-slate-900 border-slate-700">
                    <span class="text-xs font-bold text-slate-300">Enabled</span>
                </label>
            </div>

            <!-- Primary Discord Field -->
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                    Discord Address / Tag <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-indigo-400 font-bold">
                        <i class="fa-brands fa-discord"></i>
                    </span>
                    <input type="text" 
                           name="discord_address" 
                           value="{{ old('discord_address', $settings->discord_address ?? 'lucytm1') }}"
                           required
                           placeholder="e.g. lucytm1" 
                           class="taking-input pl-10 font-mono font-semibold">
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">Your Discord username/tag where orders will be tagged and notified.</span>
            </div>

            <!-- Discord Webhook URL for Instant Embeds -->
            <div class="pt-2">
                <button type="button" 
                        @click="showDiscordAdvanced = !showDiscordAdvanced"
                        class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 transition">
                    <i class="fa-solid" :class="showDiscordAdvanced ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
                    <span x-text="showDiscordAdvanced ? 'Hide Discord Webhook URL' : 'Configure Discord Webhook Embeds (Recommended)'"></span>
                </button>

                <div x-show="showDiscordAdvanced" x-transition class="mt-3 p-4 rounded-xl bg-slate-900/80 border border-slate-700/80 space-y-2">
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">
                        Discord Channel Webhook URL
                    </label>
                    <input type="url" 
                           name="discord_webhook_url" 
                           value="{{ old('discord_webhook_url', $settings->discord_webhook_url) }}"
                           placeholder="https://discord.com/api/webhooks/..." 
                           class="taking-input text-xs font-mono">
                    <span class="text-[10px] text-slate-400 mt-0.5 block">
                        Paste a Discord Webhook URL (from Channel Settings &gt; Integrations &gt; Webhooks) to receive rich card embeds with customer &amp; product summaries.
                    </span>
                </div>
            </div>
        </div>

        <!-- 3. Email Order Taking Option -->
        <div class="taking-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white m-0">3. Email Order Channel</h2>
                        <span class="text-xs text-slate-400">Receive formatted order invoices and buyer details via Email</span>
                    </div>
                </div>

                <!-- Channel Enable Checkbox -->
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" 
                           name="is_email_enabled" 
                           value="1" 
                           {{ $settings->is_email_enabled ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 bg-slate-900 border-slate-700">
                    <span class="text-xs font-bold text-slate-300">Enabled</span>
                </label>
            </div>

            <!-- Primary Email Field -->
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">
                    Order Taking Email Address <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-emerald-400">
                        <i class="fa-regular fa-envelope"></i>
                    </span>
                    <input type="email" 
                           name="email_address" 
                           value="{{ old('email_address', $settings->email_address ?? 'nitushar06@gmail.com') }}"
                           required
                           placeholder="e.g. nitushar06@gmail.com" 
                           class="taking-input pl-10 font-mono font-semibold">
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">
                    Every order placed on the website will be emailed to this address with full financial and itemized breakdowns.
                </span>
            </div>
        </div>

        <!-- Save Actions -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" 
                    class="px-8 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-lg shadow-emerald-600/30 transition flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save Order Taking Channels</span>
            </button>
        </div>

    </form>

</div>

@endsection
