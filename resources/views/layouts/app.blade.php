
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> | @yield('title', 'Default')</title>
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


        <!-- Header -->

        <nav x-data="accordion(6)" class="fixed top-0 z-40 w-full bg-white shadow-md bg-white">
            
            <!-- Social Links Bar -->
            <div class="bg-gray-900 w-full">
                <div class="max-w-[1400px] w-full mx-auto text-white py-3 px-4">
                    <div class="mx-auto flex justify-between items-center">
                        <div class="text-sm">
                            <span>Follow us:</span>
                        </div>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-blue-400 transition-colors duration-300" aria-label="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="hover:text-blue-400 transition-colors duration-300" aria-label="Twitter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="hover:text-pink-400 transition-colors duration-300" aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                                </svg>
                            </a>
                            <a href="#" class="hover:text-red-400 transition-colors duration-300" aria-label="YouTube">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                            <a href="#" class="hover:text-blue-600 transition-colors duration-300" aria-label="LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- header bar -->
            <div class="max-w-[1400px] w-full mx-auto flex flex-wrap items-center justify-between px-4 py-5 relative">
                <!-- nav logo -->
                <div class="flex items-center">
                    <a href="#" class="text-3xl tracking-wide">
                        Navbar
                    </a>
                </div>
                <!-- End left nav -->

                <!-- Right nav -->

                <!-- Navigation Links -->
                <div x-data="{ open: false }" class="w-full lg:flex lg:items-center lg:w-auto">
                    <!-- Mobile Toggle Button -->
                    <div class="block text-gray-600 cursor-pointer lg:hidden w-[30px] absolute right-3 top-6">
                        <button @click="open = ! open" class="w-6 h-6 text-lg focus:outline-none">
                            <i x-show="! open" class="fas fa-bars text-xl transition-all duration-500"></i>
                            <i x-show="open" class="fas fa-times text-xl transition-all duration-500"></i>
                        </button>
                    </div>
                    
                    <!-- Navigation Menu -->
                    <div :class="open ? 'block' : 'hidden'" class="lg:block lg:flex lg:items-center lg:w-auto w-full">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-3">
                            <!-- Primary Links -->
                            <a href="#" class="block lg:inline-block px-4 py-2 text-lg text-gray-600 hover:text-gray-900 transition-colors">
                                Link
                            </a>
                            
                            <a href="#" class="block lg:inline-block px-4 py-2 text-lg text-gray-600 hover:text-gray-900 transition-colors">
                                Link
                            </a>
                            
                            <div 
                                x-data="{ dropdownOpen: false, dropdownLeft: false }" 
                                @mouseleave="dropdownOpen = false" 
                                class="relative lg:inline-block">
                                <!-- Dropdown Toggle Button -->
                                <button 
                                    @mouseover="dropdownOpen = true" 
                                    @click="dropdownOpen = !dropdownOpen" 
                                    @mousemove="
                                        // Calculate dropdown position dynamically
                                        const rect = $el.getBoundingClientRect();
                                        dropdownLeft = (window.innerWidth - rect.right) < 250; // adjust 250 based on dropdown width
                                    "
                                    class="reletive flex items-center p-2 text-lg text-gray-600 hover:text-gray-900 transition-colors lg:px-4 lg:py-2">
                                    <span>Hover Dropdown</span>
                                    <span :class="dropdownOpen ? '-rotate-180' : ''" class="ml-2 transition-transform duration-500 transform">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div 
                                    x-show="dropdownOpen" 
                                    x-transition:enter="transition ease-out duration-300" 
                                    x-transition:enter-start="opacity-0 transform scale-90" 
                                    x-transition:enter-end="opacity-100 transform scale-100" 
                                    x-transition:leave="transition ease-in duration-300" 
                                    x-transition:leave-start="opacity-100 transform scale-100" 
                                    x-transition:leave-end="opacity-0 transform scale-90"
                                    x-bind:class="dropdownLeft 
                                        ? 'left-1/2 -translate-x-1/2 lg:left-auto lg:right-0' 
                                        : 'left-1/2 -translate-x-1/2'"
                                    class="absolute z-50 py-2 mt-1 text-gray-500 bg-white rounded-lg shadow-xl border border-black 
                                        w-full md:min-w-[380px] w-auto grid grid-cols-2 gap-1 transform -translate-x-1/2 right-1/2"
                                    style="min-width: 380px;">
                                    
                                    <a href="#" class="flex items-center px-4 py-2 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Lorem, ipsum.
                                    </a>

                                    <a href="#" class="flex items-center px-4 py-2 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Lorem, ipsum dolor.
                                    </a>

                                    <a href="#" class="flex items-center px-4 py-2 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Lorem ipsum dolor sit amet.
                                    </a>
                                </div>
                            </div>
                                     
                            <a href="#" class="block lg:inline-block px-4 py-2 text-lg text-gray-600 hover:text-gray-900 transition-colors">
                                Link
                            </a>
                            

                            
                            <!-- Secondary Links (Mobile Only) -->
                            <div class="lg:hidden py-2 px-2 space-y-6">
                                <div class="flex gap-4 w-full">
                                    <a href="#" class="w-full text-base font-medium text-center text-gray-900 border shadow-sm hover:text-gray-700 py-2 rounded">
                                        About
                                    </a>
                                    <a href="#" class="w-full text-base font-medium text-center text-gray-900 border shadow-sm hover:text-gray-700 py-2 rounded">
                                        Contact
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Sign In/Up Buttons -->
                            <div class="lg:hidden mt-6 mb-4">
                                <a href="#" class="w-full flex items-center justify-center text-white px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium bg-gray-600 hover:bg-gray-700 transition-colors">
                                    Sign up
                                </a>
                                <p class="mt-6 text-center text-base font-medium text-gray-500">
                                    Existing customer?
                                    <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">
                                        Sign in
                                    </a>
                                </p>
                            </div>
                            
                            <!-- Desktop Sign In/Up -->
                            <div class="hidden lg:flex lg:items-center lg:ml-auto">
                                <a href="#" class="whitespace-nowrap inline-flex items-center justify-center px-4 py-1 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gray-600 hover:bg-gray-700 transition-colors">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </nav>

        <script>
            // Faq
            document.addEventListener('alpine:init', () => {
            Alpine.store('accordion', {
                tab: 0
            });
            Alpine.data('accordion', (idx) => ({
                init() {
                this.idx = idx;
                },
                idx: -1,
                handleClick() {
                this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
                },
                handleRotate() {
                return this.$store.accordion.tab === this.idx ? '-rotate-180' : '';
                },
                handleToggle() {
                return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
                }
            }));
            })
            //  end faq
        </script>
       

        <div class="mt-[10rem]" style="min-height: 90vh">
            <!-- App Content -->
            @yield('app-content')
            <!-- App Content end-->
        </div>

        <!-- Footer -->
        <footer>
            
        </footer>
        <!-- Footr End -->

    
</body>

</html>
