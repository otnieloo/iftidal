<?php

namespace App\Http\Livewire\Apps\Vendors\Orders;

use Livewire\Component;
use App\Models\OrderProduct;
use App\Traits\LivewireSort;
use Livewire\WithPagination;

class IndexNew extends Component
{
  use WithPagination, LivewireSort;
  protected $paginationTheme = 'bootstrap';

  public $per_page = 10;
  public $keyword = "";

  private function get_orders()
  {
    $Keyword = $this->keyword;

    return OrderProduct::query()
      ->select([
        "order_products.order_id",
        "order_products.id",
        "orders.order_number",
        "order_products.product_name",
        "users.name",
        "locations.location",
        "orders.event_date",
        "order_products.grand_total",
      ])
      ->join("orders", "orders.id", "=", "order_products.order_id")
      ->join("users", "users.id", "=", "orders.user_id")
      ->join("locations", "locations.id", "=", "orders.location_id")
      ->when($Keyword, function ($query) use ($Keyword) {
        return $query->where("orders.order_number", "like", "%$Keyword%")
          ->orWhere("order_products.product_name", "like", "%$Keyword%")
          ->orWhere("users.name", "like", "%$Keyword%")
          ->orWhere("locations.location", "like", "%$Keyword%");
      })
      ->where("order_products.vendor_id", auth()->user()->vendor_id)
      ->whereDate("order_products.created_at", ">=", date("Y-m-d", strtotime("-3 days")))
      ->orderBy($this->sort_column, $this->sort_direction)
      ->groupBy("order_products.order_id")
      ->paginate(perPage: $this->per_page, pageName: "page-new");
  }

  public function render()
  {
    $data = [
      "orders" => $this->get_orders()
    ];

    return view('livewire.apps.vendors.orders.index-new', $data);
  }
}
