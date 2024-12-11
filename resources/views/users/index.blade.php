@extends('layouts.users.app')

@section('content')


<div class="row">

  <div class="col-12">

    <form action="https://uatpaymenthub.infinpay.com/api/pymt/pw/v1.1/payment" method="post">

      <input type="hidden" name="jwt"
        value="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImtpZCI6ImJkOWFiMjgyYzEwMDQ3MzY5YTA3NmQzN2UzYzFhODMxIn0.eyJtZXJjaGFudF9jb2RlIjoiNDg4MTZmMmY0MzM4NDIzNjhiOTg2MGZjMjg1M2UwMWYiLCJtZXJjaGFudF9yZWZlcmVuY2UiOiJRZmczZERmYzE3MzM4MjU4NDk3IiwiYW1vdW50IjoiMjIwMDAwLjAwIiwiY3VycmVuY3kiOiJNWVIiLCJkZXNjcmlwdGlvbiI6IlRlc3RpbmciLCJyZXNwb25zZV91cmwiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9ldmVudHMvZmluaXNocGF5bWVudCIsInBheW1lbnRfdXBkYXRlX3VybCI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2V2ZW50cy9maW5pc2hwYXltZW50IiwiY3VzdG9tZXIiOnsiY3VzdG9tZXJfbmFtZSI6ImJyeWFudCIsImN1c3RvbWVyX2VtYWlsIjoiYnJ5YW50QGdtYWlsLmNvbSJ9LCJlbmFibGVfYXV0b19jYXB0dXJlIjoiZmFsc2UiLCJwYXltZW50X3R5cGUiOnsiY2FyZCI6InRydWUiLCJld2FsbGV0IjoidHJ1ZSIsIm9ubGluZV9iYW5raW5nIjoidHJ1ZSJ9fQ.8m30lAbVCDzDsZx0XApW_9UvViF2N1RWAy8SF42hICI">

      <button type="submit">Submit</button>

    </form>


  </div>


  <div class="col-12">

    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="d-flex">
              <div>
                <div class="mb-0 fw-semibold text-dark">Total Event</div>
                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ count($event) }}</h3>
                <div class="text-muted fs-12 mt-2">
                  <span class="fw-bold fs-12 text-primary">2</span> Events Last Month
                </div>
              </div>
              <i class="fe fe-calendar ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="d-flex">
              <div>
                <div class="mb-0 fw-semibold text-dark">Upcoming Events</div>
                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ count($incoming_event) }}</h3>
                <div class="text-muted fs-12 mt-2">
                  <span class="fw-bold fs-12 text-success">1</span> days from today
                </div>
              </div>
              <i class="fe fe-calendar ms-auto fs-5 my-auto bg-secondary-transparent p-3 br-7 text-secondary"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="d-flex">
              <div>
                <div class="mb-0 fw-semibold text-dark">Total Vendors</div>
                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ count($vendor) }}</h3>
                <div class="text-muted fs-12 mt-2">
                  <span class="fw-bold fs-12 text-success">2</span> News Vendor
                </div>
              </div>
              <i class="fe fe-user ms-auto fs-5 my-auto bg-info-transparent p-3 br-7 text-secondary"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="d-flex">
              <div>
                <div class="mb-0 fw-semibold text-dark">Incoming Guest</div>
                <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ $incoming_guest }}</h3>
                <div class="text-muted fs-12 mt-2"><i class="fe fe-arrow-up-right text-success me-1"></i>
                  <span class="fw-bold fs-12 text-success">04.12%</span> Since last month
                </div>
              </div>
              <i class="fe fe-users ms-auto fs-5 my-auto bg-warning-transparent p-3 br-7 text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>


  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-5 col-xl-3">
            <div id="external-events">
              <h4 class="card-title">Event List</h4>
              @forelse ($incoming_event as $event)
              <div class="fc-h-event bg-primary rounded-1" data-class="bg-primary">
                <div class="fc-event-main">{{ $event->event_name }}</div>
              </div>
              @empty
              <div class="text-center">
                No Event
              </div>
              @endforelse
            </div>

          </div>
          <div class="col-md-7 col-xl-9">
            <div id='calendar2'></div>
            <input type="hidden" id="incoming-event" value="{{ json_encode($incoming_event) }}">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('script')

<!-- FULL CALENDAR JS -->
<script src="{{asset('build/assets/plugins/fullcalendar/moment.min.js')}}"></script>
<script src="{{asset('build/assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/js/apps/user-dashboard.js')}}"></script>


@endpush
