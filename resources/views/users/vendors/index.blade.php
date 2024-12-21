@extends('layouts.users.app')

@push('style')
  <style>
    .nav-tabs {
      border-bottom: 1px solid #ddd; /* Bottom border */
      background-color: #f0f0f0; /* Parent background */
      padding: 5px; /* Padding untuk parent */
      border-radius: 5px; /* Rounded corners */
    }
    .nav-tabs .nav-link {
      background-color: transparent; /* Transparent default */
      color: #333; /* Default text color */
      border: none; /* No border default */
      margin: 0 5px; /* Margin antar tab */
      transition: color 0.2s ease; /* Smooth hover effect */
    }
    .nav-tabs .nav-link.active {
      background-color: #fff; /* White active tab */
      border: 1px solid #ddd; /* Border untuk tab aktif */
      border-radius: 5px; /* Rounded corners untuk active */
      padding: 8px 15px; /* Padding untuk active */
      margin-top: -5px; /* Mengangkat tab active */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow untuk efek mengambang */
      color: #333 !important;
    }

    .nav-tabs .nav-link:hover {
      background-color: #fff !important; /* White active tab */
      border: 1px solid #ddd !important; /* Border untuk tab aktif */
      color: #333 !important; /* Hover text color sama kayak tab active */
    }

    .nav-tabs {
      border-bottom: 1px solid #ddd;
      /* Bottom border */
    }

    /* Search Input */
    .form-control {
      border: 1px solid #ddd;
      /* Border untuk input */
    }

    .btn-search {
      background-color: #fff;
      /* Background tombol search */
      border: 1px solid #ddd;
      /* Border tombol */
      color: #333;
      /* Warna icon */
    }

    .btn-search:hover {
      background-color: #f7f7f7;
      /* Hover effect */
    }

    /* Filter Button */
    .btn-filter {
      background-color: #20c997;
      /* Warna teal */
      color: white;
      border: none;
    }

    .btn-filter:hover {
      background-color: #1ba983;
      /* Hover effect */
    }
  </style>
@endpush

@section('content')

<div class="row align-items-center">
  <!-- Tabs Section -->
  <div class="col-md-4">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">All Vendor (s)</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="hired-tab" data-bs-toggle="tab" data-bs-target="#hired"
          type="button">Hired</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="banned-tab" data-bs-toggle="tab" data-bs-target="#banned"
          type="button">Banned</button>
      </li>
    </ul>
  </div>

  <!-- Search Input Section -->
  <div class="col-md-5">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for Vendor..." aria-label="Search for Vendor" id="inputKeyword">
      <button class="btn btn-outline-secondary" type="button">
        <i class="bi bi-search"></i> <!-- Bootstrap Icon for search -->
      </button>
    </div>
  </div>

  <!-- Filter Button Section -->
  <div class="col-md-3 text-end">
    <button class="btn btn-teal" style="background-color: #20c997; color: white;" onclick="CORE.showModal('modalFIlter')">
      <i class="bi bi-filter"></i> Search Filter
    </button>
  </div>
</div>

<div class="card">
  <div class="card-body">

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

        @livewire('apps.users.vendors.index')

      </div>
      <div class="tab-pane fade" id="hired" role="tabpanel" aria-labelledby="hired-tab">2</div>
      <div class="tab-pane fade" id="banned" role="tabpanel" aria-labelledby="banned-tab">3</div>
    </div>

  </div>
</div>

<div class="modal fade" id="modalFIlter">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">

        <div class="row my-3 align-items-center">
          <div class="col-md-4">Vendor Category</div>
          <div class="col-md-6">
            <select name="vendor_category_id" class="form-control input-filter-vendor">
              <option value="">Select Categories</option>
              @foreach ($vendor_categories as $item)
                <option value="{{ $item->id }}">{{ $item->vendor_category }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row my-3 align-items-center">
          <div class="col-md-4">Vendor Payment Status</div>
          <div class="col-md-6">
            <select name="payment_vendor_status_id" class="form-control input-filter-vendor">
              <option value="">Select Status</option>
              @foreach ($payment_vendor_statuses as $item)
                <option value="{{ $item->id }}">{{ $item->payment_vendor_status }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row my-3 align-items-center">
          <div class="col-md-4">Order Status Status</div>
          <div class="col-md-6">
            <select name="order_status_id" class="form-control input-filter-vendor">
              <option value="">Select Status</option>
              @foreach ($order_statuses as $item)
                <option value="{{ $item->id }}">{{ $item->order_status }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row my-3 align-items-center">
          <div class="col-md-4">Event Date</div>
          <div class="col-md-6">
            <input type="date" class="form-control input-filter-vendor" name="event_date">
          </div>
        </div>

        <button class="btn btn-success" onclick="filterVendor()">Filter</button>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@endsection

@push('script')
<script src="{{ asset('assets/js/apps/user-vendor.js?v=' . time()) }}"></script>
@endpush
