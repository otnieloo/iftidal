@extends('layouts.admin.app')

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
      @include('user.event.step.form')

    </div>

    <div id="criteria" class="tab-pane" role="tabpanel" aria-labelledby="criteria">
      @include('user.event.step.criteria')
    </div>

    <div id="summary" class="tab-pane" role="tabpanel" aria-labelledby="summary">
      @include('user.event.step.summary')
    </div>

    <div id="vendorsearch" class="tab-pane" role="tabpanel" aria-labelledby="vendorsearch">
      @include('user.event.step.vendor-search')
    </div>

    <div id="cart" class="tab-pane" role="tabpanel" aria-labelledby="cart">
      @include('user.event.step.cart')
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
<script src="{{asset('build/assets/plugins/treeview/treeview.js')}}"></script>

<script src="{{ asset('assets/js/apps/event.js') }}"></script>

@endpush