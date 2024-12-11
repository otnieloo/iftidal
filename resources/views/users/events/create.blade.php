@extends('layouts.users.app')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet"
  type="text/css" />

<style>
  #smartwizard .nav-link {

    padding-left: 55px !important;
  }
</style>

@endpush


@section('content')

<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
  <ol class="breadcrumb mb-sm-0 mb-3">
    <!-- breadcrumb -->
    <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Product & Services</li>
  </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div id="smartwizard">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="#form">
        <div class="num">1</div>
        Create Event
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#criteria">
        <span class="num">2</span>
        Select Criteria
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#summary">
        <span class="num">3</span>
        Event Summary
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#vendorsearch">
        <span class="num">4</span>
        Vendor Search
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#cart">
        <span class="num">5</span>
        Product Cart
      </a>
    </li>

  </ul>

  <div class="tab-content">
    <div id="form" class="tab-pane" role="tabpanel" aria-labelledby="form">
      @include('users.events.step.form')
      {{-- @livewire('apps.users.orders.setup.step1') --}}
    </div>

    <div id="criteria" class="tab-pane" role="tabpanel" aria-labelledby="criteria">
      @include('users.events.step.criteria')
      {{-- @livewire('apps.users.orders.setup.step2') --}}
    </div>

    <div id="summary" class="tab-pane" role="tabpanel" aria-labelledby="summary">
      @include('users.events.step.summary')
      {{-- @livewire('apps.users.orders.setup.step3') --}}
    </div>

    <div id="vendorsearch" class="tab-pane" role="tabpanel" aria-labelledby="vendorsearch">
      @include('users.events.step.vendor-search')
      {{-- @livewire('apps.users.orders.setup.step4') --}}
    </div>

    <div id="cart" class="tab-pane" role="tabpanel" aria-labelledby="cart">
      @include('users.events.step.cart')
      {{-- @livewire('apps.users.orders.setup.step5') --}}
    </div>
  </div>
</div>


@endsection

@push('script')

<!-- FLATPICKER JS -->
<script src="{{asset('build/assets/plugins/flatpickr/flatpickr.js')}}"></script>

<!-- DATEPICKER JS -->
<script src="{{asset('build/assets/plugins/spectrum-date-picker/spectrum.js')}}"></script>
<script src="{{asset('build/assets/plugins/spectrum-date-picker/jquery-ui.js')}}"></script>
<script src="{{asset('build/assets/plugins/input-mask/jquery.maskedinput.js')}}"></script>

<!-- SMARTWIZZARD JS -->
<script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript">
</script>
<!-- SELECT2 JS -->
<script src="{{asset('build/assets/plugins/select2/select2.full.min.js')}}"></script>
@vite('resources/assets/js/select2.js')

<!-- TREEVIEW -->
<script src="{{asset('build/assets/plugins/owl-carousel/owl.carousel.js')}}"></script>
<script src="{{asset('build/assets/plugins/treeview/treeview.js')}}"></script>

<script src="{{asset('build/assets/plugins/gallery/picturefill.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lightgallery.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lightgallery-1.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-pager.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-autoplay.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-fullscreen.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-zoom.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-hash.js')}}"></script>
<script src="{{asset('build/assets/plugins/gallery/lg-share.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.13/dayjs.min.js"></script>
<script src="{{ asset('assets/js/apps/event.js') }}"></script>
<script src="{{ asset('assets/js/apps/setup-event.js?v=' . time()) }}"></script>

@endpush