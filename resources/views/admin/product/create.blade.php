@extends('layouts.admin.app')
@section('content')

<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
  <ol class="breadcrumb mb-sm-0 mb-3">
    <!-- breadcrumb -->
    <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
    <li class="breadcrumb-item">
      <a href="{{ route('app.products.index') }}">Product & Services</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Add {{ $type }}</li>
  </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="card">
  <div class="card-body">

    <div></div>

    <form action="{{ route('app.products.store') }}" method="POST" with-submit-crud>
      @csrf
      @include('admin.product.form')


      <div class="d-flex justify-content-end">
        <button class="btn btn-success btn-sm mt-3" style="width: fit-content;">{{ $type === 'products' ? 'Add
          Product' : 'Add Service' }}</button>
      </div>
    </form>
  </div>
</div>
@endsection
