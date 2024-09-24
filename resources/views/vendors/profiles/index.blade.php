@extends('layouts.vendors.app')

@push('styles')
<style>
  .profile-vendor {
    height: 150px;
    width: 150px;
    top: -100px;
  }

  .body-profile {
    position: absolute;
    top: 30%;
    left: 20px;
  }

  .body-profile img {
    border-radius: 10px;
  }
</style>
@endpush

@section('content')

<div class="card position-relative" style="height: 500px;">
  <img class="card-img-top" style="height: 300px; object-fit: cover; padding: 20px;" src="{{ $vendor->company_banner_logo }}" onerror="CORE.onerrorBannerVendor(this)" alt="Card image">
  <div class="card-body body-profile">
    <img src="{{ $vendor->logo }}" onerror="CORE.onerrorProfileVendor(this)" alt="" class="profile-vendor">
    <div class="mt-5">
      <h3>{{ $user->name }}</h3>
      <p>
        {{ $vendor->company_name }} <br>
        @if ($vendor->category)
        {{ $vendor->category->parent_category . " : " . $vendor->category->vendor_category }}
        @else
        {{ __("Uncategory") }}
        @endif
      </p>
    </div>

    <ul class="nav nav-pills" style="background-color: rgba(51, 158, 245, 0.2); padding: 10px;">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="pill" href="#aboutTab">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="pill" href="#editTab">Edit Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="pill" href="#statusTab">Status</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="pill" href="#galleryTab">Gallery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="pill" href="#clientsTab">Clients</a>
      </li>
    </ul>

  </div>
</div>

<div class="card">
  <div class="card-body">

    <div class="tab-content">
      <div class="tab-pane container active" id="aboutTab">

        <h5>{{ __("Vendor Information") }}</h5>
        <hr style="border: 1px solid black; padding: 0; margin: 0">

        <p class="my-3">
          {!! nl2br($vendor->company_description) !!}
        </p>

        <h5 class="mt-5">{{ __("Services") }}</h5>
        <hr style="border: 1px solid black; padding: 0; margin: 0">

        <div class="mt-3">
          <button class="btn btn-warning btn-sm">Makeup</button>
          <button class="btn btn-warning btn-sm">Face Painter</button>
        </div>

        <h5 class="mt-5">{{ __("Details") }}</h5>
        <hr style="border: 1px solid black; padding: 0; margin: 0">

        <div class="row mt-4">
          <div class="col-md-4">

            <div class="row">
              <div class="col-md-4">
                <i class="fa-regular fa-map text-center d-block mx-auto" style="font-size: 40px;"></i>
              </div>
              <div class="col-md-8">
                <h6>{{ __("Location") }}</h6>
                <p>{{ $vendor->company_address }}</p>
              </div>
            </div>

          </div>
        </div>

      </div>
      <div class="tab-pane container fade" id="editTab">

        <div></div>
        <form action="{{ route('vendor.profiles.update') }}" method="POST" enctype="multipart/form-data"
          with-submit-crud>
          @csrf
          @method("PUT")

          @livewire('apps.vendors.profiles.update', ['vendor' => $vendor])

          <button class="btn btn-success btn-sm">{{ __("Update Profile") }}</button>
        </form>

      </div>
      <div class="tab-pane container fade" id="statusTab">

        @if ($vendor->vendor_status_id == 2)
        <div class="alert alert-warning">{{ __("Your vendor is review by admin") }}</div>
        @endif
        @if ($vendor->vendor_status_id == 3)
        <div class="alert alert-success">{{ __("Your vendor is approved") }}</div>
        @endif
        @if ($vendor->vendor_status_id == 4)
        <div class="alert alert-danger">{{ __("Your vendor is declined") }}</div>
        @endif

      </div>
      <div class="tab-pane container fade" id="galleryTab">...</div>
      <div class="tab-pane container fade" id="clientsTab">...</div>
    </div>

  </div>
</div>

@endsection
