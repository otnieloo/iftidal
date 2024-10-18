@extends('layouts.vendors.app')

@section('content')
    
  <div class="card">
    <div class="card-body">

      <div class="row">
        <div class="col-md-6">
          <table class="table">
            <tr>
              <th>{{ __('Customer') }}</th>
              <td>: {{ $order->user->name }}</td>
            </tr>
            <tr>
              <th>{{ __('Event Type') }}</th>
              <td>: {{ $order->type->event_type }}</td>
            </tr>
            <tr>
              <th>{{ __('Event Name') }}</th>
              <td>: {{ $order->event_name }}</td>
            </tr>
            <tr>
              <th>{{ __('Location') }}</th>
              <td>: {{ $order->location->location }}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          
          <table class="table">
            <tr>
              <th>{{ __('Event Date') }}</th>
              <td>: {{ date('j F Y', strtotime($order->event_date)) }}</td>
            </tr>
            <tr>
              <th>{{ __('Event Time') }}</th>
              <td>: {{ date("H:i", strtotime("$order->event_date $order->event_start_time")) }} - {{ date("H:i", strtotime("$order->event_date $order->event_end_time")) }}</td>
            </tr>
            <tr>
              <th>{{  __("Budget") }}</th>
              <td>: 
                RM. {{ number_format($order->event_start_budget) }} - RM. {{ number_format($order->event_end_budget) }}
              </td>
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
            <th>{{ __("Product") }}</th>
            <th>{{ __("Price Unit") }}</th>
            <th>{{ __("Qty") }}</th>
            <th>{{ __("Discount") }}</th>
            <th>{{ __("Grand Total") }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order_products as $item)
            <tr>
              <td>{{ $item->product_name }}</td>
              <td>RM. {{ number_format($item->product_sell_price) }}</td>
              <td>{{ number_format($item->qty) }}</td>
              <td>RM. {{ number_format($item->product_discount_price) }}</td>
              <td>RM. {{ number_format($item->grand_total) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

@endsection