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
          <div class="card-body">
            <div class="row">
              <!-- col -->
              <div class="col-lg-4">

                <h5 class="fw-bold">Category</h5>
                <ul class="list-group">
                  @foreach ($categories as $item)

                  <li onclick="Order.changeCategory('{{ $loop->index }}')"
                    class="list-group-item list-group-category {{ $loop->index == 0 ? 'active' : '' }} d-flex align-items-center justify-content-between"
                    aria-current="true">
                    <div>{{ $item->vendor_category }}</div>
                    <span class="badge bg-success">{{ count($item->subs) }}</span>
                  </li>

                  @endforeach

                </ul>
              </div>
              <!-- /col -->

              <!-- col -->
              <div class="col-lg-8">
                <h5 class="fw-bold">Sub Category</h5>

                @foreach ($categories as $item)

                <ul class="list-group list-sub-categories {{ $loop->index != 0 ? 'd-none' : '' }}">

                  @foreach ($item->subs as $sub)

                  <li class="list-group-item d-flex align-items-center">
                    <input type="checkbox" class="input-checkbox-subcategories" value="{{ $sub->id }}">
                    <div>{{ $sub->vendor_category }}</div>
                  </li>

                  @endforeach

                </ul>

                @endforeach

              </div>
              <!-- /col -->


              <div class="col-lg-12 text-center wizzard-action">
                Reminder : Kindly double check before continue...
              </div>

              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-secondary prev me-3">Back</button>
                <button type="button" class="btn btn-warning" onclick="Order.storeStep2()">Next</button>
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