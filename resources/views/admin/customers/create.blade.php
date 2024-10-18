@extends('layouts.admin.app')

@section('content')
    
  <form action="{{ route('app.customers.store') }}" method="POST" with-submit-crud>
    @csrf

    <div class="card">
      <div class="card-body">

        @include('admin.customers.form')

        <button class="btn btn-success btn-sm">{{ __("Add New Customer") }}</button>

      </div>
    </div>

  </form>

@endsection