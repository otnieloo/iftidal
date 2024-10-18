<?php

namespace App\Http\Livewire\Apps\Users\Orders\Setup;

use App\Models\Order;
use App\Models\OrderVendorCategory;
use App\Models\VendorCategory;
use Livewire\Component;

class Step2 extends Component
{
  public $category_ids = [];
  public $order_id;

  protected $listeners = ["step2_set_order", "save"];

  public function save($category_ids)
  {
    $this->category_ids = $category_ids;

    OrderVendorCategory::query()
    ->where("order_id", $this->order_id)
    ->delete();

    foreach ($category_ids as $id) {
      OrderVendorCategory::create([
        "order_id" => $this->order_id,
        "vendor_category_id" => $id
      ]);
    }

    $this->emit("step2-success");
  }

  public function step2_set_order($order_id)
  {
    $this->order_id = $order_id;
    $categories = OrderVendorCategory::query()->where("order_id", $order_id)->get();

    if (count($categories)) {
      foreach ($categories as $category) {
        $this->category_ids[] = $category->vendor_category_id;
      }
    }
    // dd($this->category_ids);
    $this->emit("step2-draw-category");
  }

  public function render()
  {
    $data = [
      "categories" => VendorCategory::query()->with(["subs"])->whereNull("parent_category_id")->get()
    ];

    return view('livewire.apps.users.orders.setup.step2', $data);
  }
}
