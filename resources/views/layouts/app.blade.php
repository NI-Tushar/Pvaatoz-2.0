
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pvaatoz | @yield('title', 'Default')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/small-logo.png">
    <link rel="manifest" href="site.webmanifest">
    <meta name="keywords" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('small-logo.png') }}">

    <!-- Style & Responsive style sheet -->
    <!-- <link rel="stylesheet" href="{{ asset('Frontend/assets/css/style.css') }}"> -->
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

    <!-- ________________ for theme -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/vendor/swiper/swiper-bundle.min.css') }}">
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('Frontend/theme/assets/css/style.css') }}">

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

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     
    <!-- for using tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
        <!-- Tailwind Configuration -->
       <!-- Custom CSS for Animations (Replacing Tailwind Config) -->
    <!-- Custom CSS for Animations (Replacing Tailwind Config) -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 7s ease-in-out 3s infinite;
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    @stack('css')
</head>

<body>
    <div class="main">
        <!-- Header -->
        <header id="header" class="fixed-top d-flex align-items-center header-transparent">
            <div class="container-fluid">

            <div class="row justify-content-center align-items-center">
                <div class="col-xl-11 d-flex align-items-center justify-content-start">
                    <h1 class="logo"><a href="{{ route('home') }}"><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-green-400 to-teal-400">PVA</span>AtoZ</a></h1>
                    <div class="flex items-center justify-end md:justify-center w-full">
                        <!-- Uncomment below if you prefer to use an image logo -->
                        <!-- <a href="index.html" class="logo"><img src="Frontend/theme/assets/img/logo.png" alt="" class="img-fluid"></a> -->

                        <nav id="navbar" class="navbar">
                            <ul>
                                <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                                <li><a class="nav-link" href="#">Gmail</a></li>
                                <li><a class="nav-link" href="#">Linkedin</a></li>
                                <li><a class="nav-link" href="#">Twitter</a></li>
                                <li><a class="nav-link" href="#">Snapchat</a></li>
                                <li><a class="nav-link" href="#">Wise</a></li>

                                <!-- Other's Social Dropdown -->
                                <li class="dropdown">
                                    <a href="#">
                                        <span>Other's Social</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </a>

                                    <ul class="d-flex rounded" style="background-color: rgba(23, 23, 23, 0.51); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                                        <div>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Edu Mail</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Tinder</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Quora</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">GitHub</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Facebook</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Facebook BM Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Outlook</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Google Voice</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Discord</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Review Mail</a></li>
                                        </div>
                                        <div>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Twitch Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Taboola Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Apple Developer</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Nextdoor Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Bereal Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Crunchyroll Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Airchat Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Supernova Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Trustpilot Reviews</a></li>
                                        </div>
                                    </ul>
                                </li>

                                <!-- More Dropdown -->
                                <li class="dropdown">
                                    <a href="#">
                                        <span>More</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </a>

                                    <ul class="d-flex rounded" style="background-color: rgba(23, 23, 23, 0.51); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                                        <div>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Ticketmaster</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Medium Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Naver Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Binance Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">PayPal Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Payoneer Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Relay Business Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Stake Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">eBay Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Paxful Account</a></li>
                                        </div>
                                        <div>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Airbnb Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">AliExpress Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Google Ads Grants</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Google Play Console</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">YouTube Monetized Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">TikTok Ads Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">Shopify Aged Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">AliPay Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">WeChat Account</a></li>
                                            <li><a href="#" class="text-white hover:!text-[#00b931fe]">WeChat Pay Enabled Account</a></li>
                                        </div>
                                    </ul>
                                </li>

                                <li>
                                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                                </li>

                                <li>
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>

                            </ul>

                            <i class="bi bi-list mobile-nav-toggle"></i>
                        </nav><!-- .navbar -->
                    </div>
                </div>
            </div>

            </div>
        </header>
        <!-- End Header -->
       

        <div class="" style="min-height: 90vh">
            <!-- App Content -->
            @yield('app-content')
            <!-- App Content end-->
        </div>

        <!-- Footer -->
        <footer id="footer">
            <div class="footer-top">
            <div class="container">
                <div class="row">

                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>BizPage</h3>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contact Us</h4>
                    <p>
                    A108 Adam Street <br>
                    New York, NY 535022<br>
                    United States <br>
                    <strong>Phone:</strong> +1 5589 55488 55<br>
                    <strong>Email:</strong> info@example.com<br>
                    </p>

                    <div class="social-links">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
                    <form action="" method="post">
                    <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>

                </div>
            </div>
            </div>

            <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>BizPage</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
            -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
            </div>
        </footer>
        <!-- Footr End -->

    </div>
</body>



    <!-- Vendor JS Files -->
    <script src="{{ asset('Frontend/theme/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('Frontend/theme/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('Frontend/theme/assets/js/main.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
        // Get the current URL, removing any fragment
        var documentUrl = document.location.href.replace(/#.*$/, '')

        // Iterate through all links
        var linkEls = document.getElementsByTagName('A')
            for (var linkIndex = 0; linkIndex < linkEls.length; linkIndex++) {
                var linkEl = linkEls[linkIndex]

                // Ignore links that don't begin with #
                if (!linkEl.getAttribute('href').match(/^#/)) {
                continue;
                }

                // Convert to an absolute URL
                linkEl.setAttribute('href', documentUrl + linkEl.getAttribute('href'))
            }
        })    
    </script>



</html>
