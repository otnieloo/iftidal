@extends('layouts.vendors.app')

@section('content')


<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
  <ol class="breadcrumb mb-sm-0 mb-3">
    <!-- breadcrumb -->
    <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
    <li class="breadcrumb-item"><a href="{{ route('vendor.orders.index') }}">Order</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $order->order_number }}</li>
  </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="card">
  <div class="card-header align-items-center justify-content-between">
    <h6>{{ $order->order_number }}</h6>
    <button class="btn btn-secondary">Chat</button>
  </div>
  <div class="card-body">

    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <table class="table vendor-order-detail">
          <tr>
            <th>{{ __('Customer Name') }}</th>
            <td>: {{ $order->user->name }}</td>
          </tr>
          <tr>
            <th>{{ __('Date Joined') }}</th>
            <td>: {{ date('j F Y', strtotime($order->user->created_at)) }}</td>
          </tr>
          <tr>
            <th>{{ __('Order Date') }}</th>
            <td>: {{ date('j F Y', strtotime($order->created_at)) }}</td>
          </tr>
          <tr>
            <th>{{ __('Type of Event') }}</th>
            <td>: {{ $order->type->event_type }}</td>
          </tr>

          <tr>
            <th>{{ __('Date of Event') }}</th>
            <td>: {{ date('j F Y', strtotime($order->event_date)) }}</td>
          </tr>

          <tr>
            <th>{{ __('Event Period') }}</th>
            <td>: {{ $order->event_start_time . ' - ' . $order->event_end_time }}</td>
          </tr>

          <tr>
            <th>{{ __('Event Location') }}</th>
            <td>: {{ $order->location->location }}</td>
          </tr>

          <tr>
            <th>{{ __('Est. Number of Guest') }}</th>
            <td>: {{ $order->event_guest_count }}</td>
          </tr>

        </table>
      </div>

    </div>

  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5>{{ __("Product & Service") }}</h5>
  </div>
  <div class="card-body table-responsive">

    <table class="table table-hover">
      <thead>
        <tr>
          <th>{{ __("No.") }}</th>
          <th>{{ __("Order (s)") }}</th>
          <th>{{ __("Variation") }}</th>
          <th>{{ __("Unit Price") }}</th>
          <th>{{ __("Qty") }}</th>
          <th>{{ __("Total Price") }}</th>
          <th>{{ __("SKU") }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($order->order_products as $order_product)

        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>
            <div>
              <div class="d-flex flex-wrap gap-3 align-items-center">
                <img src="{{ $order_product->product->product_image }}" alt="Product Image" style="width:40px;height:50px;object-fit: cover;">
                <div>{{ $order_product->product_name }}</div>
              </div>

            </div>
          </td>

          <td>{{ $order_product->variation }}</td>
          <td>RM. {{ number_format($order_product->product_sell_price) }}</td>
          <td>{{ $order_product->qty }}</td>
          <td>RM. {{ number_format($order_product->grand_total) }}</td>
          <td>{{ $order_product->product->product_sku }}</td>

          {{-- <td>RM. {{ number_format($item->grand_total) }}</td> --}}
        </tr>
        @endforeach


        <tr>
          <td colspan="4" class="text-end">Total ({{ count($order->order_products) }} Products)</td>
          <td colspan="2" class="text-center fw-bold">RM. {{ number_format($order->grand_total) }}</td>
        </tr>


        <tr>
          <td colspan="4" class="text-end">Discount / Promo</td>
          <td colspan="2" class="text-center text-muted">RM. {{ number_format($order->total_discount) }}</td>
        </tr>

        <tr>
          <td colspan="4" class="text-end fw-bold">Total Order Value</td>
          <td colspan="2" class="text-center fw-bold">
            RM. {{ number_format($order->grand_total - $order->total_discount)
            }}</td>
        </tr>



      </tbody>
    </table>

    <div class="border-top-dashed "></div>

    <div class="text-center py-5">

      @if ($order_vendor->order_vendor_status_id == 1)
        <div class="text-muted">Reminder: Kindly double check before commiting order.</div>

        <div class="d-flex justify-content-center my-3">
          <input type="checkbox" name="termscondition">
          <div>Aggree the <a href="#">terms and policy</a></div>
        </div>

        <form class="d-inline" action="{{ route('vendor.orders.reject', $order->id) }}" method="POST" id="formRejectOrder" with-submit-crud>
          @csrf
          @method("PUT")

          <button class="btn btn-gray" type="button" onclick="CORE.promptForm('formRejectOrder', 'Are you sure reject this order?')">Reject</button>
        </form>

        <form class="d-inline" action="{{ route('vendor.orders.commit', $order->id) }}" method="POST" id="formCommitOrder" with-submit-crud>
          @csrf
          @method("PUT")

          <button class="btn btn-secondary" type="button" onclick="CORE.promptForm('formCommitOrder', 'Are you sure commit this order?')">Commit Order</button>
        </form>

        {{-- <button class="btn btn-primary">Print Order</button> --}}
      @endif

      @if ($order_vendor->order_vendor_status_id == 2)

        <div class="row">
          <div class="col-md-4">
            <h5>Order Status</h5>
          </div>
          <div class="col-md-8">
            <div class="order-status d-flex justify-content-end">
              <button class="btn btn-secondary btn-status">Assign Staff</button>
              <button class="btn btn-gray btn-status">Share</button>
              <button class="btn btn-gray btn-status">Dispute</button>
              <button class="btn btn-gray btn-status">Cancel Order</button>
            </div>
          </div>
        </div>

        <!-- Timeline -->
        <div class="timeline">
          <!-- Review and Rating -->
          <div class="timeline-item">
            <div class="timeline-icon">
              <i class="fas fa-star"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Review and Rating</div>
              <div class="timeline-subtitle">Write Feedback about Event & Customer</div>
            </div>
          </div>

          <!-- Job Completed -->
          <div class="timeline-item">
            <div class="timeline-icon">
              <i class="fas fa-check"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Job Completed</div>
              <div class="timeline-subtitle">Requested for Balance Payment</div>
            </div>
          </div>

          <!-- Serving -->
          <div class="timeline-item">
            <div class="timeline-icon">
              <i class="fas fa-utensils"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Serving</div>
              <div class="timeline-subtitle">Activities</div>
            </div>
          </div>

          <!-- Delivery -->
          <div class="timeline-item">
            <div class="timeline-icon">
              <i class="fas fa-truck"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Delivery</div>
              <div class="timeline-subtitle">Event Location & Summary Address</div>
            </div>
          </div>

          <!-- Assigned Staff -->
          <div class="timeline-item">
            <div class="timeline-icon">
              <i class="fas fa-user"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Assigned Staff</div>
              <div class="timeline-subtitle">Staff Name & Delivery</div>
            </div>
          </div>

          <!-- Customer Confirmed -->
          <div class="timeline-item">
            <div class="timeline-icon active">
              <i class="fas fa-check"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Customer Confirmed</div>
              <div class="timeline-subtitle">30% Payment Received</div>
            </div>
          </div>

          <!-- Order Ready -->
          <div class="timeline-item">
            <div class="timeline-icon completed">
              <i class="fas fa-box"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Order Ready to Dispatch</div>
              <div class="timeline-subtitle">Notify Customer</div>
            </div>
          </div>

          <!-- Preparing Order -->
          <div class="timeline-item">
            <div class="timeline-icon completed">
              <i class="fas fa-blender"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Preparing Order</div>
              <div class="timeline-subtitle">Product ABC 123, Product DEFG-4567</div>
              <div class="timeline-date">4 days ago</div>
            </div>
          </div>

          <!-- Assigned Staff -->
          <div class="timeline-item">
            <div class="timeline-icon completed">
              <i class="fas fa-user"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Assigned Staff</div>
              <div class="timeline-subtitle">Staff Name & Designation</div>
              <div class="timeline-date">4 days ago</div>
            </div>
          </div>

          <!-- Chat -->
          <div class="timeline-item">
            <div class="timeline-icon completed">
              <i class="fas fa-comments"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Chat with customer</div>
              <div class="timeline-subtitle">Share instruction and order confirmation</div>
              <div class="timeline-date">4 days ago</div>
            </div>
          </div>

          <!-- Received Order -->
          <div class="timeline-item">
            <div class="timeline-icon completed">
              <i class="fas fa-file-invoice"></i>
            </div>
            <div class="timeline-content">
              <div class="timeline-title">Received Order</div>
              <div class="timeline-subtitle">Customer paid 10% Deposit</div>
              <div class="timeline-date">5 days ago</div>
            </div>
          </div>
        </div>

      @endif

    </div>


  </div>
</div>

@endsection
