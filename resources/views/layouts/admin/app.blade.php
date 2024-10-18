<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <!-- META DATA -->
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- TITLE -->
  <title>Amboi - {{ $title ?? 'A platform that brings together vendors and event committees' }}</title>

  <!-- FAVICON -->
  <link rel="icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('build/assets/images/brand/favicon.ico')}}" type="image/x-icon">

  <!-- BOOTSTRAP CSS -->
  <link id="style" href="{{asset('build/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- APP SCSS -->
  @vite(['resources/sass/app.scss'])


  <!-- ICONS CSS -->
  <link href="{{asset('build/assets/iconfonts/icons.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- ANIMATE CSS -->
  <link href="{{asset('build/assets/iconfonts/animated.css')}}" rel="stylesheet">

  <!-- APP CSS -->
  @vite(['resources/css/app.css'])

  @stack('style')
  @yield('styles')
  @livewireStyles


</head>

<body class="app sidebar-mini ltr">

  <!-- PAGE -->
  <div class="page">
    <div class="page-main">

      <!-- MAIN-HEADER -->
      @include('layouts.admin.components.main-header')

      <!-- END MAIN-HEADER -->

      <!-- MAIN-SIDEBAR -->
      @include('layouts.admin.components.main-sidebar')

      <!-- END MAIN-SIDEBAR -->

      <!-- MAIN-CONTENT -->
      <div class="main-content app-content">
        <div class="side-app">
          <!-- CONTAINER -->
          <div class="main-container container-fluid">
            <div style="margin-top: 100px">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
      <!-- END MAIN-CONTENT -->
    </div>

    <!-- RIGHT-SIDEBAR -->
    @include('layouts.admin.components.right-sidebar')

    <!-- END RIGHT-SIDEBAR -->

    <!-- MAIN-FOOTER -->
    @include('layouts.admin.components.main-footer')

    <!-- END MAIN-FOOTER -->

  </div>
  <!-- END PAGE-->

  <!-- SCRIPTS -->

  <!-- JQUERY MIN JS -->
  <script src="{{asset('build/assets/plugins/jquery/jquery.min.js')}}"></script>

  <!-- BOOTSTRAP5 BUNDLE JS -->
  <script src="{{asset('build/assets/plugins/bootstrap/popper.min.js')}}"></script>
  <script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

  <!-- PERFECT-SCROLLBAR JS  -->
  <script src="{{asset('build/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('build/assets/plugins/p-scroll/pscroll.js')}}"></script>

  <!-- SIDEMENU JS -->
  <script src="{{asset('build/assets/plugins/sidemenu/sidemenu.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>

  <!-- RIGHT SIDEBAR JS -->
  <script src="{{asset('build/assets/plugins/sidebar/sidebar.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('vendor/datatables-bs5/datatables.min.js?v=') . random_string(7) }}"></script>
  <script src="{{ asset('assets/js/core.js?v=') . random_string(7) }}"></script>

  <!-- APP JS -->
  @vite('resources/js/app.js')

  @livewireScripts
  @stack('script')
  <!-- END SCRIPTS -->

</body>

</html>