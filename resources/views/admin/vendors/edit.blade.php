@extends('layouts.admin.app')

@section('content')


<form action="{{ route('app.vendors.update', $vendor->id) }}" method="POST" with-submit-crud>
  @csrf
  @method("PUT")

  @include('admin.vendors.form')
  <button class="btn btn-success btn-sm">Edit Vendor</button>
</form>


@endsection