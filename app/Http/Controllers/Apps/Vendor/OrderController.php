<?php

namespace App\Http\Controllers\Apps\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{





  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, OrderService $orderService)
  {


    return $this->view_admin("vendors.orders.index", __("List Order"), [], TRUE);
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

    $vendorId = auth()->user()->id;

    $data = [
      "order" => $order->load(['user', 'location', 'type', 'order_products' => function ($q) use ($vendorId) {
        $q->with('product')->where('vendor_id', $vendorId);
      }]),
    ];


    return $this->view_admin("vendors.orders.show", __("Detail Order"), $data);
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
}
