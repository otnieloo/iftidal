@extends('layouts.users.app')

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

@livewire('apps.users.orders.index')

@endsection