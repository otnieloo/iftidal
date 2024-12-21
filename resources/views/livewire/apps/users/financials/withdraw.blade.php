<div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Date</th>
        <th>Number</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($withdraws as $item)
        <tr>
          <td>{{ date('m/d/Y', strtotime($item->withdraw_time)) }}</td>
          <td>{{ $item->withdraw_number }}</td>
          <td>RM. {{ $item->withdraw_amount }}</td>
          <td>
            <span class="text-{{ $item->status->color }}">{{ $item->status->user_withdraw_status }}</span>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center">No Data</td>
        </tr>
      @endforelse
    </tbody>
  </table>

</div>
