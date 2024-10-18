<?php

namespace App\Http\Livewire\Apps\Vendors\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  private function get_order()
  {
    return Order::query()
    ->with([
      "user",
      "type",
      "location"
    ])
    ->whereHas("order_products", function($query) {
      return $query->where("vendor_id", auth()->user()->vendor_id);
    })
    ->orderBy("id", "DESC")
    ->paginate(20);
  }

  public function render()
  {
    $data = [
      "orders" => $this->get_order()
    ];

    return view('livewire.apps.vendors.orders.index', $data);
  }
}
