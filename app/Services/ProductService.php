<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\VendorRequest;
use App\Models\Product;
use App\Models\ProductGuarantee;
use App\Models\ProductImage;
use App\Models\ProductPackage;
use App\Models\ProductPaymentRelease;
use App\Models\ProductStatus;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Vendor;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductService extends BaseService
{
  /**
   * Generate query index page
   *
   * @param Request $request
   */
  private function generate_query_get(Request $request, $is_service = false)
  {
    if ($is_service) {
      $column_search = ["products.product_name", "products.product_sell_price", "products.product_sell_price", "products.product_slot", "pl.product_level", "ps.product_status"];
      $column_order = [NULL, "products.product_name", NULL, "order_items_sum_grand_total", "products.product_sell_price", "products.product_slot", "pl.product_level", "ps.product_status"];

      $query = Product::query()
        ->select('products.*', 'pl.product_level', 'ps.product_status', 'ps.color')
        ->withSum("order_items", "grand_total")
        ->join("product_levels as pl", "pl.id", "products.product_level_id")
        ->join("product_statuses as ps", "ps.id", "products.product_status_id")
        ->where('products.product_service', 1);
    } else {
      $column_search = ["products.product_name", "products.product_sell_price", "products.product_sell_price", "products.product_stock", "pc.product_condition", "ps.product_status"];
      $column_order = [NULL, "products.product_name", NULL, "order_items_sum_grand_total", "products.product_sell_price", "products.product_stock", "variations_count"];

      $query = Product::query()
        ->select('products.*', 'pc.product_condition', 'ps.product_status', 'ps.color')
        ->withSum("order_items", "grand_total")
        ->withCount("variations")
        ->join("product_conditions as pc", "pc.id", "products.product_condition_id")
        ->join("product_statuses as ps", "ps.id", "products.product_status_id")
        ->where('products.product_service', 0);
    }

    $order = ["products.id" => "DESC"];

    $results = $query
      ->where(function ($query) use ($request, $column_search) {
        $i = 1;
        if (isset($request->search)) {
          foreach ($column_search as $column) {
            if ($request->search["value"]) {
              if ($i == 1) {
                $query->where($column, "LIKE", "%{$request->search["value"]}%");
              } else {
                $query->orWhere($column, "LIKE", "%{$request->search["value"]}%");
              }
            }
            $i++;
          }
        }
      });

    if (isset($request->order) && !empty($request->order)) {
      $results = $results->orderBy($column_order[$request->order["0"]["column"]], $request->order["0"]["dir"]);
    } else {
      $results = $results->orderBy(key($order), $order[key($order)]);
    }

    return $results;
  }

  public function get_list_paged(Request $request, $is_service = false)
  {
    $results = $this->generate_query_get($request, $is_service);
    if ($request->length != -1) {
      $limit = $results->offset($request->start)->limit($request->length);
      return $limit->get();
    }
  }

  public function get_list_count(Request $request, $is_service = false)
  {
    return $this->generate_query_get($request, $is_service)->count();
  }

  /**
   * Store new vendor
   *
   * @param Request $request
   */
  public function store(ProductRequest $request)
  {
    $response = create_response();
    DB::beginTransaction();

    try {
      if (!$request->has("tmp_video")) {
        $response->status_code = 403;
        $response->message = "Missing video!";
        return $response;
      }

      $values = $request->validated();
      if (auth()->user()->role_id == 2) {
        $values["vendor_id"] = auth()->user()->vendor_id;
      }

      $variations = $request->variations;
      unset($values["variations"]);

      $payment_release = ProductPaymentRelease::find($request->payment_release_id);
      $values["payment_release"] = $payment_release->payment_release;

      $product_guarantee = ProductGuarantee::find($request->product_guarantee_id);
      $values["product_guarantee"] = $product_guarantee->product_guarantee;

      if ($request->has('tmp_video')) {
        [$newImage, $movedFile] = move_tmp_file($values['tmp_video'], 'product/video');
        $values['product_video'] = $newImage;
      }

      $productStatusId = ProductStatus::where('product_status', 'pending')->first();
      $values['product_status_id'] = $productStatusId->id;
      $values['product_service'] = $request->has('product_condition_id') ? 0 : 1;
      // dd($variations);

      $product = Product::create($values);

      foreach ($variations as $variation) {
        $values = [
          "product_id" => $product->id,
          "variation" => $variation
        ];
        ProductVariation::create($values);
      }

      // Insert product images
      if ($request->has('tmp')) {

        $productImage = [];

        foreach ($request->tmp as $tmp) {
          [$newImage, $movedFile] = move_tmp_file($tmp, 'public/product/image');
          $productImage[] = [
            'product_id' => $product->id,
            'product_image' => $newImage
          ];
        }

        ProductImage::insert($productImage);
        Product::query()
          ->where("id", $product->id)
          ->update(["product_image" => $productImage[0]["product_image"]]);
      }

      // Insert product package
      if ($request->has('package_type') && $request->package_type) {
        $packageType = $request->package_type;

        switch ($packageType) {
          case "1":
            ProductPackage::create([
              'product_id' => $product->id,
              'minimum_qty' => $request->minimum_qty_1,
              'percent_type' => 1,
              'value' => $request->package_price_percent_1,
              'package_type' => 1
            ]);

            break;

          case "2":
            ProductPackage::create([
              'product_id' => $product->id,
              'minimum_qty' => $request->minimum_qty_2,
              'percent_type' => 0,
              'value' => $request->package_price_percent_2,
              'package_type' => 2
            ]);

            break;

          case "3":
            ProductPackage::create([
              'product_id' => $product->id,
              'minimum_qty' => $request->minimum_qty_3,
              'percent_type' => 0,
              'value' => $request->package_price_percent_3,
              'package_type' => 3
            ]);
            break;
        }
      }

      $next_route = route("app.products.index");
      if (auth()->user()->role_id == 2) {
        $next_route = route("vendor.products.index");
      }

      $response = \response_success_default("Product has been created!", '', $next_route);
    } catch (\Exception $e) {
      DB::rollBack();
      ErrorService::error($e, "Failed create product!");
      $response = \response_errors_default();
    }

    DB::commit();

    return $response;
  }

  /**
   * Update new vendor
   *
   * @param Request $request
   * @param Vendor $vendor
   */
  public function update(ProductRequest $request, Product $product)
  {
    $response = create_response();
    
    try {
      if (!$request->has("tmp_video")) {
        $response->status_code = 403;
        $response->message = "Missing video!";
        return $response;
      }

      $values = $request->validated();
      if (auth()->user()->role_id == 2) {
        $values["vendor_id"] = auth()->user()->vendor_id;
      }

      $variations = $request->variations;
      unset($values["variations"]);
      unset($values["tmp"]);
      unset($values["package_type"]);

      $payment_release = ProductPaymentRelease::find($request->payment_release_id);
      $values["payment_release"] = $payment_release->payment_release;

      $product_guarantee = ProductGuarantee::find($request->product_guarantee_id);
      $values["product_guarantee"] = $product_guarantee->product_guarantee;

      if ($request->has('tmp_video')) {
        [$newImage, $movedFile] = move_tmp_file($values['tmp_video'], 'product/video');
        $values['product_video'] = $newImage;

        Storage::delete($product->product_video);
      }


      // Product image process
      if ($request->has('tmp')) {
        $productImage = [];

        $productImages = ProductImage::select('id', 'product_image')->where('product_id', $product->id)->get();
        $deletedIdProductImages = $productImages->filter(function ($value, $key) use ($request) {
          return !in_array($value->id, $request->tmp);
        });


        foreach ($request->tmp as $tmp) {
          // Check if this new image
          if (str_contains($tmp, 'tmp')) {

            [$newImage, $movedFile] = move_tmp_file($tmp, 'public/product/image');
            $productImage[] = [
              'product_id' => $product->id,
              'product_image' => $newImage
            ];
          }
        }

        // If there is a new image uplaod
        // store to database
        if (count($productImage)) {
          ProductImage::insert($productImage);
        }

        // If there is product image are deleted
        // Delete from DB & Storage
        if ($deletedIdProductImages->count()) {
          $listProductImageId = [];

          foreach ($deletedIdProductImages as $deletedImage) {
            $listProductImageId[] = $deletedImage->id;
            Storage::delete($deletedImage->product_image);
          }

          ProductImage::whereIn('id', $listProductImageId)->delete();
        }

        $values['product_image'] = $productImages->first()['product_image'];
      }


      Product::query()->where("id", $product->id)->update($values);

      ProductVariation::query()->where("product_id", $product->id)->delete();

      foreach ($variations as $variation) {
        $values = [
          "product_id" => $product->id,
          "variation" => $variation
        ];

        ProductVariation::create($values);
      }
      // Insert product package
      if ($request->has('package_type') && $request->package_type) {
        $packageType = $request->package_type;

        ProductPackage::where('product_id', $product->id)->delete();

        switch ($packageType) {
          case "1":
            ProductPackage::create([
              'product_id' => $product->id,
              'minimum_qty' => $request->minimum_qty_1,
              'percent_type' => 1,
              'value' => $request->package_price_percent_1,
              'package_type' => 1
            ]);

            break;

          case "2":
            ProductPackage::create([
              'product_id' => $product->id,
              'minimum_qty' => $request->minimum_qty_2,
              'percent_type' => 0,
              'value' => $request->package_price_percent_2,
              'package_type' => 2
            ]);

            break;

          case "3":
            ProductPackage::create([
              'product_id' => $product->id,
              'minimum_qty' => $request->minimum_qty_3,
              'percent_type' => 0,
              'value' => $request->package_price_percent_3,
              'package_type' => 3
            ]);
            break;
        }
      }

      $next_route = route("app.products.index");
      if (auth()->user()->role_id == 2) {
        $next_route = route("vendor.products.index");
      }
      $response = \response_success_default("Product has been updated!", '', $next_route);
    } catch (\Exception $e) {
      ErrorService::error($e, "Falied update product!");
      $response = \response_errors_default();
    }

    return $response;
  }
}
