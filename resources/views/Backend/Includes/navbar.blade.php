{{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-align-left"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a title="Webiste View" target="_blank" href="{{ route('home')}}" class="btn btn-md btn-outline-info rounded"><i class="fa-solid fa-earth-asia"></i></a>
      </li>
    </ul>

   <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="left: inherit; right: 0px;">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item">
            <i class="fa-regular fa-comment-dots">10</i>

            <span class="float-right text-muted text-sm">notificaiton</span>
            </a>
            <div class="dropdown-divider"></div>
        </div>
        </li>

      <!-- User -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> <span>Profile</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          @auth('admin')
          <form action="{{ route('admin.logout') }}" method="POST" class="dropdown-item">
              @csrf
              <button style="width:100%;background:none; border:none;display: flex;justify-content:space-between;align-items:center" type="submit">
                <span>Logout</span>
                <i class="fa-solid fa-right-from-bracket"></i>
              </button>
          </form>
          @endauth
        </div>
      </li>
    </ul>
  </nav> --}}




  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a target="_blank" href="{{ route('home')}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
      </li>
    </ul>

   <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- User -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img style="height: 30px;width:30px;object-fit:cover;border-radius:100%;border:1px solid #ddd" src="{{ asset(auth()->guard('admin')->user()->image ? auth()->guard('admin')->user()->image : 'avatar.png') }}" alt="Image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div style="display: flex;flex-direction:column;justify-content:center;align-items:center;gap:.5em;margin:20px 0">
            <img style="height: 100px;width:100px;object-fit:cover;border-radius:100%;border:1px solid #ddd" src="{{ asset(auth()->guard('admin')->user()->image ? auth()->guard('admin')->user()->image : 'avatar.png') }}" alt="Image">
            <h5>{{ auth()->guard('admin')->user()->name }}</h5>
          </div>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.profile.show') }}" class="dropdown-item" style="display: flex;justify-content:space-between;align-items:center;">
            <span>My Profile</span>
            <span><i class="fa-solid fa-angle-right"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.profile.edit') }}" class="dropdown-item" style="display: flex;justify-content:space-between;align-items:center;">
            <span>Edit Profile</span>
            <span><i class="fa-solid fa-angle-right"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            @push('css')
              <style>
                .logoutBtn:focus{
                  outline: none;
                  order: none;
                }
              </style>
            @endpush
            @auth('admin')
            <form action="{{ route('admin.logout') }}" method="POST" class="dropdown-item" style="width:100%;padding:0">
                @csrf
                <button
                  style="width:100%;
                  background:none; border:none;
                  text-align:left;margin-right:auto;
                  padding:0;display: flex;
                  justify-content:space-between;
                  align-items:center;"
                  type="submit">
                    <span>Logout</span>
                    <span><i class="fa-solid fa-angle-right"></i></span>
                </button>
            </form>
            @endauth
          </div>
        </div>
      </li>
    </ul>
  </nav>

