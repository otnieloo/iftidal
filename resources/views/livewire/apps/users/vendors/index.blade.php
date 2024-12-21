<div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th wire:click="sortBy('v.company_name')">Vendor Name</th>
        <th wire:click="sortBy('vc.vendor_category')">Category</th>
        <th wire:click="sortBy('o.event_date')">Event Date</th>
        <th wire:click="sortBy('os.order_status')">Status</th>
        <th wire:click="sortBy('pv.payment_vendor_status')">Payment</th>
        <th wire:click="sortBy('order_products.grand_total')">Order Value</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($vendors as $item)
        <tr>
          <td>{{ $item->company_name }}</td>
          <td>{{ $item->vendor_category }}</td>
          <td>{{ $item->event_date  }}</td>
          <td>{{ $item->order_status  }}</td>
          <td>
            <span class="text-{{ $item->color_pv }}">{{ $item->payment_vendor_status }}</span>
          </td>
          <td>RM. {{ number_format($item->grand_total, 2)  }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">No Data</td>
        </tr>
      @endforelse
    </tbody>
  </table>

</div>
