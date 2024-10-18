<div>

  <div class="card">
    <div class="card-body table-responsive">

      <table class="table table-hover">
        <thead>
          <tr>
            <th>{{ __("Customer") }}</th>
            <th>{{ __("Event Name") }}</th>
            <th>{{ __("Event Type") }}</th>
            <th>{{ __("Event Date") }}</th>
            <th>{{ __("Time") }}</th>
            <th>{{ __("Location") }}</th>
            <th>{{ __("Order Status") }}</th>
            <th>{{ __("Payment Status") }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $item)
            <tr>
              <td>{{ $item->user->name }}</td>
              <td>{{ $item->event_name }}</td>
              <td>{{ $item->type->event_type }}</td>
              <td>{{ date('j F Y', strtotime($item->event_date)) }}</td>
              <td>{{ date("H:i", strtotime("$item->event_date $item->event_start_time")) }} - {{ date("H:i", strtotime("$item->event_date $item->event_end_time")) }}</td>
              <td>{{ $item->location->location }}</td>
              <td>{{ $item->status->order_status }}</td>
              <td>{{ $item->payment_status->payment_status }}</td>
              <td>
                <a href="{{ route('app.orders.show', $item->id) }}">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">{{ __("No Orders Found") }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>

    </div>
  </div>

</div>
