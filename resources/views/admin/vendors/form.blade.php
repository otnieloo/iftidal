@push('style')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

<style>
  #map {
    height: 380px;
  }
</style>

@endpush


<div class="card">
  <div class="card-body">
    <h4 class="mb-4">{{ __('Company Information') }}</h4>


    <div class="row">


      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="{{ __('Company Name') }}" name="company_name"
          value="{{ $vendor->company_name ?? '' }}" placeholder="{{ __('Company Name') }}" id="company_name">
        </x-forms.input-grid>

        <x-forms.input-grid col1="12" col2="12" label="{{ __('Company phone') }}" name="company_phone"
          value="{{ $vendor->company_phone ?? '' }}" placeholder="{{ __('Company Phone') }}" id="company_phone">
        </x-forms.input-grid>

        <x-forms.input-grid col1="12" col2="12" label="{{ __('Company Email') }}" name="company_email"
          value="{{ $vendor->company_email ?? '' }}" placeholder="{{ __('Company Email') }}" id="company_email">
        </x-forms.input-grid>

        <x-forms.textarea-grid label="{{ __('Company Adress') }}" name="company_address" required="true"
          palceholder="{{ __('Company Adress') }}" value="{{ $vendor->company_address ?? '' }}" id="company_address">
          </x-forms.input-grid>
      </div>

      <div class="col-lg-6 col-md-12">

        <div class="form-group">
          <label>{{ __("Company Business") }}</label>
          <select name="vendor_business_id" class="form-control">
            @foreach ($vendor_businesses as $item)
            <option {{ isset($vendor) && $vendor->vendor_business_id == $item->id ? 'selected' : '' }} value="{{
              $item->id }}">{{
              $item->vendor_business }}</option>
            @endforeach
          </select>
          <div></div>
        </div>

        <div class="form-group">
          <label>{{ __("Company Categories") }}</label>
          <select name="vendor_category_id" class="form-control">
            @foreach ($vendor_categories as $item)
            <option {{ isset($vendor) && $vendor->vendor_category_id == $item->id ? 'selected' : '' }} value="{{
              $item->id }}">{{
              "$item->parent_category > $item->vendor_category" }}</option>
            @endforeach
          </select>
          <div></div>
        </div>

        <div class="row my-12">
          <div class="col-md-2">
            <label>{{ __('Logo') }}</label>
          </div>
          <div class="col-md-12">
            <input type="file" name="tmp" />
          </div>
        </div>
      </div>
    </div>


  </div>
</div>



<div class="card">
  <div class="card-body">

    <h4>{{ __('Contact Person') }}</h4>

    <div class="row">
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="{{ __('Contact Person Name') }}" name="contact_person_name"
          value="{{ $vendor->contact_person_name ?? '' }}" placeholder="{{ __('Contact Person Name') }}"
          id="contact_person_name">
        </x-forms.input-grid>
      </div>
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="{{ __('Contact Person Phone') }}" name="contact_person_phone"
          value="{{ $vendor->contact_person_phone ?? '' }}" placeholder="{{ __('Contact Person Phone') }}"
          id="contact_person_phone">
        </x-forms.input-grid>
      </div>
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="{{ __('Contact Person Email') }}" name="contact_person_email"
          value="{{ $vendor->contact_person_email ?? '' }}" placeholder="{{ __('Contact Person Email') }}"
          id="contact_person_email">
        </x-forms.input-grid>
      </div>

    </div>


    <h4>{{ __('User') }}</h4>


    <div class="row">
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="Email" name="email" type="email" id="email"
          value="{{ $vendor->user->email ?? '' }}" placeholder="Email"></x-forms.input-grid>
      </div>
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="Name" name="name" id="name"
          value="{{ $vendor->user->name ?? '' }}" placeholder="Name"></x-forms.input-grid>
      </div>

      <div class="col-lg-6 col-md-12">
        <div class="row align-items-center my-2">
          <div class="col-12">
            <label for="Password">{{ __('Password') }}</label>
          </div>
          <div class="col-12">
            <div class="input-group">
              <input type="password" name="password" class="form-control" id="password">
              <span class="input-group-text">
                <div class="form-check">
                  <input class="form-check-input togglepassword" type="checkbox">
                  <label class="form-check-label">{{ __('Show Password') }}</label>
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-6 col-md-12">
        <div class="row align-items-center my-2">
          <div class="col-12">
            <label for="password_confirmation">{{ __('Password Confirmation') }}</label>
          </div>
          <div class="col-12">
            <div class="input-group">
              <input type="password" name="password_confirmation" class="form-control">
              <span class="input-group-text">
                <div class="form-check">
                  <input class="form-check-input togglepassword" type="checkbox">
                  <label class="form-check-label">{{ __('Show Password') }}</label>
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>



<div class="card">
  <div class="card-body">

    <h4>{{ __('Location') }}</h4>

    <div class="row mb-3">
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="Latitude" name="latitude" id="latitude"
          value="{{ $vendor->latitude ?? '' }}" placeholder="Latitude"></x-forms.input-grid>
      </div>
      <div class="col-lg-6 col-md-12">
        <x-forms.input-grid col1="12" col2="12" label="Longitude" name="longitude" id="longitude"
          value="{{ $vendor->longitude ?? '' }}" placeholder="Longitude"></x-forms.input-grid>
      </div>
    </div>

    <input type="hidden" id="type" value="{{ $type }}">
    <div id="map"></div>
  </div>
</div>


@push('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>

<script src="{{ asset('assets/js/apps/vendor.js') }}"></script>


@endpush