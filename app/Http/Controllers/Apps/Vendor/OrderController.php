<?php

namespace App\Http\Controllers\Apps\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderVendor;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  private OrderService $service;

  public function __construct()
  {
    $this->service = new OrderService();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      "count_orders" => OrderProduct::query()
      ->where("vendor_id", auth()->user()->id)
      ->count(),

      "count_new_orders" => OrderProduct::query()
      ->where("vendor_id", auth()->user()->id)
      ->whereDate("created_at", ">=", date("Y-m-d", strtotime("-3 days")))
      ->count(),

      "orders_new" => OrderProduct::query()
        ->select([
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
        ->where("order_products.vendor_id", auth()->user()->vendor_id)
        ->whereDate("order_products.created_at", date("Y-m-d", strtotime("-3 days")))
        ->orderBy("order_products.created_at", "desc")
        ->get(),
    ];
    return $this->view("vendors.orders.index", __("List Order"), $data, TRUE);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   */
  public function show(Order $order)
  {

    $vendorId = auth()->user()->vendor_id;

    $data = [
      "order" => $order->load([
        'user',
        'location',
        'type',
        'order_products' => function ($q) use ($vendorId) {
          $q->with('product')->where('vendor_id', $vendorId);
        }
      ]),
      "order_vendor" => OrderVendor::query()->where("order_id", $order->id)->where("vendor_id", $vendorId)->first(),
    ];


    return $this->view("vendors.orders.show", __("Detail Order"), $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * Reject order by vendor
   *
   * @param \App\Models\Order $order
   * @return mixed|\Illuminate\Http\JsonResponse
   */
  public function reject(Order $order)
  {
    $response = $this->service->reject_order_vendor($order);
    return response_json($response);
  }

  /**
   * Commit order by vendor
   *
   * @param \App\Models\Order $order
   * @return mixed|\Illuminate\Http\JsonResponse
   */
  public function commit(Order $order)
  {
    $response = $this->service->commit_order_vendor($order);
    return response_json($response);
  }
}
