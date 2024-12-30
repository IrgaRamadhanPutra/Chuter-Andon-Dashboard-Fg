<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/family.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/style.css') }}">
    <link defer rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/animate.css') }}">

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>

    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/tippy-bundle.umd.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
</head>

<style>
    body.custom_page::before {
        content: '';
        position: fixed;
        /* Change from absolute to fixed to cover the entire viewport */

        /* Ensure it's behind all content */
    }
</style>

<body class="custom_page">

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">

        <div class="animate__animated p-6" :class="[$store.app.animation]">
            <!-- start main content section -->
            <div>
                <ul class="flex space-x-2 rtl:space-x-reverse">
                    <div x-data="dropdown" class="dropdown">
                        <button class="btn btn-primary dropdown-toggle">
                            Action
                        </button>
                    </div>
                    <a> tgl dan hari </a>
                    <a>ALL CUST</a>
                    <button type="button" x-tooltip="Secondary" data-theme="secondary"
                        class="btn btn-secondary">Secondary</button>
                    <button type="button" x-tooltip="Dark" data-theme="dark" class="btn btn-dark">Dark</button>
                </ul>
                <div class="space-y-8 pt-5" x-data="form">
                    <div class="panel flex items-center overflow-x-auto whitespace-nowrap p-3 text-primary">
                        <div class="rounded-full bg-primary p-1.5 text-white ring-2 ring-primary/30 ltr:mr-3 rtl:ml-3">
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5">
                                <path
                                    d="M19.0001 9.7041V9C19.0001 5.13401 15.8661 2 12.0001 2C8.13407 2 5.00006 5.13401 5.00006 9V9.7041C5.00006 10.5491 4.74995 11.3752 4.28123 12.0783L3.13263 13.8012C2.08349 15.3749 2.88442 17.5139 4.70913 18.0116C9.48258 19.3134 14.5175 19.3134 19.291 18.0116C21.1157 17.5139 21.9166 15.3749 20.8675 13.8012L19.7189 12.0783C19.2502 11.3752 19.0001 10.5491 19.0001 9.7041Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5"
                                    d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div class="panel lg:col-span-2">
                            <div class="mb-5">
                                <div class="flex w-full flex-wrap justify-between gap-4">
                                    <!-- Group Left (2 Buttons) -->
                                    <div class="flex justify-start w-1/3">
                                        <button type="button" x-tooltip="Secondary" data-theme="secondary"
                                            class="btn btn-secondary">Secondary</button>
                                        <button type="button" x-tooltip="Dark" data-theme="dark"
                                            class="btn btn-dark">Dark</button>
                                    </div>


                                    <!-- Group Right (3 Buttons) -->
                                    <div class="flex justify-end w-1/3">
                                        <button type="button" x-tooltip="Primary" data-theme="primary"
                                            class="btn btn-primary">Primary</button>
                                        <button type="button" x-tooltip="Info" data-theme="info"
                                            class="btn btn-info">Info</button>
                                        <button type="button" x-tooltip="Danger" data-theme="danger"
                                            class="btn btn-danger">Danger</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
