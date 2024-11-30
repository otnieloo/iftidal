@push('style')

<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/11.0.2/choices.min.css">
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">

<style>
  .filepond--item {
    width: calc(30% - 0.5em);
  }
</style>

@endpush


<div class="row">

  @php
  $vendor_id = '';

  if (auth()->user()->role_id == 2) {
  $vendor_id = auth()->user()->vendor_id;
  } else {
  if(request()->has('vendor_id')){
  $vendor_id = request('vendor_id');
  } else{
  $vendor_id = isset($product) ? $product->vendor_id : '';
  }
  }

  @endphp

  <input type="hidden" name="vendor_id" id="vendor_id" value="{{ $vendor_id }}">

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_name">{{ __('Product Name') }}*</label>
        </div>
        <div class="col-lg-10 col-md-12">
          <input type="text" name="product_name" id="product_name" value="{{ $product->product_name ?? '' }}"
            class="form-control">
          <div></div>
        </div>
      </div>
    </div>
  </div>


  @livewire('apps.components.search-category-product', ['product' => $product ?? NULL])

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_capital_price">{{ __('Cost Price') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="input-group">
            <div class="input-group-text">
              RM
            </div>
            <input type="text" name="product_capital_price" id="product_capital_price"
              value="{{ $product->product_capital_price ?? '' }}" class="form-control">
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-lg-6">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <label class="form-label" for="product_sell_price">{{ __('Selling Price') }}*</label>
        </div>
        <div class="col-lg-8 col-md-12">
          <div class="input-group">
            <div class="input-group-text">
              RM
            </div>
            <input type="text" name="product_sell_price" id="product_sell_price"
              value="{{ $product->product_sell_price ?? '' }}" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (isset($product))
  <input type="hidden" id="productPackage" value="{{ json_encode($package) }}">
  @endif

  @if($type == 'products')
  <div class="col-lg-6 col-md-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_sku">{{ __('SKU') }}*</label>
        </div>
        <div class="col-lg-10 col-md-12">
          <input type="text" name="product_sku" id="product_sku" value="{{ $product->product_sku ?? '' }}"
            class="form-control">
          <div></div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="col-lg-6 col-md-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_slot">{{ __('Set Slot') }}*</label>
        </div>
        <div class="col-lg-10 col-md-12">
          <input type="text" name="product_slot" id="product_slot" value="{{ $product->product_slot ?? '' }}"
            class="form-control">
          <div></div>
        </div>
      </div>
    </div>
  </div>
  @endif

  @if($type == 'products')

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_condition_id">{{ __('Condition') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <select name="product_condition_id" id="product_condition_id" class="form-control form-select select2">
            @foreach ($conditions as $condition)
            <option value="{{ $condition->id }}" {{ isset($product->product_condition_id) &&
              $product->product_condition_id == $condition->id ?"selected" : "" }}>{{ $condition->product_condition }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>


  {{-- <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_stock">{{ __('Stock') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <input type="text" name="product_stock" id="product_stock" value="{{ $product->product_stock ?? '' }}"
            class="form-control">
          <div></div>
        </div>
      </div>
    </div>
  </div> --}}

  @else

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_level_id">{{ __('Level') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <select name="product_level_id" id="product_level_id" class="form-control form-select select2">
            @foreach ($product_levels as $product_level)
            <option value="{{ $product_level->id }}" {{ isset($product->product_level_id) && $product->product_level_id
              == $product_level->id ?"selected" : "" }}>{{ $product_level->product_level }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

  @endif

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="selectVariations">{{ __('Variation') }}*</label>
        </div>
        <div class="col-lg-8 col-md-12">
          <select name="variations[]" id="selectVariations" class="form-control" required multiple>
            {{-- <option value="1">Satu</option>
            <option value="2">Dua</option> --}}
          </select>
          <div></div>
        </div>
        <div class="col-lg-2 col-md-12">
          <small class="text-danger">* Maximum 10 Variation</small>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <div class="row align-items-center">
        <div class="col-lg-2 col-md-12">
          <label class="form-label">{{ __('Payment Release Method') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <select name="payment_release_id" class="form-control">
            @foreach ($payment_releases as $item)
            <option {{ isset($product->payment_release_id) && $product->payment_release_id == $item->id ?"selected" : ""
              }} value="{{ $item->id }}">{{ $item->payment_release }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-2 col-md-12">
          <p class="p-0 m-0" style="cursor: pointer;" onclick="CORE.showModal('modalPaymentRelease')">
            <i class="fa-solid fa-circle-info"></i>
          </p>
        </div>
      </div>
    </div>
  </div>


  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-lg-2 col-md-12">
          <label class="form-label" for="product_description">{{ __('Description') }}*</label>
        </div>
        <div class="col-lg-10 col-md-12">
          <textarea name="product_description" id="product_description" class="form-control" cols="30"
            rows="10">{{ $product->product_description ?? '' }}</textarea>
          <div></div>
          <div class="product_description_word">0/3000</div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-2 col-md-12">
        <label class="form-label">{{ __('Image') }}*</label>
      </div>
      <div class="col-lg-10 col-md-12">

        @isset($product)
        @foreach ($product->product_images as $image)
        <input type="hidden" class="list_images" value="{{ $image->id }}">
        @endforeach
        @endisset

        <input type="file" name="tmp[]" multiple />
      </div>
    </div>

  </div>

  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-2 col-md-12">
        <label class="form-label">{{ __('Video') }}*</label>
      </div>
      <div class="col-lg-10 col-md-12">

        <div class="row">
          <div class="col-lg-6 col-md-12 mb-2">
            <input type="file" name="tmp_video" class="video-input" />

          </div>
          <div class="col-lg-6 col-md-12">
            <ul>
              <li class="small">Size: Max 30Mb, Resolution should not exceed 1280 x 1280 px</li>
              <li class="small">Duration: 10s-60s</li>
              <li class="small">Format: MP4</li>
              <li class="small">Note: You can publish this listing while the video is being processed.
                Video
                will be
                shown in listing once successfully processed.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


  @if($type == 'products')
  <div class="col-lg-12 mt-5">
    <div class="row">
      <div class="col-lg-2 col-md-12">
        <label class="form-label">{{ __('Package Price') }}*</label>
      </div>
      <div class="col-lg-10 col-md-12">

        <div class="row align-items-end mb-3">
          <div class="col-md-3">
            <div class="form-check">
              <input type="radio" class="form-check-input" name="package_type" value="1">Percentage
              Discount
              <label class="form-check-label" for="radio1"></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row align-items-end">
              <div class="col-lg-3 col-md-12">
                <label class="form-label">{{ __('Buy') }}</label>
              </div>
              <div class="col-lg-9 col-md-12">
                <input type="number" name="minimum_qty_1" class="form-control">
                <div></div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row align-items-end">
              <div class="col-lg-4 col-md-12">
                <label class="form-label">{{ __('items & get') }}</label>
              </div>
              <div class="col-5">
                <input type="number" name="package_price_percent_1" class="form-control">
              </div>
              <div class="col-3 d-flex align-items-center">
                %OFF
              </div>
            </div>
          </div>
        </div>
        <div class="row align-items-end my-3">
          <div class="col-md-3">
            <div class="form-check">
              <input type="radio" class="form-check-input" name="package_type" value="2">Amount Discount
              <label class="form-check-label" for="radio1"></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row align-items-end">
              <div class="col-lg-3 col-md-12">
                <label class="form-label">{{ __('Buy') }}</label>
              </div>
              <div class="col-lg-9 col-md-12">
                <input type="number" name="minimum_qty_2" class="form-control">
                <div></div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row align-items-end">
              <div class="col-lg-4 col-md-12">
                <label class="form-label">{{ __('items & get') }}</label>
              </div>
              <div class="col-5">
                <div class="input-group">
                  <div class="input-group-text">
                    RM
                  </div>
                  <input type="text" name="package_price_percent_2" class="form-control">
                </div>
                <div></div>
              </div>
              <div class="col-3 d-flex align-items-center">
                %OFF
              </div>
            </div>
          </div>
        </div>
        <div class="row align-items-end my-3">
          <div class="col-md-3">
            <div class="form-check">
              <input type="radio" class="form-check-input" name="package_type" value="3">Special Package
              Price
              <label class="form-check-label" for="radio1"></label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row align-items-end">
              <div class="col-lg-3 col-md-12">
                <label class="form-label">{{ __('Buy') }}</label>
              </div>
              <div class="col-lg-9 col-md-12">
                <input type="number" name="minimum_qty_3" class="form-control">
                <div></div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row align-items-end">
              <div class="col-lg-4 col-md-12">
                <label class="form-label">{{ __('items & get') }}</label>
              </div>
              <div class="col-8">
                <div class="input-group">
                  <div class="input-group-text">
                    RM
                  </div>
                  <input type="text" name="package_price_percent_3" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="row">
          <div class="col-lg-3 col-md-12 d-flex flex-column" style="border-right: 1px solid gray;gap:1.5rem;">
            <label class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" name="package_type" value="1" {{
                isset($product->product_package) && $product->product_package->package_type == 1 ?
              'checked' : '' }}>
              <span class="custom-control-label">Percentage Discount</span>
            </label>

            <label class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" name="package_type" value="2" {{
                isset($product->product_package) && $product->product_package->package_type == 2 ?
              'checked' : '' }}>
              <span class="custom-control-label">Amount Discount</span>
            </label>

            <label class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" name="package_type" value="3" {{
                isset($product->product_package) && $product->product_package->package_type == 3 ?
              'checked' : '' }}>
              <span class="custom-control-label">Special Package Price</span>
            </label>
          </div>


          <div class="col-lg-3 col-md-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-md-12">
                  <label class="form-label">{{ __('Buy') }}</label>
                </div>
                <div class="col-lg-9 col-md-12">
                  <input type="number" name="minimum_qty"
                    value="{{ isset($product->product_package) ? $product->product_package->minimum_qty : '' }}"
                    class="form-control">
                  <div></div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-12">
                  <label class="form-label">{{ __('Buy') }}</label>
                </div>
                <div class="col-lg-9 col-md-12">
                  <input type="number" name="minimum_qty"
                    value="{{ isset($product->product_package) ? $product->product_package->minimum_qty : '' }}"
                    class="form-control">
                  <div></div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-12">
                  <label class="form-label">{{ __('Buy') }}</label>
                </div>
                <div class="col-lg-9 col-md-12">
                  <input type="number" name="minimum_qty"
                    value="{{ isset($product->product_package) ? $product->product_package->minimum_qty : '' }}"
                    class="form-control">
                  <div></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5 col-md-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <label class="form-label">{{ __('items & get') }}</label>
                </div>
                <div class="col-5">
                  <input type="number" name="package_price_percent" value="{{
                                  isset($product->product_package) && $product->product_package->package_type == 1 ?
                              $product->product_package->value : '' }}" class="form-control">
                </div>
                <div class="col-3 d-flex align-items-center">
                  %OFF
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <label class="form-label">{{ __('items & get') }}</label>
                </div>
                <div class="col-5">
                  <input type="number" name="package_price_per_product" value="{{
                                          isset($product->product_package) && $product->product_package->package_type == 2 ?
                                      $product->product_package->value : '' }}" class="form-control">
                </div>
                <div class="col-3 d-flex align-items-center">
                  OFF
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <label class="form-label">{{ __('items at a package price of') }}</label>
                </div>
                <div class="col-lg-8 col-md-12">
                  <div class="input-group">
                    <div class="input-group-text">
                      RM
                    </div>
                    <input type="text" name="package_price_total" value="{{
                                              isset($product->product_package) && $product->product_package->package_type == 3 ?
                                          $product->product_package->value : '' }}" class="form-control">
                  </div>
                  <div></div>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
  @endif

  <input type="hidden" id="listVariations" value="{{ json_encode($variations ?? []) }}">

  <div class="col-12">
    <div class="form-group">
      <div class="row align-items-center">
        <div class="col-lg-2 col-md-12">
          <label class="form-label">{{ __('Guarantee') }}*</label>
        </div>
        <div class="col-lg-4 col-md-12">
          <select name="product_guarantee_id" class="form-control">
            @foreach ($guarantees as $item)
            <option {{ isset($product->product_guarantee_id) && $product->product_guarantee_id == $item->id ?"selected"
              : "" }} value="{{ $item->id }}">{{ $item->product_guarantee }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-2 col-md-12">
          <p class="p-0 m-0" style="cursor: pointer;" onclick="CORE.showModal('modalProductGuarantee')">
            <i class="fa-solid fa-circle-info"></i>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalPaymentRelease">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          {!! nl2br("
          We offer flexible payment plans.
          Choose from the following options:

          2 Instalments:
          10% now, 90% later (10-90)
          20% now, 80% later (20-80)
          50% now, 50% later (50-50)
          30% now, 70% later (30-70)
          40% now, 60% later (40-60)

          3 Instalments:
          30% now, 30% midway, 40% later (30-30-40)
          25% now, 25% midway, 50% later (25-25-50)
          10% now, 40% midway, 50% later (10-40-50)

          Payment Process:
          For 2 Instalments: The first payment is considered a deposit and will be held within the system. The second
          payment
          will be released after the job is completed, either upon customer confirmation or after 72 hours without
          disputes.

          For 3 Instalments: The first payment is a deposit. The second payment will be due before dispatch or delivery,
          and the
          third payment will be released after the job is completed, either upon customer confirmation or after 72 hours
          without
          disputes.
          ") !!}

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="modalProductGuarantee">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          {!! nl2br("
          Non-Delivery = 100% Refundable
          <ul>
            <li>
              If the vendor fails to deliver the promised product or service, the customer is entitled to a full refund.
            </li>
          </ul>
          Partial Delivery = Pro-Rated Refundable or Completion Required

          If only part of the order is delivered, the customer is eligible for a partial refund or completion of the
          remaining service.
          Quality Issue = Partial Refund or Service Redo
          If the product or service quality doesn't meet expectations, the customer can request a partial refund or have
          the
          vendor redo the service.
          Misrepresentation = Replacement or Partial Refund
          If the service or product differs significantly from what was advertised, the customer can receive a
          replacement or a
          partial refund.
          Late Delivery = Partial Refund or Discount
          For delayed products or services, customers can receive a partial refund or discount based on the
          inconvenience caused.
          Damage or Defect = Replacement or Full/Partial Refund
          For damaged or defective items, customers can request a replacement or a full or partial refund if replacement
          is not
          possible.
          Service Completion Issue = Partial Refund or Alternative Service
          If the service isn't completed as agreed, the customer is eligible for a partial refund or alternative
          compensation.
          Customer Satisfaction Guarantee = Goodwill Compensation
          If the customer is dissatisfied with the service quality despite no major issues, they may receive a goodwill
          gesture,
          such as a discount on future bookings.
          Vendor Unavailability = Full Refund or Replacement Vendor
          If the vendor cancels or is unavailable, the customer is entitled to a full refund or assistance in finding a
          suitable
          replacement.
          Product Authenticity Issue = Full Refund with Verification Required
          If the product authenticity is in question, the customer can request verification or receive a full refund if
          authenticity cannot be confirmed.

          Dispute Guidelines
          Clear Evidence Requirements: Vendors can specify acceptable evidence (e.g., photos, written statements,
          time-stamped
          messages) for each dispute type, helping customers understand what is needed to validate claims.
          Predefined Refund Policies: Vendors should define partial, full, or alternative compensation terms within
          their listings
          for each dispute category, making the resolution process smoother.
          Self-Resolution Encouragement: The platform could include a direct communication feature, allowing customers
          and vendors
          to negotiate and resolve disputes independently before escalating.
          ") !!}

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  @push('script')
  <!-- FORM ELEMENT ADVANCED JS -->
  {{-- @vite('resources/assets/js/formelementadvnced.js') --}}
  {{-- <script src="{{asset('build/assets/plugins/bootstrap-maxlength/dist/bootstrap-maxlength.min.js')}}"></script>
  --}}
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/11.0.2/choices.min.js"></script>

  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js">
  </script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js">
  </script>

  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
  <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
  <script src="{{ asset('assets/js/apps/product.js') }}"></script>

  @endpush