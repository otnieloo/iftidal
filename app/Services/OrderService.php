<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderVendor;
use App\Models\OrderVendorCategory;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\TransactionHistory;
use App\Models\UserBalance;
use App\Models\Vendor;
use App\Models\VendorCategory;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use App\Supports\OrderSupport;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderService extends BaseService
{

  public function dataTable(Request $request)
  {
    // Check the role
    $user = request()->user();
    $vendorId = $user->vendor_id;
    $isCustomer = $user->role_id === 3;

    $columns = ['orders.id', 'users.name', 'orders.order_number', 'orders.event_name', 'locations.location', 'orders.event_date', 'orders.grand_total'];

    // Page Information
    $pageLength = $request->length;

    // Order Information
    (int) $orderColumnIndex = $request->order[0]['column'] ?? 0;
    $orderBy = $request->order[0]['dir'] ?? 'desc';
    $orderByName = $columns[$orderColumnIndex];


    // Query to database
    $search = $request->search['value'];
    $query = Order::select($columns)
      ->join('users', 'orders.user_id', 'users.id')
      ->join('locations', 'orders.location_id', 'locations.id')
      ->where("order_status_id", ">", 1)
      ->where(function ($query) use ($search, $columns) {
        foreach ($columns as $column) {
          $query->orWhere($column, 'like', "%" . $search . "%");
        }
      });



    if ($vendorId) {
      $query->whereHas('order_products', function ($q) use ($vendorId) {
        $q->where('vendor_id', $vendorId);
      });
    }


    if ($isCustomer) {
      $query->where('user_id', $user->id);
    }

    $query = $query->orderBy($orderByName, $orderBy)
      ->paginate((int) $pageLength);

    // Drawing rows
    $rows = [];
    foreach ($query->items() as $item) {
      $row = array();
      $row[] = "<input type='checkbox' class='order-checkbox' value='{$item->id}' />";
      $row[] = $item->id;
      $row[] = "<a href='". route('app.orders.show', $item->id) ."'>$item->order_number</a>";
      if (!$isCustomer) {
        $row[] = $item->name;
      }
      $row[] = $item->location;
      $row[] = date('j F Y', strtotime($item->event_date));
      $row[] = $item->grand_total;

      $rows[] = $row;
    }


    return [
      "draw" => $request->draw,
      "recordsTotal" => $query->total(),
      "recordsFiltered" => $query->total(),
      'data' => $rows
    ];
  }

  /**
   * Handle step 1 order
   *
   * @param Request $request
   */
  public function store_step1(Request $request)
  {
    $response = create_response();
    $error    = FALSE;
    $validate = $this->validate_step1($request);


    if ($validate !== TRUE) {
      $error = TRUE;
      $response->status_code  = 400;
      $response->message      = "Have errors in validation!";
      $response->data         = $validate;

      goto end;
    }

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try {
      // Need to check first exist oncreated order
      $values = [
        "user_id"             => auth()->user()->id,
        "event_name"          => $request->event_name,
        "event_type_id"       => $request->event_type_id,
        "order_status_id"     => 1,
        "payment_status_id"   => 1,
        "event_date"          => $request->event_date,
        "event_start_time"    => $request->event_start_time,
        "event_end_time"      => $request->event_end_time,
        "location_id"         => $request->location_id,
        "event_guest_count"   => $request->event_guest_count,
        "event_start_budget"  => $request->event_start_budget,
        "event_end_budget"    => $request->event_end_budget,
        "vendor_range"        => $request->vendor_range,
        "longitude"           => $request->longitude,
        "latitude"            => $request->latitude,
      ];

      // Check if order exists
      $order = Order::onCreated()->first();

      if($order) {
        $order->update($values);
      } else{
        $values['order_number'] = (new OrderSupport)->generate_number();
        $order = Order::create($values);
      }

    } catch (Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message      = $e->getMessage();
        $response->status_code  = 403;
      } else {
        $response               = response_errors_default();
        ErrorService::error($e, "OrderService::step1");
      }
    }

    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_success_default("Success!", $order->id);
    }

    return $response;
  }

  /**
   * Validation step 1
   *
   * @param Request $request
   */
  private function validate_step1(Request $request)
  {
    $rules = [
      "event_name" => [
        "required", "string", "max:150"
      ],
      "event_type_id" => [
        "required", "exists:event_types,id"
      ],
      "event_date" => [
        "required", "date_format:Y-m-d"
      ],
      "event_start_time" => [
        "required", "date_format:H:i"
      ],
      "event_end_time" => [
        "required", "date_format:H:i"
      ],
      "location_id" => [
        "required", "exists:locations,id"
      ],
      "event_guest_count" => [
        "required", "string"
      ],
      "event_start_budget" => [
        "required", "string"
      ],
      "event_end_budget" => [
        "required", "string"
      ],
      "vendor_range" => [
        "required", "string"
      ],
    ];

    $validation = Validator::make($request->all(), $rules);

    if ($validation->fails()) {
      return $validation->errors();
    }

    return TRUE;
  }

  /*
   * Handle step 2 order
   *
   * @param Request $request
   */
  public function store_step2(Request $request)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try {
      if ($request->filled("order_id") && $request->filled("vendor_category_ids")) {
        OrderVendorCategory::query()
        ->where("order_id", $request->order_id)
        ->delete();

        foreach ($request->vendor_category_ids as $sub_category_id) {
          OrderVendorCategory::create([
            "order_id" => $request->order_id,
            "vendor_category_id" => $sub_category_id
          ]);
        }

        $order = Order::query()
        ->select([
          "event_name", "et.event_type", "event_date",
          "event_start_time", "event_end_time", "l.location",
          "event_guest_count", "event_start_budget", "event_end_budget"
        ])
        ->join("event_types AS et", "orders.event_type_id", "et.id")
        ->join("locations AS l", "orders.location_id", "l.id")
        ->where("orders.id", $request->order_id)
        ->first();

        $categories = VendorCategory::query()
        ->select([
          "id",
          "vendor_category",
          "parent_category_id"
        ])
        ->with(["subs" => function($query) use ($request) {
          return $query->select(["id", "parent_category_id", "vendor_category"])->whereIn("id", $request->vendor_category_ids);
        }])
        ->whereHas("subs", function($query) use ($request) {
          return $query->whereIn("id", $request->vendor_category_ids);
        })
        ->get();

        $data = [
          "order" => $order,
          "categories" => $categories
        ];
      } else {
        $error = TRUE;
        $response->status_code = 403;
        $response->message = "Please fill all required fields!";
        goto end;
      }
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "OrderService::step1");
      }
    }

    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_data($data);
    }

    return $response;
  }

  /**
   * Hanle step 4 order
   *
   * @param Request $request
   */
  public function handle_step4(Request $request)
  {
    $response = create_response();
    $order = Order::find($request->order_id);

    if ($order) {
      $order_vendor_category_id = OrderVendorCategory::query()
      ->where("order_id", $request->order_id)
      ->get()
      ->pluck("vendor_category_id")
      ->toArray();


      $categories = VendorCategory::query()
      ->with([
        "parent_category"
      ])
      ->whereIn("id", $order_vendor_category_id)
      ->get()
      ->map(function($category) use ($order) {
        $vendors = [];
        $get_vendors = Vendor::query()
        ->where("vendor_category_id", $category->id)
        ->when(request()->filled("start_range_budget"), function($query) {
          return $query->whereHas("product", function($q) {
            return $q->whereBetween("product_sell_price", [request()->query("start_range_budget"), request()->query("end_range_budget")]);
          });
        })
        ->get();


        foreach ($get_vendors as $vendor) {
          $latitude_from = $order->latitude;
          $latitude_to = $vendor->latitude;
          $longitude_from = $order->longitude;
          $longitude_to = $vendor->longitude;

          $get_distance = (int) ceil(calculate_distance($latitude_from, $longitude_from, $latitude_to, $longitude_to));

          $allow_vendor = FALSE;
          if (request()->filled("vendor_range_location")) {
            if ($get_distance <= request()->query("vendor_range_location")) {
              $allow_vendor = TRUE;
            }
          } else {
            $allow_vendor = TRUE;
          }


          if ($allow_vendor) {
            $vendors[] = [
              "vendor_name" => $vendor->company_name,
              "logo" => $vendor->logo,
              "distance" => $get_distance,
              "vendor_id" => $vendor->id
            ];
          }
        }

        $category->vendors = $vendors;
        // dd($category);

        return $category;
      });

      $response = response_data($categories);
    } else {
      $response->status_code = 403;
      $response->message = "You must create order!";
    }

    return $response;
  }

  /**
   * Store payment with infinpay
   *
   * @param \Illuminate\Http\Request $request
   * @return \stdClass
   */
  public function store_payment_infinpay()
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try  {
      $payload = [
        "merchant_code" => env("MERCHANT_INFINPAY"),
        "merchant_reference" => "ABCDE",
        "amount" => 100,
        "currency" => "MYR",
        "description" => "Test Payment",
        "response_url" => "https://google.com",
        "payment_update_url" => "https://google.com",
        "customer" => [
          "customer_name" => "Fulan",
          "customer_email" => "9iOY5@example.com",
        ],
        "enable_auto_capture" => FALSE,
        "payment_type" => [
          "card" => TRUE,
          "ewallet" => TRUE,
          "online_banking" => TRUE,
        ]
      ];

      $headers = [
        "alg" => "HS256",
        "kid" => env("API_KEY_INFINPAY")
      ];

      $jwt = JWT::encode($payload, env("SECRET_INFINPAY"), "HS256", env("API_KEY_INFINPAY"), $headers);
      $payload["jwt"] = $jwt;

      $request = Http::withHeaders($headers)
      ->post("https://uatpaymenthub.infinpay.com/api/pymt/pw/v1.1/payment", $payload);

      dd($request->json());
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "OrderService::store_payment_infinpay");
      }
    }

    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
    }

    return $response;
  }

  /**
   * Store to cart
   *
   * @param \Illuminate\Http\Request $request
   * @return mixed|\Illuminate\Http\JsonResponse|\stdClass
   */
  public function add_to_cart(Request $request){
    $product_id = $request->product_id;
    $qty        = $request->qty;
    $type       = $request->type;


    $response   = create_response();

    $product    = Product::select('id','vendor_id','product_category_id','product_name','product_capital_price','product_sell_price','product_stock')
    ->with('product_package')
    ->where('id', $product_id)->first();


    if(!$product->product_stock){
      return response()->json($response, 403);
    }

    if(!$product) return $response;


    $order         = Order::select('id', 'user_id', 'order_status_id')->onCreated()->first();
    // dd($order);

    $order_product = OrderProduct::where('user_id', $order->user_id)->where('order_id', $order->id)->where('product_id', $product_id)->first();

    if($order_product){
      $totalQty = $type == 'cart' ?   $qty : $order_product->qty + $qty;
      $qty      = $totalQty > $product->product_stock ? $product->product_stock : $totalQty;
    }
    $variation = ProductVariation::query()->where("id", $request->variation_id)->first();


    $data = [
      'order_id'                => $order->id,
      'user_id'                 => $order->user_id,
      'vendor_id'               => $product->vendor_id,
      'product_id'              => $product_id,
      'product_category_id'     => $product->product_category_id,
      'product_name'            => $product->product_name,
      'variation'               => $variation->variation,
      'product_capital_price'   => $product->product_capital_price,
      'total_capital_price'     => $product->product_capital_price * $qty,
      'product_discount_price'  => 0,
      'product_sell_price'      => $product->product_sell_price,
      'total_sell_price'        => $product->product_sell_price * $qty,
      'grand_total'             => 0,
      'qty'                     => $qty,
      "payment_vendor_status_id"=> 1,
    ];

    //Calculate Discount
    $grandTotal = $product->product_sell_price * $qty;
    $product_package = $product->product_package;

    if($product_package && $qty >= $product_package->minimum_qty){
      $discount = 0;
      $value_package = $product_package->value;

       if ($product_package->package_type == 1) {
            $discount = $grandTotal * ($value_package / 100);
            $grandTotal -= $discount;
          } else if ($product_package->package_type == 2) {
            $discount = $value_package;
            $grandTotal -= $discount;
          } else {
            $grandTotal = $value_package * $qty;
        }


        $data['product_discount_price'] = $discount;
    }

    $data['grand_total'] = $grandTotal;
    $data['payment_vendor_available'] = $grandTotal;
    // dd($data);

    try{
      if($order_product){
        // Update data
        $order_product->update($data);
      }else{
        //Insert Data
        $order_product = OrderProduct::create($data);
      }

    }catch(Exception $e){
      $response->status_code = 500;
      return $response;
    }

    $response->status       = TRUE;
    $response->status_code  = 200;
    $response->message      = 'Product has been added to cart';

    return $response;
  }

  /**
   * Handle payment callback
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\stdClass
   */
  public function handle_payment(Request $request)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try  {
      $key = env('SECRET_INFINPAY');
      $decode = JWT::decode($request->jwt, new Key(base64_decode($key), 'HS256'));

      if ($decode) {
        $trx_code = $decode->transaction->result_code;

        if ($trx_code == 0) {
          $status = $decode->transaction->payment_status;

          if (in_array(env("APP_ENV"), ["local", "staging"])) {
            $check_status = in_array($status, ["SALES", "Captured"]);
          } else {
            $check_status = in_array($status, ["Captured"]);
          }

          if ($check_status) {
            $order = Order::query()->where("order_number", $decode->merchant_reference)->first();

            if ($order) {
              $values = [
                "payment_status_id" => 3
              ];

              Order::query()
                ->where("id", $order->id)
                ->update($values);

              OrderProduct::query()
              ->where("order_id", $order->id)
              ->where("is_choice", 0)
              ->delete();

              $order_products = OrderProduct::query()
              ->where("order_id", $order->id)
              ->where("is_choice", 1)
              ->get();

              foreach ($order_products as $order_product) {
                $values = [
                  "user_id" => auth()->user()->id,
                  "transaction_history_status_id" => 1,
                  "transaction_history_type_id" => 1,
                  "transaction_time" => date("Y-m-d H:i:s"),
                  "transaction_number" => $order->order_number,
                  "description" => $order_product->product_name,
                  "amount" => $order_product->grand_total,
                  "reference_id" => $order->id,
                  "route" => "app.orders.show"
                ];

                TransactionHistory::create($values);
              }

              UserBalance::query()
              ->where("user_id", $order->user_id)
              ->increment("paid_deposit", $order->grand_total);

              $vendors = OrderProduct::query()
              ->where("order_id", $order->id)
              ->groupBy("vendor_id")
              ->get();

              foreach ($vendors as $vendor) {
                OrderVendor::create([
                  "order_id" => $order->id,
                  "vendor_id" => $vendor->vendor_id,
                  "order_vendor_status_id" => 1
                ]);
              }
            } else {
              $error = TRUE;
              $response->message = "Order Not Found!";
            }
          } else {
            $error = TRUE;
            $response->message = "Order Payment Failed!";
            $response->status_code = 400;
          }
        } else {
          $error = TRUE;
          $response->message = "Order Payment Failed!";
          $response->status_code = 400;
        }
      } else {
        $error = TRUE;
        $response->message = "Invalid Signature!";
        $response->status_code = 403;
      }
    } catch (Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "OrderService::handle_payment");
      }
    }

    info("Results Payment", (array) $response);
    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_success_default("Payment Success!");
    }

    return $response;
  }

  /**
   * Reject order by vendor
   *
   * @param \App\Models\Order $order
   * @return \stdClass
   */
  public function reject_order_vendor(Order $order)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try  {
      $order_products = OrderProduct::query()
      ->where("order_id", $order->id)
      ->where("vendor_id", auth()->user()->vendor_id)
      ->get();

      foreach ($order_products as $order_product) {
        OrderProduct::query()
        ->where("id", $order_product->id)
        ->update([
          "order_vendor_status_id" => 6
        ]);

        UserBalance::query()
        ->where("user_id", $order_product->user_id)
        ->increment("credit_balance", $order_product->grand_total);
      }

      OrderVendor::query()
      ->where("order_id", $order->id)
      ->where("vendor_id", auth()->user()->vendor_id)
      ->update([
        "order_vendor_status_id" => 6
      ]);
    } catch (Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "OrderService::reject_order_vendor");
      }
    }

    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_success_default("Order has been rejected!", FALSE, route("vendor.orders.show", $order->id));
    }

    return $response;
  }

  /**
   * Commit order by vendor
   *
   * @param \App\Models\Order $order
   * @return \stdClass
   */
  public function commit_order_vendor(Order $order)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try  {
      $order_products = OrderProduct::query()
        ->where("order_id", $order->id)
        ->where("vendor_id", auth()->user()->vendor_id)
        ->get();

      foreach ($order_products as $order_product) {
        OrderProduct::query()
          ->where("id", $order_product->id)
          ->update([
            "order_vendor_status_id" => 2
          ]);
      }

      OrderVendor::query()
      ->where("order_id", $order->id)
      ->where("vendor_id", auth()->user()->vendor_id)
      ->update([
        "order_vendor_status_id" => 2
      ]);
    } catch (Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "OrderService::commit_order_vendor");
      }
    }

    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_success_default("Order has commited!", FALSE, route("vendor.orders.show", $order->id));
    }

    return $response;
  }
}
