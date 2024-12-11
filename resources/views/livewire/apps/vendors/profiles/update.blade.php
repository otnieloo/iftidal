<div>

  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Name") }}</label>
    </div>
    <div class="col-md-6">
      <input type="text" name="company_name" class="form-control" value="{{ $vendor->company_name }}">
      <div></div>
    </div>
  </div>
  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Category") }}</label>
    </div>
    <div class="col-md-6">
      <select name="vendor_category_id" class="form-control">
        @foreach ($categories as $item)
          <option {{ $vendor->vendor_category_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ "$item->parent_category > $item->vendor_category" }}</option>
        @endforeach
      </select>
      <div></div>
    </div>
  </div>
  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Email") }}</label>
    </div>
    <div class="col-md-6">
      <input type="text" name="company_email" class="form-control" value="{{ $vendor->company_email }}">
      <div></div>
    </div>
  </div>
  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Address") }}</label>
    </div>
    <div class="col-md-6">
      <input type="text" name="company_address" class="form-control" value="{{ $vendor->company_address }}">
      <div></div>
    </div>
  </div>

  <div class="my-3">
    <input type="hidden" name="latitude" value="{{ $vendor->latitude ?? '3.1351092' }}">
    <input type="hidden" name="longitude" value="{{ $vendor->longitude ?? '101.6127829' }}">

    <div id="maps" style="height: 200px; width: 100%;"></div>
  </div>

  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Description") }}</label>
    </div>
    <div class="col-md-6">
      <textarea name="company_description" class="form-control" cols="30"
        rows="5">{{ $vendor->company_description }}</textarea>
      <div></div>
    </div>
  </div>
  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Logo") }}</label>
    </div>
    <div class="col-md-6">
      <input type="file" name="company_logo" class="form-control">
      <div></div>
    </div>
  </div>
  <div class="row align-items-end my-3">
    <div class="col-md-2">
      <label>{{ __("Company's Banner Logo") }}</label>
    </div>
    <div class="col-md-6">
      <input type="file" name="company_banner_logo" class="form-control">
      <div></div>
    </div>
  </div>

</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
<script src="{{ asset('assets/js/vendors/profile.js?v=' . time()) }}"></script>
@endpush
