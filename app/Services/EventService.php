<?php namespace App\Services;
      use App\Models\OrderProduct;
      use App\Models\Product;
      use App\Models\ProductPackage;
      use App\Services\Cores\BaseService;
      use App\Services\Cores\ErrorService;

class EventService extends BaseService
{
  /**
   * Store cart
   *
   */
  public function store_cart()
  {
    $response = create_response();
    $error = FALSE;
    $this->trans_begin();

    try  {
      $qty = request()->qty;

      if ($qty > 0) {
        $product = Product::query()
        ->where("id", request()->product_id)
        ->first();

        // dd($product->product_slot);
        if ($product->product_service == 0 && $qty > $product->product_stock) {
          $error = TRUE;
          $response->message = __("Stock not enough!");
          $response->status_code = 403;
          goto end;
        }

        if ($product->product_service == 1 && $qty > $product->product_slot) {
          $error = TRUE;
          $response->message = __("Stock not enough!");
          $response->status_code = 403;
          goto end;
        }

        $get_product = OrderProduct::query()
        ->where("order_id", request()->order_id)
        ->where("product_id", $product->id)
        ->first();

        if ($get_product) {
          $qty += $get_product->qty;
          $values = [
            "qty" => $qty,
            "product_capital_price" => $product->product_capital_price,
            "total_capital_price" => $product->product_capital_price * $qty,
            "product_sell_price" => $product->product_sell_price,
            "total_sell_price" => $product->product_sell_price * $qty,
            "grand_total" => $product->product_sell_price * $qty,
          ];
        } else {
          $values = [
            "order_id" => request()->order_id,
            "user_id" => auth()->user()->id,
            "vendor_id" => $product->vendor_id,
            "product_id" => $product->id,
            "product_category_id" => $product->product_category_id,
            "product_name" => $product->product_name,
            "qty" => request()->qty,
            "product_capital_price" => $product->product_capital_price,
            "total_capital_price" => $product->product_capital_price * $qty,
            "product_sell_price" => $product->product_sell_price,
            "total_sell_price" => $product->product_sell_price * $qty,
            "grand_total" => $product->product_sell_price * $qty,
          ];
        }

        $package = ProductPackage::query()->where("product_id", $product->id)->first();
        if ($package && $qty > $package->minimum_qty) {
          if ($package->package_type == 1) {
            $values["product_discount_price"] = $discount = ($values["grand_total"] * $package->value) / 100;
            $values["grand_total"] -= $discount;
          } else if ($package->package_type == 2) {
            $values["product_discount_price"] = $discount = $package->value;
            $values["grand_total"] -= $discount;
          } else {
            $sell_price = $package->value;

            $values["product_discount_price"] = $product->product_sell_price - $package->value;
            $values["product_sell_price"] = $sell_price;
            $values["total_sell_price"] = $sell_price * $qty;
            $values["grand_total"] = $sell_price * $qty;
          }
        }

        if ($get_product) {
          OrderProduct::query()
          ->where("id", $get_product->id)
          ->update($values);
        } else {
          OrderProduct::create($values);
        }
      }
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "EventService::store_cart");
      }
    }

    end:
    if ($error) {
      $this->trans_rollback();
    } else {
      $this->trans_commit();
      $response = response_success_default(__("Success add to cart!"));
    }

    return $response;
  }
}
