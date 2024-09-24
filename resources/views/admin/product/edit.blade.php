@extends('layouts.admin.app')
@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('app.products.update', $product->id) }}" method="POST" with-submit-crud>
      @csrf
      @method('PUT')
      @include('admin.product.form')

      <div class="d-flex justify-content-end">
        <button class="btn btn-success btn-sm mt-3" style="width: fit-content;">Edit Product</button>
      </div>
    </form>
  </div>
</div>
@endsection
