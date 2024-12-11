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
  <div class="card-header">
    <h3 class="card-title">
      Vendor Search
    </h3>
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