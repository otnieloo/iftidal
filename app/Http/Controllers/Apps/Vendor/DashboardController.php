<?php

namespace App\Http\Controllers\Apps\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    $data = [
      "balances" => OrderProduct::query()->where("vendor_id", auth()->user()->vendor_id)->sum("grand_total"),
      "orders" => OrderProduct::query()->where("vendor_id", auth()->user()->vendor_id)->orderBy("order_id")->get(),
      "products" => Product::query()->where("vendor_id", auth()->user()->vendor_id)->get(),
      "customers" => OrderProduct::query()->where("vendor_id", auth()->user()->vendor_id)->orderBy("user_id")->get(),
    ];

    return $this->view_admin("vendors.index", "Dashboard", $data, TRUE);
  }
}
