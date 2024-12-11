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
    <div class="row">
      <div class="col-lg-2 col-md-12">
        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
          <li style="max-width: 110%;" class="nav-item text-center">
            <a class="nav-link active w-100" id="home-tab4" data-bs-toggle="tab" href="#home4" role="tab"
              aria-controls="home" aria-selected="true">Accessories</a>
          </li>
          <li style="max-width: 110%;" class="nav-item">
            <a class="nav-link w-100" id="profile-tab4" data-bs-toggle="tab" href="#profile4" role="tab"
              aria-controls="profile" aria-selected="false">Attire</a>
          </li>
          <li style="max-width: 110%;" class="nav-item">
            <a class="nav-link w-100" id="contact-tab4" data-bs-toggle="tab" href="#contact4" role="tab"
              aria-controls="contact" aria-selected="false">Beaty</a>
          </li>
        </ul>
      </div>
      <div class="col-lg-10 col-md-12">
        <div class="tab-content border p-3" id="myTab3Content">
          <div class="tab-pane fade show active p-0" id="home4" role="tabpanel" aria-labelledby="home-tab4">



            @for($i = 0; $i < 10; $i++) <div class="row vendor-search my-3">
              <div class="col-lg-6 col-md-12 d-flex" style="gap:1rem;">

                <span class="avatar avatar-xxl brround cover-image"
                  data-bs-image-src="https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg"
                  style="background: url('https://laravelui.spruko.com/sparic/build/assets/images/users/male/24.jpg') center center;">
                  <span class="avatar-icons bg-blue"><i class="fe fe-check fs-12"></i></span>
                </span>

                <div>
                  <h3 class="fw-bold" style="margin-bottom: 0;">Vendor Name</h3>
                  <div class="text-muted">Vendor Category : Vendor Sub Category</div>
                  <div class="text-muted">Location: English</div>
                </div>
              </div>

              <div class="col-lg-6 col-md-12 d-flex justify-content-between">
                <div class="text-center">
                  <i class="fe fe-check"></i>
                  <div class="text-muted">Listing</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>

                <div class="text-center">
                  <i class="fe fe-star"></i>
                  <div class="text-muted">Level</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>

                <div class="text-center">
                  <i class="fe fe-star"></i>
                  <div class="text-muted">Ratings</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>

                <div class="text-center">
                  <i class="fe fe-star"></i>
                  <div class="text-muted">Matched</div>
                  <div class="text-secondary fs-4 fw-bold">25</div>
                </div>
              </div>

          </div>
          @endfor


        </div>
        <div class="tab-pane fade p-0" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
          Tab 2
        </div>
        <div class="tab-pane fade p-0" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
          Tab 3
        </div>
      </div>
    </div>
  </div>


  <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-secondary prev me-3">Back</button>
    <button type="button" class="btn btn-warning next">Next</button>
  </div>
</div>
</div>



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