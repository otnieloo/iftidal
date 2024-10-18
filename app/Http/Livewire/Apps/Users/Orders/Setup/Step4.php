<?php

namespace App\Http\Livewire\Apps\Users\Orders\Setup;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderVendorCategory;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorCategory;
use Livewire\Component;

class Step4 extends Component
{
  public $order_id;
  public $categories = [];

  public $vendor;
  public $products = [];
  public $product_details = [];
  public $services = [];

  public $product;

  protected $listeners = ["step4_set_order", "show_vendor", "show_product"];

  public function step4_set_order($order_id)
  {
    $this->order_id = $order_id;
    $order_vendor_category_id = OrderVendorCategory::query()
    ->where("order_id", $order_id)
    ->get()
    ->map(fn($order) => $order->vendor_category_id)
    ->toArray();

    $this->categories = VendorCategory::query()
    ->with([
      "vendors",
      "parent_category"
    ])
    ->whereIn("id", $order_vendor_category_id)
    ->get();

    // dd($this->categories[0]->parent_category);
  }

  public function show_product($id)
  {
    $this->product = Product::query()->with(["product_images"])->where("id", $id)->first();
    $this->emit("step4-success-get-product");
  }

  public function show_vendor($id)
  {
    $this->vendor = Vendor::query()
    ->with([
      "category",
      "category.parent_category",
    ])
    ->where("id", $id)
    ->first();

    // $order_products = OrderProduct::query()
    // ->where("order_id", $this->order_id)
    // ->get();

    $this->products = Product::query()
    ->with(["product_images", "product_package"])
    ->where("vendor_id", $this->vendor->id)
    ->where("product_service", 0)
    ->get();

    $this->services = Product::query()
    ->with(["product_images"])
    ->where("vendor_id", $this->vendor->id)
    ->where("product_service", 1)
    ->get();

    $detail_product = $this->products->map(function ($product) {
      return [
        "id" => $product->id,
        "price" => $product->product_sell_price,
        "stok" => $product->product_stock,
        "package" => $product->product_package
      ];
    });
    $detail_service = $this->services->map(function ($product) {
      return [
        "id" => $product->id,
        "price" => $product->product_sell_price,
        "stok" => $product->product_unit,
        "package" => $product->product_package
      ];
    });

    $this->product_details = array_merge($detail_product->toArray(), $detail_service->toArray());
    $this->emit("step4-success-get-vendor");
  }

  public function render()
  {
    return view('livewire.apps.users.orders.setup.step4');
  }
}
