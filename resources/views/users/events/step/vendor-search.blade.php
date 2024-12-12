@push('style')

<style>
  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: #FFCD29 !important;
    color: black;
  }
</style>

@endpush

<div class="card mg-b-20">
  <div class="card-header justify-content-between">
    <h3 class="card-title">
      Vendor Search
    </h3>
    <button class="btn btn-success btn-sm" onclick="CORE.showModal('modalFilter')">Filter</button>
  </div>
  <div class="card-body">
    <div class="row" id="vendorsearchcontainer" style="height: 355px;overflow: scroll;">
      <div>Loading</div>
    </div>


    <div class="d-flex justify-content-end mt-4">
      <button type="button" class="btn btn-secondary prev me-3">Back</button>
      <button type="button" class="btn btn-warning next" onclick="Order.nextStep4()">Next</button>
    </div>
  </div>
</div>



<div class="modal fade" id="modalDetailVendor" tabindex="-1" aria-labelledby="modalDetailVendorLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">

      <div class="modal-body" style="background: #E6E6E6;">
        @include('users.events.step.modal.vendor-detail')
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
        {{-- @include('users.events.step.modal.product-detail') --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-action-modal-product-close"
          data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalFilter">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filter Vendor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="form-group my-3">
          <label>Vendor Range</label>
          <input type="text" name="vendor_range_location" class="form-control input-filter-vendor" placeholder="input km...">
        </div>

        <div class="form-group my-3">
          <label>Budget Range</label>
          <div class="row">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">RM</span>
                <input type="text" class="form-control input-filter-vendor" name="start_range_budget">
              </div>
            </div>
            <div class="col-md-1"> - </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">RM</span>
                <input type="text" class="form-control input-filter-vendor" name="end_range_budget">
              </div>
            </div>
          </div>
        </div>

        <button class="btn btn-info btn-sm" onclick="Order.nextStep3(false)">Filter</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>