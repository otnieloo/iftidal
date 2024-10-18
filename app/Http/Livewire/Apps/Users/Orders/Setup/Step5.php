<?php

namespace App\Http\Livewire\Apps\Users\Orders\Setup;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;

class Step5 extends Component
{
  public $order;
  public $order_products = [];
  public $product_ids = [];
  protected $listeners = ['step5_set_order', 'save_order', 'checked_all'];

  public function step5_set_order($order_id)
  {
    $this->order = Order::query()->where("id", $order_id)->first();
    $this->order_products = OrderProduct::query()
    ->select([
      "id",
      "product_id",
      "product_name",
      "qty",
      "product_sell_price",
      "total_sell_price",
      "product_discount_price",
      "grand_total",
    ])
    ->with([
      "product" => function($query) {
        return $query
        ->select(["id", "product_name", "product_service", "product_image", "product_stock", "product_slot",]);
      },
      "product.product_package",
    ])
    ->where("order_id", $order_id)
    ->get()
    ->toArray();

    // dd($this->order_products);
    $this->emit("step5-success-get-order");
  }

  public function updatedOrderProducts()
  {
    $new_products = [];

    foreach ($this->order_products as $item) {
      if ($item["product"]["product_service"] == 0) {
        if ($item["qty"] > $item["product"]["product_stock"]) {
          $item["qty"] = $item["product"]["product_stock"];
        }
      } else {
        if ($item["qty"] > $item["product"]["product_slot"]) {
          $item["qty"] = $item["product"]["product_slot"];
        }
      }

      $grand_total = $item["product_sell_price"] * $item["qty"];
      $discount = $item["product_discount_price"];
      // dd($grand_total);

      if ($item["product"]["product_package"] && $item["qty"] >= $item["product"]["product_package"]["minimum_qty"]) {
        // dd("MASOK");

        if ($item["product"]["product_package"]["package_type"] == 1) {
          $discount = $grand_total * ($item["product"]["product_package"]["value"] / 100);
          $grand_total -= $discount;
        } else if ($item["product"]["product_package"]["package_type"] == 2) {
          $discount = $item["product"]["product_package"]["value"];
          $grand_total -= $discount;
        } else {
          $sell_after = $item["product"]["product_package"]["value"];

          $discount = ($item["product_sell_price"] - $sell_after) * $item["qty"];
          $grand_total = $sell_after * $item["qty"];
        }
      }

      $item["total_sell_price"] = $item["product_sell_price"] * $item["qty"];
      $item["product_discount_price"] = $discount;
      $item["grand_total"] = $grand_total;

      OrderProduct::query()
      ->where("id", $item["id"])
      ->update([
        "qty" => $item["qty"],
        "total_sell_price" => $item["total_sell_price"],
        "product_discount_price" => $item["product_discount_price"],
        "grand_total" => $item["grand_total"],
      ]);

      $new_products[] = $item;
    }

    $this->order_products = $new_products;
    // dd($this->order_products);
  }

  public function save_order()
  {
    if (count($this->product_ids)) {
      OrderProduct::query()
      ->whereNotIn("id", $this->product_ids)
      ->delete();

      return $this->emit("step5-success-checkout");
    }

    return $this->emit("step5-fails-checkout", __("Please select product!"));
  }

  public function checked_all($checked = FALSE)
  {
    if ($checked) {
      $this->product_ids = collect($this->order_products)->pluck("id")->toArray();
    } else {
      $this->product_ids = [];
    }
  }

  public function render()
  {
    return view('livewire.apps.users.orders.setup.step5');
  }
}
