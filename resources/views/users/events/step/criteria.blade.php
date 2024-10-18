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
                <ul class="treeview ">
                  <li>
                    <a href="javascript:void(0);">
                      Food
                    </a>
                    <ul>
                      <li>
                        <div class="d-flex align-items-center">
                          <input type="checkbox" class="criteria-control" value="terms" name="terms">
                          <label for="" style="margin-top:10px;">Makanan
                            Ringan</label>
                        </div>
                      </li>

                      <li>
                        <div class="d-flex align-items-center">
                          <input type="checkbox" class="criteria-control" value="terms" name="terms">
                          <label for="" style="margin-top:10px;">Makanan
                            Basah</label>
                        </div>
                      </li>

                    </ul>
                  </li>

                </ul>
              </div>
              <!-- /col -->

              <!-- col -->
              <div class="col-lg-4">
                <ul class="treeview ">
                  <li>
                    <a href="javascript:void(0);">
                      Drink
                    </a>
                    <ul>
                      <li>
                        <div class="d-flex align-items-center">
                          <input type="checkbox" class="criteria-control" value="terms" name="terms">
                          <label for="" style="margin-top:10px;">Soda</label>
                        </div>
                      </li>

                      <li>
                        <div class="d-flex align-items-center">
                          <input type="checkbox" class="criteria-control" value="terms" name="terms">
                          <label for="" style="margin-top:10px;">Air Putih</label>
                        </div>
                      </li>

                    </ul>
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