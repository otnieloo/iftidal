<?php

namespace App\Http\Livewire\Apps\Admin\Orders;

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
        "location",
        "payment_status",
        "status"
      ])
      ->where("order_status_id", ">", 1)
      ->orderBy("id", "DESC")
      ->paginate(20);
  }

	public function render()
	{
		return view('livewire.apps.admin.orders.index');
	}
}
