@extends('layouts.vendors.app')

@section('content')
<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
  <ol class="breadcrumb mb-sm-0 mb-3">
    <!-- breadcrumb -->
    <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Order</li>
  </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="card order-page">
  <div class="card-body">

    <ul class="nav nav-tabs mb-4" id="orderTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-orders-tab" data-bs-toggle="tab" data-bs-target="#all-orders" type="button"
          role="tab" aria-controls="all-orders" aria-selected="true">All Order ({{ $count_orders }})</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="new-orders-tab" data-bs-toggle="tab" data-bs-target="#new-orders" type="button"
          role="tab" aria-controls="new-orders" aria-selected="false">New Order ({{ $count_new_orders }})</button>
      </li>
    </ul>

    <div class="tab-content" id="orderTabsContent">
      <div class="tab-pane fade show active" id="all-orders" role="tabpanel" aria-labelledby="all-orders-tab">

        @livewire('apps.vendors.orders.index')

      </div>

      <div class="tab-pane fade" id="new-orders" role="tabpanel" aria-labelledby="new-orders-tab">

        @livewire('apps.vendors.orders.index-new')

      </div>
    </div>

  </div>
</div>

@endsection
