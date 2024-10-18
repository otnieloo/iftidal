@extends('layouts.admin.app')

@section('content')
    
  <form action="{{ route('app.customers.update', $customer->id) }}" method="POST" with-submit-crud>
    @csrf
    @method("PUT")

    <div class="card">
      <div class="card-body">

        @include('admin.customers.form')

        <button class="btn btn-success btn-sm">{{ __("Update Customer") }}</button>

      </div>
    </div>

  </form>

@endsection