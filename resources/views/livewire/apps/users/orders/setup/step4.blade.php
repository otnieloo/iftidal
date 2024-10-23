<div>

  <div class="card mg-b-20">
    <div class="card-header">
      <h3 class="card-title">
        Vendor Search
      </h3>
    </div>
    <div class="card-body">


      <div class="row">
        <div class="col-lg-2 col-md-12">
          <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
            @foreach ($categories as $category)
            <li style="max-width: 110%;" class="nav-item text-center">
              <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }} w-100" id="home-tab4" data-bs-toggle="tab"
                href="#tab{{ $category->id }}" role="tab" aria-controls="home" aria-selected="true">{{
                $category->vendor_category }}</a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="col-lg-10 col-md-12">

          <div class="tab-content border p-3" id="myTab3Content">

            @foreach ($categories as $category)

            <div class="tab-pane fade p-0 {{ $loop->index == 0 ? 'show active' : '' }}" id="tab{{ $category->id }}"
              role="tabpanel" aria-labelledby="home-tab4">

              @foreach ($category->vendors as $vendor)
              <div class="row vendor-search my-3" onclick="Livewire.emit('show_vendor', '{{ $vendor->id }}')">
                <div class="col-lg-6 col-md-12 d-flex" style="gap:1rem;">
                  <img src="{{ $vendor->logo }}" onerror="CORE.onerrorProfileVendor(this)"
                    class="avatar avatar-xxl br-7" alt="person-image">

                  <div>
                    <h3 class="fw-bold" style="margin-bottom: 0;">{{ $vendor->company_name }}</h3>
                    <div class="text-muted">{{ $category->parent_category }} : {{ $category->vendor_category }}</div>
                  </div>
                </div>

                <div class="col-lg-6 col-md-12 d-flex justify-content-between">
                  <div class="text-center">
                    <div>Icon</div>
                    <div class="text-muted">Listing</div>
                    <div class="text-secondary">25</div>
                  </div>

                  <div class="text-center">
                    <div>Icon</div>
                    <div class="text-muted">Listing</div>
                    <div class="text-secondary">25</div>
                  </div>

                  <div class="text-center">
                    <div>Icon</div>
                    <div class="text-muted">Listing</div>
                    <div class="text-secondary">25</div>
                  </div>

                  <div class="text-center">
                    <div>Icon</div>
                    <div class="text-muted">Listing</div>
                    <div class="text-secondary">25</div>
                  </div>
                </div>

              </div>
              @endforeach

            </div>

            @endforeach

          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-secondary prev me-3">Back</button>
        <button type="button" class="btn btn-warning" onclick="Order.next4()">Next</button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDetailVendor" tabindex="-1" aria-labelledby="modalDetailVendorLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content shadow">

        <div class="modal-body" style="background: #E6E6E6;">

          @if ($vendor)
          @include('users.events.modals.vendor-detail')
          @endif

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-action-modal-close" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDetailProduct" tabindex="-1" aria-labelledby="modalDetailProductLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">

        <div class="modal-body" style="background: #E6E6E6;">
          @include('users.events.modals.product-detail')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-action-modal-product-close"
            onclick="Order.closeModalProduct()">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>