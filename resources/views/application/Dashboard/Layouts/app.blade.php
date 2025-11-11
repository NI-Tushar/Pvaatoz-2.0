<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Dashboard | @yield('title', 'This is Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <link rel="stylesheet" href="{{ url('Frontend/assets/css/color.css') }}">

    <!-- Flipbook StyleSheet start -->
    <link href="{{ url ('dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url ('dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Flipbook StyleSheet end -->


    <!-- App favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('small-logo.png')}}">
    <link href="{{ asset('Frontend/dashboard') }}/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('Frontend/dashboard') }}/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('Frontend/dashboard') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('Frontend/dashboard') }}/assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/translator.css') }}">

    
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
        h1,h2,h3,h4,h5,h6,p,span,a,label, strong{
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

    <!-- Begin page -->
    <div class="layout-wrapper">

        @yield('app-content')

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="{{ asset('Frontend/dashboard') }}/assets/js/vendor.min.js"></script>
    <script src="{{ asset('Frontend/dashboard') }}/assets/js/app.js"></script>

    <!-- Flipbook main Js file -->
    <script src="{{ url('dflip/js/libs/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('dflip/js/dflip.min.js') }}" type="text/javascript"></script>

    <!-- Knob charts js -->
    <script src="{{ asset('Frontend/dashboard') }}/assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!-- Sparkline Js-->
    <script src="{{ asset('Frontend/dashboard') }}/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="{{ asset('Frontend/dashboard') }}/assets/libs/morris.js/morris.min.js"></script>

    <script src="{{ asset('Frontend/dashboard') }}/assets/libs/raphael/raphael.min.js"></script>

    <!-- Dashboard init-->
    <script src="{{ asset('Frontend/dashboard') }}/assets/js/pages/dashboard.js"></script>

    @stack('script')

</body>

</html>
