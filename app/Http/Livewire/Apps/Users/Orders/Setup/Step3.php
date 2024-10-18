<?php

namespace App\Http\Livewire\Apps\Users\Orders\Setup;

use App\Models\Order;
use App\Models\OrderVendorCategory;
use App\Models\VendorCategory;
use Livewire\Component;

class Step3 extends Component
{
  public $order;
  public $categories = [];

  protected $listeners = ["step3_set_order"];

  public function step3_set_order($order_id)
  {
    $this->order = Order::query()
    ->with([
      "user",
      "type",
      "location",
    ])
    ->find($order_id);

    $category_ids = OrderVendorCategory::query()
    ->where("order_id", $order_id)
    ->get()
    ->pluck("vendor_category_id")
    ->toArray();

    $this->categories = VendorCategory::query()
    ->with([
      "subs" => function($query) use ($category_ids) {
        return $query->whereIn("id", $category_ids);
      }
    ])
    ->whereHas("subs", function($query) use ($category_ids) {
      return $query->whereIn("id", $category_ids);
    })
    ->get();

    $this->emit("step3-success-get-data");
  }

  public function render()
  {
    return view('livewire.apps.users.orders.setup.step3');
  }
}
