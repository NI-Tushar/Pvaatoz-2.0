@php
    $configer = App\Models\Configer::latest()->first();
    $sidebarLogo = $configer?->logo 
        ? (str_starts_with($configer->logo, 'http') || str_starts_with($configer->logo, 'storage/') ? asset($configer->logo) : asset('storage/' . $configer->logo))
        : null;
@endphp
        <!-- <button class="mov-toggle-btn" id="toggleBtn">
          <i class="fas fa-bars"></i>
        </button> -->

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="logo flex items-center gap-2 overflow-hidden text-decoration-none">
          @if($sidebarLogo)
            <img src="{{ $sidebarLogo }}" alt="Logo" class="max-h-8 w-auto bg-white object-contain rounded" onerror="this.style.display='none'; document.getElementById('sidebar-default-icon').style.display='inline-block';">
            <i id="sidebar-default-icon" class="fas fa-layer-group text-emerald-400" style="display:none;"></i>
          @else
            <i class="fas fa-layer-group text-emerald-400"></i>
            <span class="logo-text truncate font-bold text-white">{{ $configer?->name ?? config('app.name', 'AccueVault') }}</span>
          @endif
        </a>
        <button class="toggle-btn" id="toggleBtn">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <nav class="sidebar-nav">
          <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="fas fa-chart-line"></i>
              <span class="nav-text">Dashboard</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-chart-pie"></i>
              <span class="nav-text">Analytics</span>
          </a>
          <a href="{{ route('admin.user.index') }}" class="nav-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
              <i class="fas fa-users"></i>
              <span class="nav-text">Users</span>
          </a>
          <a href="{{ route('admin.product.index') }}" class="nav-item {{ request()->routeIs('admin.product.index') ? 'active' : '' }}">
              <i class="fas fa-box"></i>
              <span class="nav-text">Products</span>
          </a>
          <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
              <i class="fas fa-shopping-cart"></i>
              <span class="nav-text">Orders</span>
              @php
                  $sidebarPendingOrders = \App\Models\Order::where('status', 'pending')->count();
              @endphp
              @if($sidebarPendingOrders > 0)
                  <span class="ms-auto bg-amber-500 text-slate-950 font-extrabold text-[10px] px-1.5 py-0.5 rounded-full">
                      {{ $sidebarPendingOrders }}
                  </span>
              @endif
          </a>
          <a href="{{ route('admin.order-taking.index') }}" class="nav-item {{ request()->routeIs('admin.order-taking.*') ? 'active' : '' }}">
              <i class="fa-solid fa-paper-plane"></i>
              <span class="nav-text">Order Taking</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-dollar-sign"></i>
              <span class="nav-text">Revenue</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-file-alt"></i>
              <span class="nav-text">Reports</span>
          </a>
          <a href="{{ route('admin.payment-methods.index') }}" class="nav-item {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
              <i class="fas fa-wallet"></i>
              <span class="nav-text">Payment Methods</span>
          </a>
          <a href="{{ route('admin.configer.index') }}" class="nav-item {{ request()->routeIs('admin.configer.index') ? 'active' : '' }}">
              <i class="fas fa-cog"></i>
              <span class="nav-text">Settings</span>
          </a>
      </nav>


      <div class="sidebar-footer">
        <div class="user-profile">
          <div class="avatar">
            <i class="fas fa-user"></i>
          </div>
          <div class="user-info">
            <p class="user-name">{{ auth()->guard('admin')->user()?->name ?? 'Admin' }}</p>
            <p class="user-role">{{ auth()->guard('admin')->user()?->role ?? 'Administrator' }}</p>
          </div>
        </div>
          <form action="{{ route('admin.logout') }}" method="POST" class="dropdown-item" style="width:100%;padding:0">
              @csrf
              <button class="logout-btn" type="submit">
                  <span><i class="fas fa-sign-out-alt"></i></span>
              </button>
          </form>
      </div>
    </aside>