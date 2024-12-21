@extends('layouts.users.app')

@section('content')


<!-- PAGE HEADER -->
<div class="page-header d-sm-flex d-block">
  <ol class="breadcrumb mb-sm-0 mb-3">
    <!-- breadcrumb -->
    <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Order</li>
  </ol><!-- End breadcrumb -->

</div>
<!-- END PAGE HEADER -->

<div class="card">
  <div class="card-body">

    <div class="row">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <table class="table">
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
          <th>{{ __("Product") }}</th>
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
                <img src="{{ $order_product->product->product_image }}" alt="Product Image"
                  style="width:150px;height:120px;object-fit: cover;">
                <div>{{ $order_product->product_name }}</div>
              </div>

            </div>
          </td>

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

      <div class="text-muted">Reminder: Kindly double check before commiting order.</div>

      <div class="d-flex justify-content-center my-3">
        <input type="checkbox" name="termscondition">
        <div>Aggree the <a href="#">terms and policy</a></div>
      </div>


      <button class="btn btn-secondary">Reject</button>
      <button class="btn btn-primary">Print Order</button>
      <button class="btn criteria-selected">Commit Order</button>



    </div>


  </div>
</div>

@endsection