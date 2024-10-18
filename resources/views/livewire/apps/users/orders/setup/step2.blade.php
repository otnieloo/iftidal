<div>

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
              <input type="hidden" id="InputListCategory" value="{{ json_encode($categories) }}">
              <input type="hidden" id="InputCategoryIds" value="{{ json_encode($category_ids) }}">
              <div class="row" id="listCategoryEvent">

                {{-- @foreach ($categories as $category)

                  <div class="col-lg-4">
                    <ul class="treeview ">
                      <li>
                        <a href="javascript:void(0);">
                          {{ $category->vendor_category }}
                        </a>
                        <ul>

                          @foreach ($category->subs as $sub)

                            <li>
                              <div class="d-flex align-items-center">
                                <input type="checkbox" class="criteria-control checkbox-category" value="{{ $sub->id }}">
                                <label for="" style="margin-top:10px;">{{ $sub->vendor_category }}</label>
                              </div>
                            </li>

                          @endforeach

                        </ul>
                      </li>

                    </ul>
                  </div>

                @endforeach --}}

              </div>

              <div class="row">
                <div class="col-lg-12 text-center wizzard-action">
                  Reminder : Kindly double check before continue...
                </div>

                <div class="d-flex justify-content-center">
                  <button type="button" class="btn btn-secondary prev me-3">Back</button>
                  <button type="button" class="btn btn-warning" onclick="Order.next2()">Next</button>
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

</div>
