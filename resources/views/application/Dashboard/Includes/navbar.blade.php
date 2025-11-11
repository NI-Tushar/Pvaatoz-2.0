@php
    // $configure = App\Models\Configer::latest()->first();
    $userType = auth()->guard('web')->user()->user_type;
@endphp

<link rel="stylesheet" href="{{ url('Frontend/dashboard/assets/css/user_navbar_custom.css') }}">
<link rel="stylesheet" href="{{ url('Frontend/assets/css/color.css') }}">
<link rel="stylesheet" href="{{ asset('Frontend/assets/css/color.css') }}">

<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                @if (auth()->guard('web')->user()->user_type === 'Consultant')
                <a href="{{ route('home') }}" class="logo-light" style="background-color:white;">
                    <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="logo" class="logo-lg" height="35">
                    <img src="{{ asset('small-logo-red.png') }}" alt="small logo" class="logo-sm h-[35px]" height="35">
                </a>
                @else
                <a href="{{ route('home') }}" class="logo-light" style="background-color:white;">
                    <img src="{{ asset('Frontend/assets/img/logo/logo-blue.png') }}" alt="logo" class="logo-lg h-[35px]" height="35">
                    <img src="{{ asset('small-logo.png') }}" alt="small logo" class="logo-sm h-[35px]" height="35">
                </a>
                @endif

                <!-- Brand Logo Dark -->
                @if (auth()->guard('web')->user()->user_type === 'Consultant')
                <a href="{{ route('home') }}" class="logo-dark" style="background-color:white;">
                    <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="dark logo" class="logo-lg" height="35">
                    <img src="{{ asset('small-logo-red.png') }}" alt="small logo" class="logo-sm h-[35px]" height="35">
                </a>
                @else
                <a href="{{ route('home') }}" class="logo-dark" style="background-color:white;">
                    <img src="{{ asset('Frontend/assets/img/logo/logo-blue.png') }}" alt="dark logo" class="logo-lg h-[35px]" height="35">
                    <img src="{{ asset('small-logo.png') }}" alt="small logo" class="logo-sm h-[35px]" height="35">
                </a>
                @endif
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>
        
        <div class="user_header">
            @if (auth()->guard('web')->user()->user_type === 'Consultant')
                <h4><i class="fa-solid fa-user-graduate"></i> {{ __('message.consultant_dashboard') }}</h4>
            @else
                <h4><i class="fa-solid fa-user-graduate"></i> {{ __('message.student_dashboard') }}</h4>
            @endif
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-4">

            {{-- <li class="d-none d-md-inline-block">
                <a class="nav-link" href="" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen font-size-24"></i>
                </a>
            </li> --}}

            {{-- <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell font-size-24"></i>
                    <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="px-1" style="max-height: 300px;" data-simplebar>

                        <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                        <!-- item-->

                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-size-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-size-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">New user registered</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <h5 class="text-muted font-size-13 fw-normal mt-0">Yesterday</h5>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('Frontend/dashboard') }}/assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-size-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <h5 class="text-muted font-size-13 fw-normal mt-0">30 Dec 2021</h5>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-size-14">Datacorp</h5>
                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                            <div class="card-body">
                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('Frontend/dashboard') }}/assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold font-size-14">Karen Robinson</h5>
                                        <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="text-center">
                            <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                        </div>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                        View All
                    </a>

                </div>
            </li> --}}

            {{-- Verification Badge (Pill Style) --}}
            <li>
                <!-- translator button start -->
                    <div class="translate user_dashbaord">
                        <input type="checkbox" id="language-toggle" onchange="window.location.href = 'language/' + (this.checked ? 'en' : 'bn')">
                        <label id="button" for="language-toggle">
                            <div id="knob"></div>
                            <div id="language-text"></div>
                        </label>
                    </div>
                    <!--  -->
                <!-- <select style="display:none !important;" class="language_section" onchange="window.location.href = 'language/' + this.value">
                    <option value="bn" @if(app()->getLocale() == 'bn') selected @endif>বাংলা</option>
                    <option value="en" @if(app()->getLocale() == 'en') selected @endif>English</option>
                </select> -->
                <!-- translator button end -->
            </li>
            <li class="varification_tag">
                <span class="badge rounded-pill d-flex align-items-center
                    @if(auth()->user()->is_verified === 'Verified') bg-success
                    @else bg-warning @endif"
                    style="padding: 0.35em 0.65em; font-size: 0.75em;">
                    @if(auth()->user()->is_verified === 'Verified')
                        <i class="fas fa-check-circle me-1"></i> Verified
                    @else
                        <i class="fas fa-exclamation-circle me-1"></i> Not Verified
                    @endif
                </span>
            </li>
            @if(auth()->guard('web')->user()->is_pro_user == 'pro')
            <li class="pro_tag">
                <span class="badge rounded-pill d-flex align-items-center
                    @if(auth()->user()->is_verified === 'Verified') bg-success
                    @else bg-warning @endif"
                    style="padding: 0.35em 0.65em; font-size: 0.75em;">
                        <i class="fa-solid fa-crown"></i> Pro-Consultant
                </span>
            </li>
            @endif
             <li class="varification_tag">
                <span class="badge rounded-pill d-flex align-items-center
                    @if(auth()->user()->is_verified === 'Verified') bg-success
                    @else bg-warning @endif"
                    style="padding: 0.35em 0.65em; font-size: 0.75em;">
                        <i class="fa-solid fa-bangladeshi-taka-sign"></i> {{auth()->user()->balance}}
                </span>
            </li>
            <style>
                .rounded-pill i{
                    margin-right:3px;
                }
                @media screen and (max-width: 425px) {
                    .varification_tag{
                        display:none;
                    }
                }
            </style>
            {{-- <li class="nav-link">
                <div class="d-f" style="gap: 2em">
                    <i class="fa-solid fa-bangladeshi-taka-sign"></i> {{ number_format(auth()->guard('web')->user()->balance, 2) }}
                </div>
            </li> --}}

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset(auth()->guard('web')->user()->image ?? 'no-profile-img.png') }}" alt="user-image" class="rounded-circle">
                    <div class="name_section">
                        <div>
                            <span class="ms-1 d-none d-md-inline-block">
                                {{ auth()->guard('web')->user()->name }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </div>
                        @if (auth('web')->check())
                            @if(auth()->guard('web')->user()->is_pro_user == 'pro')
                            <div class="pro">
                                <span class="ms-1 d-none d-md-inline-block">
                                    Pro-User <i class="fa-solid fa-crown"></i>
                                </span>
                            </div>
                            @endif
                        @endif
                    </div>
                </a>
                <style>
                    .name_section{
                        display: block !important;
                    }
                    .name_section .pro{
                        font-weight:600 !important;
                        color:rgb(255, 140, 0);
                        
                    }
                </style>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                    <!-- item-->
                    <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>{{ __('message.edit_profile') }}</span>
                    </a>

                    <!-- item-->
                    @if ($userType === 'Student')
                    <a href="{{ route('student.cashin') }}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>{{ __('message.balance') }}</span>
                    </a>
                    @elseif ($userType === 'Consultant')
                    <a href="{{ route('consultant.transaction.details') }}" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>{{ __('message.Transactions') }}</span>
                    </a>
                    @endif

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        @csrf
                        <button type="submit" class="log_out_confirm" style="background: transparent;border:transparent;outline:none;width:100%;text-align:left;padding:0;color:rgb(58, 58, 58)">
                            <span>{{ __('message.Logout') }}</span>
                        </button>
                    </form>

                </div>
            </li>

        </ul>
    </div>
</div>

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script>
        $('.log_out_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Are you sure you want to logout?`,
                text: "Don't worry, you can log in again using your user credentials.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willLogout) => {
                if (willLogout) {
                    form.submit();
                }
            });
        });


    </script>

    <!-- _____________ translator button start -->
    <script>

         document.addEventListener("DOMContentLoaded", function () {
             const languageToggle = document.getElementById('language-toggle');
        const languageText = document.getElementById('language-text');

        languageToggle.addEventListener('change', () => {
            const language = languageToggle.checked ? 'en' : 'bn';
            localStorage.setItem('preferredLanguage', language);
            languageText.textContent = language === 'en' ? 'EN' : 'BN';
            loadLanguage(language);
        });

        function loadLanguage(language) {
            const translation = translations[language];
            if (translation) {
                document.querySelectorAll('[data-key]').forEach(element => {
                    const key = element.getAttribute('data-key');
                    if (translation[key]) {
                        element.textContent = translation[key];
                    }
                });
            }
        }

        const preferredLanguage = localStorage.getItem('preferredLanguage') || 'bn';
            languageToggle.checked = (preferredLanguage === 'en');
            languageText.textContent = preferredLanguage === 'en' ? 'EN' : 'BN';
            loadLanguage(preferredLanguage);
        });

    </script>
    <!-- _____________ translator button end -->
@endpush
