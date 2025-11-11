@php
    $configer = App\Models\Configer::latest()->first();
@endphp
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ $configer->name }} | @yield('title', 'Default')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/small-logo.png">
    <link rel="manifest" href="site.webmanifest">
    <meta name="keywords" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('small-logo.png') }}">

    <!-- Style & Responsive style sheet -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/header_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/translator.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/responsive.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- _______________ FOR BANGLA Font-->
    <link href="https://cdn.msar.me/fonts/mukti/font.css" rel="stylesheet">

    <!-- Flipbook StyleSheet -->
    <link href="{{ url('front/dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;500;700&family=Open+Sans:wght@300;400;500;700&family=Poppins:wght@200;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9f57283aa3.js" crossorigin="anonymous"></script>

    <!-- updated font list start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&family=Parkinsans:wght@300..800&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- updated font list end -->

        <!-- ________________ FOR BANGLA FONT STYLE START -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla&display=swap" rel="stylesheet">

    <style>
        body{
             font-family: 'Anek Bangla', sans-serif !important;
             /* font-family: 'Hind Siliguri', sans-serif; */
             /* font-family: 'Tiro Bangla', serif !important; */
        }
        h1,h2,h3,h4,h5,h6,p,span,a,label,strong{
            font-family: 'Anek Bangla', sans-serif !important;
            /* font-family: 'Hind Siliguri', sans-serif; */
            /* font-family: 'Tiro Bangla', serif !important; */
        }
    </style>
    <!-- ________________ FOR BANGLA FONT STYLE START -->
     
    <!-- for using tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')
</head>

<body>
    <div class="main">
        <!-- Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Preloader End -->

        <!-- Header -->
        <header id="fixtNavbar">

            <!-- Top Header -->
            <div class="top-header">
                <div class="top-container">
                    <div class="top-header-content">
                        <div class="left">
                            <span><i class="fa-solid fa-phone"></i></span>
                            @php
                                if (!function_exists('formatPhone')) {
                                    function formatPhone($phone)
                                    {
                                        // Assuming a 10-digit phone number (e.g., 1234567890)
                                        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1$2-$3', $phone);
                                    }
                                }
                            @endphp
                            <a href="tel:{{ $configer->phone }}">{{ formatPhone($configer->phone) }}</a>
                            <a class="mail" href="mailto:{{ Route::is('order.index') ? 'course@promaxbpo.com' : $configer->email }}">
                                <i class="fa-solid fa-envelope"></i>
                                {{ $configer->email }}
                            </a>
                        </div>
                        <div class="right">

                        <!-- translator button start -->
                          <div class="translate">
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


                            @if (auth('web')->check())
                                @if(auth()->guard('web')->user()->is_pro_user == 'pro')
                                    <a class="pro_tag_phone"><i class="fa-solid fa-crown"></i> Pro-Consultant</a>
                                @endif
                            @endif

                            @if (auth('web')->check())
                                <a class="user_name" href="{{ route('profile.edit') }}">{{ Auth::user()->name ?? 'User Name' }}
                                    @if (auth('web')->check())
                                        @if(auth()->guard('web')->user()->is_pro_user == 'pro')
                                            <br>
                                            <span class="pro_tag"><i class="fa-solid fa-crown"></i> Pro-Consultant</span>
                                        @endif
                                    @endif
                                </a>
                                <a href="{{ route('profile.edit') }}" class="pro_img">
                                    <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('no-profile-img.png') }}" alt="">
                                </a>
                            @endif
                        </div>
                        <style>
                            .user_name{
                                display:block !important;
                                margin:0 !important;
                                padding:0 !important;
                            }
                            .pro_tag_phone,
                            .pro_tag{
                                font-size:12px;
                                font-weight:500;
                                color:rgb(255, 140, 0) !important;
                            }
                            @media screen and (min-width: 550px) {
                                .pro_tag_phone{
                                    display:none;
                                }
                            }
                        </style>
                    </div>
                </div>
            </div>
            <!-- Top Header End -->

            <!-- _________________________ HEADER BAR START -->
            <div class="header_bar">
                <div class="nav_menu_bar">
                    <div class="logo_section">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="">
                        </a>
                    </div>
                    <header>
                        <div class="header_bar_container">
                            <input type="checkbox" name="check" id="check">

                            <div class="nav-buttons">
                                <div class="navbar-links">
                                    <ul>

                                        <!-- _______________________ -->
                                        <li class="nav-link" style="--i: 0.05s">
                                            <a href="{{ route('ediwise.consultants') }}"
                                                class="{{ Route::is('ediwise.consultants') ? 'active-nav' : '' }}">
                                                {{ __('message.Consultants') }}
                                                <span class="mov_menu_icon">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <!-- _______________________ -->
                                        <li class="nav-link" style="--i: .25s">
                                            <a href="{{ route('order.index') }}"
                                                class="{{ Route::is('order.index') || Route::is('order.place') ? 'active-nav' : '' }}">
                                                {{ __('message.Courses') }}
                                                <span class="mov_menu_icon">
                                                    <i class="fa-solid fa-book"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <!-- _______________________ -->
                                        <!-- <li class="nav-link" style="--i: .45s">
                                            <a href=""
                                                class="{{ Route::is('order.index') ? 'active-nav' : '' }}">
                                                <i class="fa-solid fa-user-graduate"></i>
                                                Scholarships
                                            </a>
                                        </li> -->

                                        <!-- _______________________ -->
                                        <li class="nav-link" style="--i: 0.45s">
                                            <a href="{{ route('about') }}"
                                                class="{{ Route::is('about') ? 'active-nav' : '' }}">
                                                {{ __('message.About') }}
                                                <span class="mov_menu_icon">
                                                    <i class="fa-solid fa-users"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <!-- _______________________ -->
                                        <li class="nav-link" style="--i: 0.65s">
                                            <a href="{{ route('contact') }}"
                                                class="{{ Route::is('contact') ? 'active-nav' : '' }}">
                                                {{ __('message.Contact') }}
                                                <span class="mov_menu_icon">
                                                    <i class="fa-solid fa-headset"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <!-- _______________________ -->
                                        <li class="nav-link" style="--i: .85s">
                                            <a href="{{ route('register.consultant') }}"
                                                class="{{ Route::is('register.consultant') ? 'active-nav' : '' }}">
                                                {{ __('message.Become a Consultant') }}
                                                <span class="mov_menu_icon">
                                                    <i class="fa-solid fa-id-badge"></i>
                                                </span>
                                            </a>
                                        </li>

                                         <!-- _______________________ -->
                                        <li class="nav-link pro_bg" style="--i: 0.95s">
                                            <a class="pro" href="{{ route('pro.consultant') }}"
                                                class="{{ Route::is('pro.consultant') ? 'active-nav' : '' }}">
                                                <i class="fa-regular fa-chess-queen"></i>
                                                {{ __('message.pro_consultant') }}
                                                <span class="mov_menu_icon">
                                                    <i class="fa-regular fa-chess-queen"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <!-- _________________________ HEADER BAR START -->

                                        @if (auth('web')->check())
                                            <li class="nav-link header-active-btn" style="--i: 1.25s">
                                                <a href="{{ route('dashboard') }}"> {{ __('message.Dashboard') }}</a>
                                            </li>
                                        @else
                                            <li class="nav-link header-active-btn" style="--i: 1.25s">
                                                <a href="{{ route('login') }}">{{ __('message.sign_in') }}</a>
                                            </li>
                                        @endif


                                        <!-- _______________________ -->
                                        <!-- <li class="nav-link" style="--i: .85s">
                                            <a href="#">About Us<i class="fas fa-caret-down"></i></a>
                                            <div class="dropdown">
                                                <div class="item_img">
                                                    <img src="{{ url('resource/images/bg/logo.png') }}" alt="">
                                                </div>
                                                <h3>About EDCL & Executives</h3>
                                                    <ul>
                                                        <li class="dropdown-link">
                                                            <a href="{{ url('/company_profile') }}">Company Profile</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="{{ url('/management_team') }}">Executive Management</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="{{ url('/board_of_director') }}">Board of Directors</a>
                                                        </li>
                                                    </ul>
                                                    <ul>
                                                        <li class="dropdown-link">
                                                            <a href="{{ url('/about_ceo') }}">About CEO</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="{{ url('/ceo_message') }}">CEO Message</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="" target="_blank">CEO Profile</a>
                                                        </li>

                                                    </ul>

                                                <div class="arrow"></div>

                                            </div>
                                        </li> -->



                                    </ul>
                                </div>
                            </div>

                            <div class="hamburger-menu-container">
                                <div class="hamburger-menu">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </header>
                </div>
            </div>
            <!-- _________________________ HEADER BAR END -->

        </header>
        <!-- Header End -->
        @if (Session::has('success'))
            <div id="successModal"
                style="position: fixed;top:20%;right:2%;background:#ffffff;color:green;z-index:999;padding:20px;font-size:20px;border-radius:5px;box-shadow: inset 0 -3em 3em rgb(0 200 0 / 30%),0 0 0 2px white,0.3em 0.3em 1em rgb(200 0 0 / 60%);">
                <div style="display:flex;justify-content:space-between;gap:2em">
                    <span>{{ Session()->get('success') }}</span>
                    <span style="cursor: pointer" onclick="closeModal()"><i
                            class="fa-solid fa-circle-xmark"></i></span>
                </div>
            </div>
        @endif

        <div style="min-height: 90vh">
            <!-- App Content -->
            @yield('app-content')
            <!-- App Content end-->
        </div>

        <!-- Footer -->
        <footer>
            <section class="footer">
                <div class="container">
                    <div class="footer-content">
                        <div class="row">
                            <div class="col">
                                @if ($configer->logo)
                                    <a href="{{ route('home') }}" class="footer_logo">
                                        <img style="background-color:transparent !important;" src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="" class="bg-primary">
                                    </a>
                                @else
                                    <a href="{{ route('home') }}" class="footer_logo">
                                        <img style="background-color:transparent !important;" src="{{ asset('Frontend/assets/img/logo/logo-red.png') }}" alt="">
                                    </a>
                                @endif
                                <p>{{ $configer->companydetail }}</p>
                                <!-- <div class="social-icon">
                                    <a href="{{ $configer->facebook }}" target="_blank"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                    <a href="{{ $configer->twitter }}" target="_blank"><i
                                            class="fa-brands fa-twitter"></i></a>
                                    <a href="{{ $configer->youtube }}" target="_blank"><i
                                            class="fa-brands fa-youtube"></i></a>
                                    <a href="{{ $configer->instagram }}" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></i></i></a>
                                </div> -->
                            </div>
                            <div class="col">
                                <h3>Quick Menu</h3>
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('register.consultant') }}">Become a Consultant</a></li>
                                    <li><a href="{{ route('order.index') }}">Courses</a></li>
                                    <li><a href="{{ route('ediwise.consultants') }}">Consultants</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('contact') }}">Contact us</a></li>
                                    {{-- <li><a href="">Our Story</a></li> --}}
                                    {{-- <li><a href="">What we do</a></li> --}}
                                    {{-- <li><a href="">Research & Programes</a></li> --}}
                                    {{-- <li><a href="">Out Team</a></li> --}}
                                    {{-- <li><a href="">Governing Board</a></li> --}}

                                </ul>
                            </div>
                            <div class="col">
                                <h3>Important Links</h3>
                                <ul>
                                    <li><a href="{{route('terms.condition')}}">Terms & Conditions</a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <h3>Company Details</h3>
                                <ul>
                                    @php
                                        if (!function_exists('formatPhone')) {
                                            function formatPhone($phone)
                                            {
                                                // Assuming a 10-digit phone number (e.g., 1234567890)
                                                return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1$2-$3', $phone);
                                            }
                                        }
                                    @endphp
                                    <li class="footer-address"><i class="fa-solid fa-phone"></i><a
                                            href="tel:{{ $configer->phone }}">
                                            {{ formatPhone($configer->phone) }}</a></li>
                                    <li class="footer-address"><i class="fa-solid fa-envelope"></i><a
                                            href="mailto:{{ $configer->email }}"> {{ $configer->email }}</a></li>
                                    <li class="footer-address"><i class="fa-solid fa-envelope"></i><a
                                            href="mailto:{{ 'contact@eduwise.com.bd' }}">
                                            {{ 'contact@eduwise.com.bd' }}</a></li>
                                    <li class="footer-address"><i class="fa-solid fa-location-dot"></i>
                                        <a>{{ $configer->address }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-end">
                    <span>
                        <i class="fa-sharp fa-regular fa-copyright"></i>
                        copyright <?php echo date('Y'); ?> EduWise, All rights reserved
                    </span>
                </div>
            </section>
        </footer>
        <!-- Footr End -->

        <!-- Screen Socail Icon Group -->
        <div class="screen-social-icon-group">
            <a href="{{ $configer->facebook }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="{{ $configer->twitter }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            <a href="{{ $configer->youtube }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
            <a href="{{ $configer->instagram }}" target="_blank"><i class="fa-brands fa-instagram"></i></i></i></a>
        </div>
        <!-- Screen Socail Icon Group End -->

        <!-- Scroll to Top Button -->
        <button id="scrollTopBtn" onclick="scrollToTop()"><i class="fa-solid fa-turn-up"></i></button>

        <!-- Requst Form -->
        <div class="request-form" id="request-form">
            <div class="request-form-header">
                <h3>Quick Contact Us</h3>
                <i onclick="closerRequestForm()" class="fa-solid fa-xmark"></i>
            </div>
            <div class="request-form-body">
                <form action="{{ route('contactUs') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" required>
                    </div>
                    @error('name')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <label for="name">Phone</label>
                        <input type="number" name="phone" id="phone" placeholder="Enter your phone" required>
                    </div>
                    @error('phone')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <label for="name">Email</label>
                        <input type="email" name="email" id="emial" placeholder="Enter your email" required>
                    </div>
                    @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <label for="name">City</label>
                        <input type="text" name="city" id="emial" placeholder="Enter your city">
                    </div>
                    @error('city')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <label for="name">Subject</label>
                        <input type="text" name="subject" id="emial" placeholder="Enter your subject">
                    </div>
                    @error('subject')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <label for="name">Message</label>
                        <textarea name="message" id="message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    @error('message')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Requst Form End -->

        <!-- Video Modal -->
        <div class="video-modal" id="video-modal">
            <div class="video-modal-close-btn">
                <i onclick="closeVideoModal()" class="fa-solid fa-xmark"></i>
            </div>
            <div class="video-modal-video">
                <iframe width="100%" height="100%" src="{{ $configer->video }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <!-- video Modal End -->

    </div>
    <!-- JS here -->
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('Frontend') }}/./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Script Js -->
    <script src="{{ asset('Frontend') }}/./assets/js/script.js"></script>

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
    @stack('script')
</body>

</html>
