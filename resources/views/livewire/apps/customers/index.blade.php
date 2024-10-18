<div>

  <a href="{{ route('app.customers.create') }}" class="btn btn-success btn-sm">{{ __('Add Customer') }}</a>

  <div class="card">
    <div class="card-body">

      <table class="table">
        <thead>
          <tr>
            <th>{{ __("Name") }}</th>
            <th>{{ __("Email") }}</th>
            <th>{{ __("Status") }}</th>
            <th>{{ __("Verification") }}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($customers as $item)
            <tr>
              <td>{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->status->user_status }}</td>
              <td>{{ $item->email_verified_at ? __("Verified") : __("Unverified") }}</td>
              <td>
                <a href="{{ route('app.customers.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-3">
        {!! $customers->links() !!}
      </div>

    </div>
  </div>

</div>
