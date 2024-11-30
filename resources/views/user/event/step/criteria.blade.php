<!-- ROW -->
<div class="row">
  <div class="col-lg-8 col-md-12">
    <!-- START ROW -->
    <div class="row">
      <div class="col-md-12">
        <div class="card mg-b-20">
          <div class="card-header">
            <h3 class="card-title">
              Select Criteria
            </h3>
          </div>
          <div class="card-body" style="height: 60vh;overflow-y:scroll;">
            <div class="row">
              <!-- col -->
              <div class="col-lg-4">

                <h5 class="fw-bold">Category</h5>
                <ul class="list-group">
                  <li
                    class="list-group-item list-group-category active d-flex align-items-center justify-content-between"
                    aria-current="true">
                    <div>A second item</div>
                    <span class="badge bg-success">1</span>
                  </li>
                  <li class="list-group-item list-group-category d-flex align-items-center justify-content-between">
                    <div>A second item</div>
                    <span class="badge bg-success">1</span>
                  </li>

                  <li class="list-group-item list-group-category d-flex align-items-center justify-content-between">
                    <div>A second item</div>
                    <span class="badge bg-success">1</span>
                  </li>

                  <li class="list-group-item list-group-category d-flex align-items-center justify-content-between">
                    <div>A second item</div>
                    <span class="badge bg-success">1</span>
                  </li>

                  <li class="list-group-item list-group-category d-flex align-items-center justify-content-between">
                    <div>A second item</div>
                    <span class="badge bg-success">1</span>
                  </li>


                </ul>
              </div>
              <!-- /col -->

              <!-- col -->
              <div class="col-lg-4">
                <h5 class="fw-bold">Sub Category</h5>

                <ul class="list-group">
                  <li class="list-group-item d-flex align-items-center">
                    <input type="checkbox">
                    <div>Sub Category</div>
                  </li>

                  <li class="list-group-item d-flex align-items-center">
                    <input type="checkbox">
                    <div>Sub Category</div>
                  </li>

                  <li class="list-group-item d-flex align-items-center">
                    <input type="checkbox">
                    <div>Sub Category</div>
                  </li>

                  <li class="list-group-item d-flex align-items-center">
                    <input type="checkbox">
                    <div>Sub Category</div>
                  </li>

                </ul>
              </div>
              <!-- /col -->


              <div class="col-lg-12 text-center wizzard-action">
                Reminder : Kindly double check before continue...
              </div>

              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-secondary prev me-3">Back</button>
                <button type="button" class="btn btn-warning next">Next</button>
              </div>
            </div>


          </div>
        </div>

      </div>


    </div>
    <!-- END ROW -->

  </div>
  <div class="col-lg-4 col-md-12">
    @livewire('apps.ads.index')
    @livewire('apps.tips.index')
  </div>
</div>
<!-- END ROW -->