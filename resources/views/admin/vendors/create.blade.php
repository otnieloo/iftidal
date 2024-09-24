@extends('layouts.admin.app')

@section('content')




<form action="{{ route('app.vendors.store') }}" method="POST" with-submit-crud>
  @csrf

  @include('admin.vendors.form')
  <button class="btn btn-success btn-sm">Tambah Vendor</button>
</form>





@endsection