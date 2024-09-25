<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="Description" content="Sparic - Laravel Multipurpose Responsive Bootstrap5 Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template, vite laravel template, vite admin template, vite laravel admin, vite laravel admin dashboard, vite laravel bootstrap admin template">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TITLE -->
    <title> Sparic - Laravel Multipurpose Responsive Bootstrap5 Dashboard Template</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('build/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- APP SCSS -->
    @vite(['resources/sass/app.scss'])


    <!-- ICONS CSS -->
    <link href="{{asset('build/assets/iconfonts/icons.css')}}" rel="stylesheet">

    <!-- ANIMATE CSS -->
    <link href="{{asset('build/assets/iconfonts/animated.css')}}" rel="stylesheet">

    <!-- APP CSS -->
    @vite(['resources/css/app.css'])

    @yield('styles')

    <style>
        .parent-loader {
            position: absolute;
            background: rgba(0, 0, 0, 0.377);
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
    </style>
    {!! htmlScriptTagJsApi() !!}

</head>

<body class="bg-account app sidebar-mini ltr">

    <!--- GLOBAL LOADER -->
    <div id="global-loader">
        <img src="{{asset('build/assets/images/svgs/loader.svg')}}" alt="loader">
    </div>
    <!--- END GLOBAL LOADER -->

    <!-- PAGE -->
    <div class="page h-100">
        <div class="lds-ring parent-loader d-none">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- MAIN-CONTENT -->
        @yield('content')
        <!-- END MAIN-CONTENT -->
    </div>
    <!-- END PAGE-->

    <!-- SCRIPTS -->

    <!-- JQUERY MIN JS -->
    <script src="{{asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP5 BUNDLE JS -->
    <script src="{{asset('build/assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- MOMENT JS -->
    <script src="{{asset('build/assets/plugins/moment/moment.min.js')}}"></script>

    <!-- NEWS TICKER JS -->
    <script src="{{asset('build/assets/plugins/newsticker/breaking-news-ticker.min.js')}}"></script>


    <!-- STICKY JS -->
    <script src="{{asset('build/assets/sticky.js')}}"></script>

    <!-- THEMECOLOR JS -->
    @vite('resources/assets/js/themeColors.js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/core.js?v=') . random_string(7) }}"></script>


    <!-- APP JS -->
    @vite('resources/js/app.js')
    @yield('scripts')



    <!-- END SCRIPTS -->

</body>

</html>