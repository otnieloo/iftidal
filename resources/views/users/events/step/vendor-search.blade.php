@push('style')

<style>
  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background-color: #FFCD29 !important;
    color: black;
  }
</style>

@endpush

<div class="modal fade" id="modalDetailVendor" tabindex="-1" aria-labelledby="modalDetailVendorLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">

      <div class="modal-body" style="background: #E6E6E6;">
        @include('user.event.step.modal.vendor-detail')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-action-modal-close">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalDetailProduct" tabindex="-1" aria-labelledby="modalDetailProductLabel"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">

      <div class="modal-body" style="background: #E6E6E6;">
        @include('user.event.step.modal.product-detail')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-action-modal-product-close"
          data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
