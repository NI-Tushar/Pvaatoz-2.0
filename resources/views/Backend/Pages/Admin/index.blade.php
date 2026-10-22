@extends('Backend.Layouts.master')
@section('title', 'Users & Staff Management')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .user-card {
        background-color: #1e293b;
        border: 1px solid rgba(51, 65, 85, 0.8);
        border-radius: 1.25rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    .user-table th {
        background-color: #0f172a;
        color: #94a3b8;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #334155;
    }
    .user-table td {
        padding: 0.95rem 1rem;
        border-bottom: 1px solid rgba(51, 65, 85, 0.5);
        color: #f8fafc;
        font-size: 0.875rem;
    }
    .user-table tr:hover td {
        background-color: rgba(30, 41, 59, 0.7);
    }
</style>
@endpush

@section('master-content')

<div class="p-4 sm:p-6 md:p-8 max-w-7xl mx-auto space-y-6"
     x-data="{
        activeTab: '{{ $tab }}',
        copyText(text, msg = 'Copied to clipboard!') {
            if (!text) return;
            navigator.clipboard.writeText(text);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 2000
            });
        }
     }">

    <!-- Flash Notifications -->
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

    @if(session('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
             class="p-4 rounded-xl {{ session('type') === 'danger' ? 'bg-rose-500/15 border-rose-500/30 text-rose-300' : 'bg-emerald-500/15 border-emerald-500/30 text-emerald-300' }} border text-xs sm:text-sm font-semibold flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid {{ session('type') === 'danger' ? 'fa-circle-xmark text-rose-400' : 'fa-circle-check text-emerald-400' }} text-base"></i>
                <span>{{ session('message') }}</span>
            </div>
            <button @click="show = false" class="hover:opacity-75"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
             class="p-4 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs sm:text-sm font-semibold flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-xmark text-rose-400 text-base"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button @click="show = false" class="text-rose-400 hover:text-rose-200"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- Top Header Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 border border-slate-700/80 rounded-2xl p-6 shadow-xl">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-2xl border border-indigo-500/30">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white tracking-tight m-0">Users & Staff Management</h1>
                    <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Manage customer user accounts, store buyers, and administrative staff members.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 self-start md:self-center">
            @if(Auth::guard('admin')->check() && strtolower(Auth::guard('admin')->user()->role ?? '') === 'admin')
                <a href="{{ route('admin.user.create') }}" 
                   class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-lg shadow-emerald-600/30 transition flex items-center gap-2">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Add New User</span>
                </a>
            @endif
        </div>
    </div>

    <!-- KPI Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Customers -->
        <div class="user-card p-5">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Customers</span>
                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-sm border border-indigo-500/20">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-white mt-2 font-mono">{{ number_format($totalCustomers) }}</div>
            <span class="text-[11px] text-slate-400 mt-1 block">Registered site buyers</span>
        </div>

        <!-- Verified Customers -->
        <div class="user-card p-5">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Verified Accounts</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-sm border border-emerald-500/20">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-emerald-400 mt-2 font-mono">{{ number_format($verifiedCustomers) }}</div>
            <span class="text-[11px] text-emerald-400/80 mt-1 block">Confirmed email accounts</span>
        </div>

        <!-- Staff / Admins -->
        <div class="user-card p-5">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Staff / Admins</span>
                <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center text-sm border border-purple-500/20">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-white mt-2 font-mono">{{ number_format($totalAdmins) }}</div>
            <span class="text-[11px] text-purple-400/80 mt-1 block">Admins, Editors, Mods</span>
        </div>

        <!-- New This Month -->
        <div class="user-card p-5">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">New This Month</span>
                <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center text-sm border border-amber-500/20">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="text-2xl font-extrabold text-amber-400 mt-2 font-mono">{{ number_format($newThisMonth) }}</div>
            <span class="text-[11px] text-amber-400/80 mt-1 block">Joined in {{ now()->format('M Y') }}</span>
        </div>
    </div>

    <!-- Navigation Tabs & Search Toolbar -->
    <div class="user-card p-4 sm:p-5">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Category Tabs -->
            <div class="flex items-center gap-2 p-1.5 bg-slate-900/90 border border-slate-700/80 rounded-xl overflow-x-auto">
                <a href="{{ route('admin.user.index', array_merge(request()->except('tab', 'customers_page'), ['tab' => 'customers'])) }}"
                   class="px-4 py-2 rounded-lg text-xs font-bold transition flex items-center gap-2 shrink-0 {{ $tab === 'customers' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/30' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                    <i class="fa-solid fa-user-group text-xs"></i>
                    <span>Customers</span>
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full font-mono {{ $tab === 'customers' ? 'bg-emerald-800 text-white' : 'bg-slate-800 text-slate-400' }}">
                        {{ $customers->total() }}
                    </span>
                </a>

                <a href="{{ route('admin.user.index', array_merge(request()->except('tab', 'customers_page'), ['tab' => 'admins'])) }}"
                   class="px-4 py-2 rounded-lg text-xs font-bold transition flex items-center gap-2 shrink-0 {{ $tab === 'admins' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                    <i class="fa-solid fa-shield-halved text-xs"></i>
                    <span>Administrators & Staff</span>
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full font-mono {{ $tab === 'admins' ? 'bg-indigo-800 text-white' : 'bg-slate-800 text-slate-400' }}">
                        {{ count($admins) }}
                    </span>
                </a>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('admin.user.index') }}" class="flex items-center gap-2 w-full md:w-auto">
                <input type="hidden" name="tab" value="{{ $tab }}">
                
                <div class="relative w-full md:w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by name, email, or phone..." 
                           class="w-full pl-10 pr-9 py-2 bg-slate-900 border border-slate-700 rounded-xl text-slate-100 placeholder-slate-500 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition">
                    @if(request('search'))
                        <a href="{{ route('admin.user.index', ['tab' => $tab]) }}" 
                           class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300">
                            <i class="fa-solid fa-circle-xmark text-xs"></i>
                        </a>
                    @endif
                </div>

                <button type="submit" 
                        class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold border border-slate-700 transition shrink-0">
                    Search
                </button>
            </form>

        </div>
    </div>

    <!-- TAB 1: CUSTOMERS TABLE -->
    @if($tab === 'customers')
        <div class="user-card overflow-hidden">
            <div class="px-6 py-4 bg-slate-900/80 border-b border-slate-700 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white m-0 flex items-center gap-2">
                        <i class="fa-solid fa-user-check text-emerald-400"></i>
                        <span>Customer Directory</span>
                    </h3>
                    <span class="text-xs text-slate-400">
                        Showing {{ $customers->firstItem() ?? 0 }} to {{ $customers->lastItem() ?? 0 }} of {{ $customers->total() }} registered customers
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full user-table text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="w-16">Sl</th>
                            <th>Customer Profile</th>
                            <th>Contact Phone</th>
                            <th>Account Status</th>
                            <th>Total Orders</th>
                            <th>Joined Date</th>
                            @if(Auth::guard('admin')->check() && strtolower(Auth::guard('admin')->user()->role ?? '') === 'admin')
                                <th class="text-right w-28">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            @php
                                $cAvatar = $customer->image 
                                    ? (str_starts_with($customer->image, 'http') || str_starts_with($customer->image, 'storage/') ? asset($customer->image) : asset('storage/' . $customer->image))
                                    : null;
                                $cInitials = strtoupper(substr($customer->name, 0, 2));
                            @endphp
                            <tr>
                                <!-- Sl -->
                                <td class="font-mono text-xs text-slate-400">
                                    #{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}
                                </td>

                                <!-- Customer Profile -->
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($cAvatar)
                                            <img src="{{ $cAvatar }}" 
                                                 alt="{{ $customer->name }}" 
                                                 class="w-10 h-10 rounded-full object-cover border border-slate-600 bg-slate-900 shrink-0"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-bold text-xs items-center justify-center shrink-0" style="display:none;">
                                                {{ $cInitials }}
                                            </div>
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex font-bold text-xs items-center justify-center shrink-0">
                                                {{ $cInitials ?: 'CU' }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-white text-sm flex items-center gap-1.5">
                                                <span>{{ $customer->name }}</span>
                                                <span class="text-[10px] font-mono px-1.5 py-0.2 rounded bg-slate-800 text-slate-400 border border-slate-700">
                                                    ID: {{ $customer->id }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-emerald-400 flex items-center gap-1.5 mt-0.5">
                                                <i class="fa-regular fa-envelope text-[11px] text-slate-500"></i>
                                                <a href="mailto:{{ $customer->email }}" class="hover:underline font-mono">
                                                    {{ $customer->email }}
                                                </a>
                                                <button type="button" @click="copyText('{{ $customer->email }}', 'Email copied!')" class="text-slate-500 hover:text-slate-300">
                                                    <i class="fa-regular fa-copy text-[10px]"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Phone -->
                                <td>
                                    @if($customer->phone)
                                        <div class="text-xs text-slate-300 font-mono flex items-center gap-1.5">
                                            <i class="fa-solid fa-phone text-[10px] text-slate-500"></i>
                                            <a href="tel:{{ $customer->phone }}" class="hover:text-emerald-400 transition">
                                                {{ $customer->phone }}
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-500 italic">Not provided</span>
                                    @endif
                                </td>

                                <!-- Account Status (Verified Toggle) -->
                                <td>
                                    <form method="POST" action="{{ route('admin.user.toggleVerify', $customer->id) }}" class="inline-block m-0">
                                        @csrf
                                        <button type="submit" 
                                                title="Click to toggle account verification status"
                                                class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition flex items-center gap-1.5 cursor-pointer {{ $customer->is_verified === 'Verified' ? 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40 hover:bg-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border-amber-500/40 hover:bg-amber-500/30' }}">
                                            <i class="fa-solid {{ $customer->is_verified === 'Verified' ? 'fa-circle-check text-emerald-400' : 'fa-clock text-amber-400' }} text-[10px]"></i>
                                            <span>{{ $customer->is_verified === 'Verified' ? 'Verified' : 'Pending' }}</span>
                                        </button>
                                    </form>
                                </td>

                                <!-- Total Orders -->
                                <td>
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-xs font-bold font-mono px-2 py-0.5 rounded-lg {{ $customer->orders_count > 0 ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                            {{ $customer->orders_count }} {{ Str::plural('order', $customer->orders_count) }}
                                        </span>
                                        @if($customer->orders_count > 0)
                                            <a href="{{ route('admin.orders.index', ['search' => $customer->email]) }}" 
                                               class="text-xs text-slate-400 hover:text-emerald-400 transition" 
                                               title="View customer orders">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>

                                <!-- Joined Date -->
                                <td>
                                    <span class="text-xs text-slate-300 block font-mono">
                                        {{ $customer->created_at ? $customer->created_at->format('M d, Y') : 'N/A' }}
                                    </span>
                                    <span class="text-[11px] text-slate-500 block">
                                        {{ $customer->created_at ? $customer->created_at->diffForHumans() : '' }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                @if(Auth::guard('admin')->check() && strtolower(Auth::guard('admin')->user()->role ?? '') === 'admin')
                                    <td class="text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <!-- Edit -->
                                            <a href="{{ route('admin.user.edit', ['user' => $customer->id, 'type' => 'customer']) }}" 
                                               class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 hover:bg-indigo-500/30 transition flex items-center justify-center text-xs"
                                               title="Edit Customer">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form method="POST" action="{{ route('admin.user.destroy', $customer->id) }}"
                                                  onsubmit="return confirm('Are you sure you want to permanently delete customer {{ addslashes($customer->name) }}?');"
                                                  class="m-0 inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="type" value="customer">
                                                <button type="submit" 
                                                        class="w-8 h-8 rounded-lg bg-rose-500/20 text-rose-400 hover:bg-rose-500/30 transition flex items-center justify-center text-xs"
                                                        title="Delete Customer">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-800 text-slate-500 flex items-center justify-center text-2xl mb-3">
                                            <i class="fa-solid fa-user-slash"></i>
                                        </div>
                                        <p class="font-bold text-white text-base m-0">No Customers Found</p>
                                        <p class="text-xs text-slate-500 mt-1 max-w-sm">
                                            @if(request('search'))
                                                No registered customer matches your search query "{{ request('search') }}".
                                            @else
                                                There are currently no registered customers in the database.
                                            @endif
                                        </p>
                                        @if(request('search'))
                                            <a href="{{ route('admin.user.index', ['tab' => 'customers']) }}" class="mt-3 px-4 py-2 rounded-xl bg-slate-800 text-slate-300 hover:text-white text-xs font-bold border border-slate-700">
                                                Clear Search
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($customers->hasPages())
                <div class="p-4 border-t border-slate-700/80 bg-slate-900/60">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    @endif

    <!-- TAB 2: ADMINISTRATORS & STAFF TABLE -->
    @if($tab === 'admins')
        <div class="user-card overflow-hidden">
            <div class="px-6 py-4 bg-slate-900/80 border-b border-slate-700 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white m-0 flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-indigo-400"></i>
                        <span>Staff & Administrative Personnel</span>
                    </h3>
                    <span class="text-xs text-slate-400">
                        Employees and privileged accounts with dashboard access permissions
                    </span>
                </div>

                @if(Auth::guard('admin')->check() && strtolower(Auth::guard('admin')->user()->role ?? '') === 'admin')
                    <a href="{{ route('admin.user.create') }}" class="px-3.5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold transition flex items-center gap-1.5">
                        <i class="fa-solid fa-plus text-[11px]"></i>
                        <span>Add Staff</span>
                    </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="w-full user-table text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="w-16">Sl</th>
                            <th>Staff Member</th>
                            <th>System Role</th>
                            <th>Contact Phone</th>
                            <th>Last Active / Login</th>
                            @if(Auth::guard('admin')->check() && strtolower(Auth::guard('admin')->user()->role ?? '') === 'admin')
                                <th class="text-right w-28">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            @php
                                $aAvatar = $admin->image 
                                    ? (str_starts_with($admin->image, 'http') || str_starts_with($admin->image, 'storage/') ? asset($admin->image) : asset('storage/' . $admin->image))
                                    : null;
                                $aInitials = strtoupper(substr($admin->name, 0, 2));
                                $isCurrentAdmin = Auth::guard('admin')->id() === $admin->id;
                            @endphp
                            <tr>
                                <!-- Sl -->
                                <td class="font-mono text-xs text-slate-400">
                                    #{{ $loop->iteration }}
                                </td>

                                <!-- Profile -->
                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($aAvatar)
                                            <img src="{{ $aAvatar }}" 
                                                 alt="{{ $admin->name }}" 
                                                 class="w-10 h-10 rounded-full object-cover border border-slate-600 bg-slate-900 shrink-0"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="w-10 h-10 rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 font-bold text-xs items-center justify-center shrink-0" style="display:none;">
                                                {{ $aInitials }}
                                            </div>
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 flex font-bold text-xs items-center justify-center shrink-0">
                                                {{ $aInitials ?: 'AD' }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-white text-sm flex items-center gap-1.5">
                                                <span>{{ $admin->name }}</span>
                                                @if($isCurrentAdmin)
                                                    <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                                        You
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-slate-400 flex items-center gap-1.5 mt-0.5">
                                                <i class="fa-regular fa-envelope text-[11px] text-slate-500"></i>
                                                <a href="mailto:{{ $admin->email }}" class="hover:text-indigo-400 transition font-mono">
                                                    {{ $admin->email }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Role -->
                                <td>
                                    @php
                                        $roleLower = strtolower($admin->role);
                                        $badgeClass = match($roleLower) {
                                            'admin' => 'bg-purple-500/20 text-purple-300 border-purple-500/40',
                                            'editor' => 'bg-blue-500/20 text-blue-300 border-blue-500/40',
                                            'moderator' => 'bg-amber-500/20 text-amber-300 border-amber-500/40',
                                            default => 'bg-slate-700/50 text-slate-300 border-slate-600',
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border inline-flex items-center gap-1.5 {{ $badgeClass }}">
                                        <i class="fa-solid fa-shield text-[10px]"></i>
                                        <span>{{ ucfirst($admin->role) }}</span>
                                    </span>
                                </td>

                                <!-- Phone -->
                                <td>
                                    @if($admin->phone)
                                        <span class="text-xs text-slate-300 font-mono">{{ $admin->phone }}</span>
                                    @else
                                        <span class="text-xs text-slate-500 italic">Not set</span>
                                    @endif
                                </td>

                                <!-- Last Login -->
                                <td>
                                    @if($admin->last_login_at)
                                        <span class="text-xs text-slate-300 block font-mono">
                                            {{ \Carbon\Carbon::parse($admin->last_login_at)->diffForHumans() }}
                                        </span>
                                        <span class="text-[11px] text-slate-500 block">
                                            {{ \Carbon\Carbon::parse($admin->last_login_at)->format('Y-m-d H:i') }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-500 italic">Never logged in</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                @if(Auth::guard('admin')->check() && strtolower(Auth::guard('admin')->user()->role ?? '') === 'admin')
                                    <td class="text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <!-- Edit -->
                                            <a href="{{ route('admin.user.edit', ['user' => $admin->id, 'type' => 'admin']) }}" 
                                               class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 hover:bg-indigo-500/30 transition flex items-center justify-center text-xs"
                                               title="Edit Staff Member">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <!-- Delete (prevent self-delete and primary root admin delete) -->
                                            @if(!$isCurrentAdmin && $admin->id !== \App\Models\Admin::first()?->id)
                                                <form method="POST" action="{{ route('admin.user.destroy', $admin->id) }}"
                                                      onsubmit="return confirm('Are you sure you want to remove staff member {{ addslashes($admin->name) }}?');"
                                                      class="m-0 inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="type" value="admin">
                                                    <button type="submit" 
                                                            class="w-8 h-8 rounded-lg bg-rose-500/20 text-rose-400 hover:bg-rose-500/30 transition flex items-center justify-center text-xs"
                                                            title="Delete Staff Member">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="w-8 h-8 rounded-lg bg-slate-800/60 text-slate-600 flex items-center justify-center text-xs cursor-not-allowed" title="Protected Account">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-14 h-14 rounded-2xl bg-slate-800 text-slate-500 flex items-center justify-center text-2xl mb-3">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </div>
                                        <p class="font-bold text-white text-base m-0">No Staff Members Found</p>
                                        <p class="text-xs text-slate-500 mt-1">There are no administrative staff records matching your filter.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@endsection
