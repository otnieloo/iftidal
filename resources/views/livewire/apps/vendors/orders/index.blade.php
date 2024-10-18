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
              <td>
                <a href="{{ route('vendor.orders.show', $item->id) }}">
                  <i class="fa-solid fa-eye"></i>
                </a>
                {{-- <a href="{{ route('app.orders.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a> --}}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center">{{ __("No Orders Found") }}</td>
            </tr>
          @endforelse
        </tbody>
      </table>

    </div>
  </div>

</div>
