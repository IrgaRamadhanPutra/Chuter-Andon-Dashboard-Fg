<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/family.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/perfect-scrollbar.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/style.css') }}">
        <link defer="" rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/animate.css') }}">
        <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
        <script defer="" src="{{ asset('assets/js/popper.min.js') }}"></script>
        {{-- <script defer="" src="{{ asset('assets/js/tippy-bundle.umd.min.js') }}"></script> --}}
        <script defer="" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    </head>

    <body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">

        <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">

                <!-- start header section -->
                @include('admin.header')

                <!-- end header section -->

                <div class="animate__animated p-6" :class="[$store.app.animation]">
                    <!-- start main content section -->
                    @yield('content')
                    <!-- end main content section -->
                </div>

                <!-- start footer section -->
                @include('admin.footer')
                <!-- end footer section -->
            {{-- </div> --}}
        </div>

        <script src="{{ asset('assets/js/alpine-collaspe.min.js') }}"></script>
        <script src="{{ asset('assets/js/alpine-persist.min.js') }}"></script>
        <script defer="" src="{{ asset('assets/js/alpine-ui.min.js') }}"></script>
        <script defer="" src="{{ asset('assets/js/alpine-focus.min.js') }}"></script>
        <script defer="" src="{{ asset('assets/js/alpine.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script defer="" src="{{ asset('assets/js/apexcharts.js') }}"></script>
    </body>
</html>
