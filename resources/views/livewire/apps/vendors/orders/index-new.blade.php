<div>
  <!-- Search Bar -->
  <div class="d-flex justify-content-end mb-4">
    <div class="search-container" style="width: 25%;">
      <input type="text" class="form-control" wire:model.debounce.500ms="keyword" placeholder="Search...">
      <i class="fas fa-search search-icon"></i>
    </div>
  </div>

  <!-- Table Container -->
  <div class="table-container">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th wire:click="sortBy('orders.order_number')">Order ID <i class="ms-1">↑</i></th>
            <th wire:click="sortBy('orders.product_name')">Description <i class="ms-1">↑</i></th>
            <th wire:click="sortBy('users.name')">Customer Name <i class="ms-1">↑</i></th>
            <th wire:click="sortBy('locations.location')">Event Location <i class="ms-1">↑</i></th>
            <th wire:click='sortBy("orders.event_date")'>Event Date <i class="ms-1">↑</i></th>
            <th wire:click="sortBy('order_products.grand_total')">Order Amount (RM) <i class="ms-1">↑</i></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $item)
          <tr>
            <td>
              <a href="{{ route('vendor.orders.show', $item->order_id) }}">{{ $item->order_number }}</a>
            </td>
            <td>{{ $item->product_name }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ date('d/m/Y', strtotime($item->event_date)) }}</td>
            <td>RM {{ number_format($item->grand_total, 2, ".") }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">No orders found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Table Footer -->
    <div class="d-flex align-items-center justify-content-between p-3">
      <div class="text-secondary">
        Show
        <select wire:model="per_page" class="form-select d-inline-block w-auto mx-2">
          <option value="10">10</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        entries
      </div>

      {!! $orders->appends(["tab" => "new-orders"])->links() !!}
    </div>
  </div>
</div>
