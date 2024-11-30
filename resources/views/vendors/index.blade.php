@extends('layouts.vendors.app')

@push('style')
<style>
  .event-item {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    color: white;
  }

  .event-birthday {
    background-color: #ff5733;
  }

  .event-default {
    background-color: #5bc0de;
  }

  .event-special {
    background-color: #f7dc6f;
    color: #000;
  }

  .dropdown-dashboard {
    position: relative;
    display: inline-block;
  }

  .dropdown-dashboard-button {
    background-color: #009688;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
  }

  .dropdown-dashboard-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 999;
  }

  .dropdown-dashboard-content div {
    color: black;
    padding: 12px 16px;
    cursor: pointer;
  }

  .dropdown-dashboard-content div:hover {
    background-color: #f1f1f1;
  }

  .dropdown-dashboard:hover .dropdown-dashboard-content {
    display: block;
  }

  .dropdown-dashboard:hover .dropdown-dashboard-button {
    background-color: #00796b;
  }

  .nav-tabs {
    background-color: #ffffff;
    width: 100%;
  }

  .nav-tabs .nav-link {
    width: 100%;
    color: #dee2e6;
    background-color: #757575;
    border: 1px solid #dee2e6;
    padding: 8px 12px;
    font-size: 14px;
  }

  .nav-tabs .nav-link.active {
    color: #fff;
    background-color:
      #00796b;
    border-color: #00796b;
  }

  .nav-tabs .nav-link:hover {
    background-color: #00796b !important;
  }

  .tab-content {
    padding: 10px;
  }

  .tab-pane ul {
    list-style: none;
    padding: 0;
  }

  .tab-pane li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
  }

  .tab-pane li span {
    font-weight: bold;
    margin-right: 5px;
    display: inline-block;
    width: 20px;
    text-align: center;
  }
</style>
@endpush

@section('content')
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex">
          <div>
            <div class="mb-0 fw-semibold text-dark">Account Balance</div>
            <h3 class="mt-1 mb-1 text-dark fw-semibold">RM {{ $balances }}</h3>
            <div class="text-muted fs-12 mt-2">
              <span class="fw-bold fs-12">2</span> Customer Paid
            </div>
          </div>
          <i class="fa-solid fa-comments-dollar ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i>
          {{-- <i class="fe fe-calendar ms-auto fs-5 my-auto bg-primary-transparent p-3 br-7 text-primary"></i> --}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex">
          <div>
            <div class="mb-0 fw-semibold text-dark">Total Orders</div>
            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ count($orders) }}</h3>
            <div class="text-muted fs-12 mt-2">
              <span class="fw-bold fs-12">{{ count($orders->where("created_at", ">=", date("Y-m-d",
                strtotime("-7day")))) }}</span> New Orders
            </div>
          </div>
          <i
            class="fa-solid fa-cart-flatbed-suitcase ms-auto fs-5 my-auto bg-secondary-transparent p-3 br-7 text-secondary"></i>
          {{-- <i class="fe fe-calendar ms-auto fs-5 my-auto bg-secondary-transparent p-3 br-7 text-secondary"></i> --}}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex">
          <div>
            <div class="mb-0 fw-semibold text-dark">No. Of Product / Services</div>
            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ count($products) }}</h3>
            <div class="text-muted fs-12 mt-2">
              <span class="fw-bold fs-12">{{ count($products->where("created_at", ">=", date("Y-m-d",
                strtotime("-7day")))) }}</span> News List
            </div>
          </div>
          <i class="fa-solid fa-dolly ms-auto fs-5 my-auto bg-info-transparent p-3 br-7 text-secondary"></i>
          {{-- <i class="fe fe-user ms-auto fs-5 my-auto bg-info-transparent p-3 br-7 text-secondary"></i> --}}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex">
          <div>
            <div class="mb-0 fw-semibold text-dark">Total Customer</div>
            <h3 class="mt-1 mb-1 text-dark fw-semibold">{{ count($customers) }}</h3>
            <div class="text-muted fs-12 mt-2">
              {{-- <i class="fe fe-arrow-up-right text-success me-1"></i> --}}
              <span class="fw-bold fs-12">{{ count($customers->where("created_at", ">=", date("Y-m-d",
                strtotime("-7day")))) }}</span> New Customer
            </div>
          </div>
          <i class="fa-solid fa-users ms-auto fs-5 my-auto bg-warning-transparent p-3 br-7 text-warning"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">

    <div class="card">
      <div class="card-header">
        <h5>To-Do List</h5>
      </div>
      <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation"> <button class="nav-link active" id="today-tab" data-bs-toggle="tab"
              data-bs-target="#today" type="button" role="tab" aria-controls="today" aria-selected="true">Today</button>
          </li>
          <li class="nav-item" role="presentation"> <button class="nav-link" id="this-week-tab" data-bs-toggle="tab"
              data-bs-target="#this-week" type="button" role="tab" aria-controls="this-week" aria-selected="false">This
              Week</button> </li>
          <li class="nav-item" role="presentation"> <button class="nav-link" id="upcoming-tab" data-bs-toggle="tab"
              data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming"
              aria-selected="false">Upcoming</button> </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
            <!-- Konten untuk tab Today -->
            <ul>
              <li><span class="text-success">✔</span> Confirm Availability</li>
              <li><span class="text-warning">...</span> Reply Inquiries</li>
              <li><span class="text-danger">!</span> Update Services</li>
              <li><span class="text-success">✔</span> Send Invoice</li>
              <li><span class="text-danger">!</span> Request Feedback</li>
            </ul>
          </div>
          <div class="tab-pane fade" id="this-week" role="tabpanel" aria-labelledby="this-week-tab">
            <!-- Konten untuk tab This Week -->
            <p>This Week.</p>
          </div>
          <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
            <!-- Konten untuk tab Upcoming -->
            <p>Upcoming.</p>
          </div>
        </div>

      </div>
    </div>

  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">

        <div class="col-md-8">
          <h5>Sales Revenue</h5>
        </div>
        <div class="col-md-4">
          <div class="dropdown-dashboard"> <button class="dropdown-dashboard-button">Sort by: <span
                id="graphTypeFilter">Monthly</span> ▼</button>
            <div class="dropdown-dashboard-content">
              <div onclick="Dashboard.initGraphs('Daily')">Daily</div>
              <div onclick="Dashboard.initGraphs('Monthly')">Monthly</div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">

        <canvas id="chartGraphSummary"></canvas>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">

    <div class="card">
      <div class="card-header">
        <h5>My Events List</h5>
      </div>
      <div class="card-body" id="cardListMyEvents">
      </div>
    </div>

  </div>
  <div class="col-md-8">

    <div class="card">
      <div class="card-body">

        <div id="calendarEventVendor"></div>

      </div>
    </div>

  </div>
</div>
@endsection

@push('script')
<script src="{{asset('build/assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
<script src="{{ asset('assets/js/apps/vendor-dashboard.js') }}"></script>
@endpush
