<div>

  @if ($order)
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Event Summary</h3>
          </div>
          <div class="card-body">
            <div class="row gap-3">
              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end text-muted">Name Event</div>
                  <div class="col-lg-8 col-md-12">{{ $order->event_name }}</div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end text-muted">Type of Event</div>
                  <div class="col-lg-8 col-md-12">{{ $order->type->event_type }}</div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end text-muted">Date of Event</div>
                  <div class="col-lg-8 col-md-12">{{ date('j F Y', strtotime($order->event_date)) }}</div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end text-muted">Event Period</div>
                  <div class="col-lg-8 col-md-12">{{ date('H:i', strtotime("$order->event_date $order->event_start_time")) }} - {{ date('H:i', strtotime("$order->event_date $order->event_end_time")) }}</div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end text-muted">Set Location</div>
                  <div class="col-lg-8 col-md-12">{{ $order->location->location }}</div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end text-muted">Est. Number of Guest</div>
                  <div class="col-lg-8 col-md-12">{{ $order->event_guest_count }}</div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-lg-3 col-md-12 text-end ">Range Budget</div>
                  <div class="col-lg-8 col-md-12">RM {{ $order->event_start_budget }} - RM {{ $order->event_end_budget }} </div>
                </div>
              </div>

            </div>
          </div>


        </div>

        <div class="card">

          <div class="card-body">
            <div class="row">
              <div class="col-12">
                @foreach ($categories as $category)
                  <div class="row">
                    <div class="col-lg-2 col-md-12 text-end text-muted">{{ $category->vendor_category }}</div>
                    <div class="col-lg-8 col-md-12 event-summary">
                      @foreach ($category->subs as $sub)
                        <div class="badges">{{ $sub->vendor_category }}
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>


        </div>

        <div class="col-lg-12 text-center wizzard-action">
          Reminder : Kindly double check before continue...
        </div>

        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-secondary prev me-3">Back</button>
          <button type="button" class="btn btn-warning next" onclick="Order.next3()">Next</button>
        </div>



      </div>

      <div class="col-lg-4 col-md-12">
        @livewire('apps.ads.index')
        @livewire('apps.tips.index')
      </div>
    </div>
  @endif

</div>
