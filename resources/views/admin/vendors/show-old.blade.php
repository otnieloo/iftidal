@extends('layouts.admin.app')


@push('style')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


<style>
  #map {
    height: 380px;
  }
</style>

@endpush


@section('content')

<a href="{{ route('app.vendors.edit', $vendor->id) }}" class="btn btn-sm btn-info mb-2">Edit Vendor</a>

<div class="card">
  <div class="card-body">
    <h4 class="mb-4">{{ __('Company Information') }}</h4>

    <div class="row">
      <div class="col-lg-6 col-md-12">
        <table class="table">
          <tr>
            <th>{{ __('Company Name') }}</th>
            <td>: {{ $vendor->company_name }}</td>
          </tr>
          <tr>
            <th>{{ __('Company Phone') }}</th>
            <td>: {{ $vendor->company_phone }}</td>
          </tr>

          <tr>
            <th>{{ __('Company Email') }}</th>
            <td>: {{ $vendor->company_email }}</td>
          </tr>

          <tr>
            <th>{{ __('Company Address') }}</th>
            <td>: {{ $vendor->company_address }}</td>
          </tr>
        </table>

      </div>

      <div class="col-lg-6 col-md-12">
        <div class="row my-12">
          <div class="col-md-2">
            <label>{{ __('Logo') }}</label>
          </div>
          <div class="col-md-12">
            <a href="{{ asset('storage/' . $vendor->logo) }}" target="_blank">
              <img src="{{ asset('storage/' . $vendor->logo) }}" alt="Logo Image" width="300" height="250">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <h4>{{ __('Contact Person') }}</h4>

        <table class="table">
          <tr>
            <th>{{ __('Contact Person Name') }}</th>
            <td>: {{ $vendor->contact_person_name }}</td>
          </tr>
          <tr>
            <th>{{ __('Contact Person Phone') }}</th>
            <td>: {{ $vendor->contact_person_phone }}</td>
          </tr>

          <tr>
            <th>{{ __('Contact Person Email') }}</th>
            <td>: {{ $vendor->contact_person_email }}</td>
          </tr>
        </table>
      </div>
      <div class="col-lg-6 col-md-12">
        <h4>{{ __('User') }}</h4>
        <div class="col-lg-12">
          <table class="table">
            <tr>
              <th>{{ __('Name') }}</th>
              <td>: {{ $vendor->user->name }}</td>
            </tr>
            <tr>
              <th>{{ __('Email') }}</th>
              <td>: {{ $vendor->user->email }}</td>
            </tr>

          </table>
        </div>
      </div>
    </div>




  </div>
</div>



<div class="card">
  <div class="card-body">
    <h4>Location</h4>
    <div class="row mb-3">

      <table class="table">
        <tr>
          <th>Latitude</th>
          <td>: {{ $vendor->latitude }}</td>
        </tr>
        <tr>
          <th>Longitude</th>
          <td>: {{ $vendor->longitude }}</td>
        </tr>

        <input type="hidden" name="latitude" id="latitude" value="{{ $vendor->latitude }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ $vendor->longitude }}">
        <input type="hidden" value="readonly" id="readonly">
        <input type="hidden" id="type" value="{{ $type }}">
      </table>

    </div>
    <div id="map"></div>
  </div>
</div>

@endsection

@push('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('assets/js/apps/vendor.js') }}"></script>

@endpush