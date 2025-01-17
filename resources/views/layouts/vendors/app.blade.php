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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

  <!-- APP SCSS -->
  @vite(['resources/sass/app.scss'])


  <!-- ICONS CSS -->
  <link href="{{asset('build/assets/iconfonts/icons.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

  <!-- ANIMATE CSS -->
  <link href="{{asset('build/assets/iconfonts/animated.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/main/custom-admin.css?v=') . random_string(7) }}">
  <link rel="stylesheet" href="{{ asset('assets/css/main/custom-vendor.css?v=') . random_string(7) }}">

  <!-- APP CSS -->
  @vite(['resources/css/app.css'])

  <script src="{{ asset('assets/js/core.js?v=') . random_string(7) }}"></script>

  @stack('style')

</head>

<body class="app sidebar-mini ltr">

  <div class="lds-ring parent-loader d-none">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- PAGE -->
  <div class="page">
    <div class="page-main">

      <!-- MAIN-HEADER -->
      @include('layouts.admin.components.main-header')

      <!-- END MAIN-HEADER -->

      <!-- MAIN-SIDEBAR -->
      @include('layouts.vendors.components.main-sidebar')

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
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="{{asset('build/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

  <!-- PERFECT-SCROLLBAR JS  -->
  <script src="{{asset('build/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('build/assets/plugins/p-scroll/pscroll.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>

  <!-- SIDEMENU JS -->
  <script src="{{asset('build/assets/plugins/sidemenu/sidemenu.js')}}"></script>

  <!-- RIGHT SIDEBAR JS -->
  <script src="{{asset('build/assets/plugins/sidebar/sidebar.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('vendor/datatables-bs5/datatables.min.js?v=') . random_string(7) }}"></script>

  <!-- APP JS -->
  @vite('resources/js/app.js')

  @livewireScripts
  <x-livewire-alert::scripts />
  <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
  <x-livewire-alert::flash />
  
  <script>
    CORE.init();
  </script>
  @stack('script')
  <!-- END SCRIPTS -->

</body>

</html>
