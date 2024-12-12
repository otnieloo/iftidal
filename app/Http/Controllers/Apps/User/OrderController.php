<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Str;


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
    return $this->view("users.orders.index", __("List Order"), [], TRUE);
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
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function show(Order $order)
  {
    $data = [
      "order" => $order->load(['user', 'location', 'type', 'order_products.product']),
    ];

    return $this->view("users.orders.show", __("Order Details"), $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function edit(Order $order)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Order $order)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Order  $order
   * @return \Illuminate\Http\Response
   */
  public function destroy(Order $order)
  {
    //
  }


  /**
   * Check if there is transaction on created exists
   *
   * @param Request $request
   */

  public function check_on_created_event(Request $request){
    $transaction = Order::with('order_vendor_category')->onCreated()->get();

    $response = create_response();
    $response->status = TRUE;
    $response->status_code = 200;
    $response->data = $transaction;
    $response->message = 'success';

    return response_json($response, 200);
  }



  /**
   * Handle step 1
   *
   * @param Request $request
   */
  public function store_step1(Request $request)
  {
    $response = $this->service->store_step1($request);
    return response_json($response);
  }

  /**
   * Handle step 1
   *
   * @param Request $request
   */
  public function store_step2(Request $request)
  {
    $response = $this->service->store_step2($request);
    return response_json($response);
  }

  /**
   * Handle step 4
   *
   * @param Request $request
   */
  public function store_step4(Request $request)
  {
    $response = $this->service->handle_step4($request);
    return response_json($response);
  }


  public function add_to_cart(Request $request){
    $response = $this->service->add_to_cart($request);

    return $response;
  }

  public function remove_from_cart(OrderProduct $orderProduct){
    $orderProduct->delete();

    $response = response_success_default("Product has been removed from cart!");
    return response_json($response);
  }


  public function show_list_order(Request $request){
      
    $response = create_response();
    
    $orders = Order::select(['id', 'user_id', 'event_type_id', 'total_price_capital', 'total_price_sell', 'total_discount', 'grand_total'])
    ->onCreated()
    ->with(['order_products' => function($q){
      $q->select(['id', 'order_id', 'vendor_id', 'product_id', 'product_name', 'qty', 'product_sell_price', 'total_sell_price', 'grand_total'])
      ->with('vendor:id,company_name', 'product:id,product_image,product_stock');
    }])->first();


    // Grouping by vendor


    $data = [];

    foreach($orders->order_products as $order){
      $vendorId = $order->vendor_id;

      $dataProduct = [
        'item_id'             => $order->id,
        'product_name'        => $order->product_name,
        'id'                  => $order->product_id,
        'qty'                 => $order->qty,
        'product_sell_price'  => $order->product_sell_price,
        'total_sell_price'    => $order->total_sell_price,
        'grand_total'         => $order->grand_total,
        'image'               => $order->product->product_image,
        'product_stock'       => $order->product->product_stock
      ];


      if(isset($data[$vendorId])){
        $data[$vendorId]['products'][] = $dataProduct;
      }else{
        $data[$vendorId] = [
          "order_product_id"    => $order->id,
          'vendor_id'           => $order->vendor_id,
          'company_name'        => $order->vendor->company_name,
          'total_price_capital' => $orders->total_price_capital,
          'total_price_sell'    => $orders->total_price_sell,
          'total_discount'      => $orders->total_discount,
          'grand_total'         => $orders->grand_total,
          'products'            => [$dataProduct]
        ];
      }
    }


    $response->status_code = 200;
    $response->status = TRUE;
    $response->message = 'found';
    $response->data = $data;

    return response()->json($response, $response->status_code);
  }


  public function checkout(Request $request){

    $response           = create_response();
    $key                = env('SECRET_INFINPAY');
    $apiKey             = env('API_KEY_INFINPAY');

    try{

      $order = Order::select('id', 'user_id', 'grand_total')->with(['user:id,email,name', 'order_products' => function($q){
        $q->select('id', 'order_id', 'product_id', 'qty')->with('product:id');
      }])->onCreated()->first();

      $item_ids = explode(",", $request->items);

      OrderProduct::query()
      ->where("order_id", $order->id)
      ->whereNotIn("id", $item_ids)
      ->update([
        "is_choice" => 0,
      ]);

      $products = OrderProduct::query()
      ->where("order_id", $order->id)
      ->where("is_choice", 1)
      ->get();
    
    
      // $merchant_reference = Str::random(8) . time() . $order->id;
      $payload = [
        'merchant_code'       => env("MERCHANT_INFINPAY"),
        "merchant_reference"  => $order->order_number,
        'amount'              => $products->sum('grand_total'),
        'currency'            => 'MYR',
        'description'         => "Transaction for transaction number $order->order_number",
        'response_url'        => url("user/events/finishpayment"),
        'payment_update_url'  => url("user/events/finishpayment"),
        'customer' => [
          'customer_name'   => $order->user->name,
          'customer_email'  => $order->user->email
        ],
        'enable_auto_capture' => "false",
        'payment_type' => [
          'card'            => 'true',
          'ewallet'         => 'true',
          'online_banking'  => 'true'
        ]
      ];
      // dd($payload);

      $order->update([
        'order_status_id' => 2
      ]);

      foreach($order->order_products as $order_product){
        $order_product->product->decrement('product_stock', $order_product->qty);
      }
  
      $jwt = JWT::encode($payload, base64_decode($key), 'HS256', $apiKey);

    }catch(Exception $e){
      return response()->json($response, 500);
    }


    $response->status       = TRUE;
    $response->status_code  = 200;
    $response->message      = 'success';
    $response->data = [
      'jwt' => $jwt
    ];

    return response()->json($response, 200);
  }


  public function finish_payment(Request $request){

    $key                = env('SECRET_INFINPAY');
    $decode = JWT::decode($request->jwt, new Key(base64_decode($key), 'HS256'));


    return view('users.redirect');
  }

}
