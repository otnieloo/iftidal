<div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Date</th>
        <th>Transaction Type</th>
        <th>Description</th>
        <th>Order ID</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($transactions as $item)
        <tr>
          <td>{{ date("m/d/Y", strtotime($item->transaction_time)) }}</td>
          <td>{{ $item->type->transaction_history_type }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->transaction_number }}</td>
          <td>RM. {{ number_format($item->amount, 2) }}</td>
          <td>
            <span class="text-{{ $item->status->color }}">{{ $item->status->transaction_history_status }}</span>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">No Data</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-2">
    {!! $transactions->links() !!}
  </div>

</div>
