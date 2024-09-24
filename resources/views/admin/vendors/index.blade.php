@extends('layouts.admin.app')

@section('content')

<div class="card">
  <div class="card-body table-responsive">

    @if (check_authorized("007V"))
    <a href="{{ route('app.vendors.create') }}" class="btn btn-success btn-sm mb-3">{{ __('Add Vendor') }}</a>
    @endif

    @if (check_authorized("007V"))
    <table class="table table-bordered" id="tableVendor">
      <thead>
        <tr>
          <th>No</th>
          <th>Company Name</th>
          <th>Company Phone</th>
          <th>Company Email</th>
          <th>Company Address</th>
          <th>Contact Name</th>
          <th>Contact Phone</th>
          <th>Contact Email</th>
          <th>Register Date</th>
          <th>Approved Date</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    @endif

  </div>
</div>

@endsection

@if (check_authorized("007V"))
@push('script')
<script>
  CORE.dataTableServer("tableVendor", "/app/vendors/get");
</script>
@endpush
@endif