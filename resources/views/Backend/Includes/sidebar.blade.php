@php
    $configer = App\Models\Configer::latest()->first();
@endphp
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <div class="logo">
          <i class="fas fa-layer-group"></i>
          <span class="logo-text">{{ $configer->name }}</span>
        </div>
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
          <a href="" class="nav-item">
              <i class="fas fa-users"></i>
              <span class="nav-text">Users</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-box"></i>
              <span class="nav-text">Products</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-shopping-cart"></i>
              <span class="nav-text">Orders</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-dollar-sign"></i>
              <span class="nav-text">Revenue</span>
          </a>
          <a href="" class="nav-item">
              <i class="fas fa-file-alt"></i>
              <span class="nav-text">Reports</span>
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
            <p class="user-name">{{auth()->guard('admin')->user()->name}}</p>
            <p class="user-role">{{auth()->guard('admin')->user()->role}}</p>
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