<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCondition;
use App\Models\ProductGuarantee;
use App\Models\ProductLevel;
use App\Models\ProductPackage;
use App\Models\ProductPaymentRelease;
use App\Models\ProductVariation;
use App\Models\Vendor;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


  private ProductService $product_service;

  public function __construct()
  {
    $this->product_service = new ProductService;
  }


  /**
   * Get list product
   *
   * @param Request $request
   */
  public function get_service(Request $request)
  {
    $products = $this->product_service->get_list_paged($request, true);
    $count = $this->product_service->get_list_count($request, true);

    $data = [];
    $no = $request->start;


    foreach ($products as $product) {
      $no++;
      $row = [];
      $row[] = '
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="product_id[]" value=' . $product->id . '>
        </div>
      ';
      $row[] = $product->product_name;

      $button = '
        <a href="' . route('app.services.edit', $product->id) . '" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
        <a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
      ';
      if ($product->product_status_id == 1 && is_role("Super Admin")) {
        $button .= form_custom("formApproveProduct$product->id", route("app.products.approve", $product->id), "fa-solid fa-check", "success", __("Approve this product?"));
        $button .= form_custom("formDeclineProduct$product->id", route("app.products.decline", $product->id), "fa-solid fa-xmark", "danger", __("Decline this product?"));
      }
      $row[] = $button;

      $row[] = myr_currency($product->order_items_sum_grand_total);
      $row[] = myr_currency($product->product_sell_price);
      $row[] = $product->product_slot;
      $row[] = $product->product_level;
      $row[] = '<p class="text-' . $product->color . '">' . $product->product_status . '</p>';

      $data[] = $row;
    }

    $output = [
      "draw" => $request->draw,
      "recordsTotal" => $count,
      "recordsFiltered" => $count,
      "data" => $data
    ];

    return \response()->json($output, 200);
  }



  /**
   * Get list product
   *
   * @param Request $request
   */
  public function get(Request $request)
  {
    $products = $this->product_service->get_list_paged($request);
    $count = $this->product_service->get_list_count($request);

    $data = [];
    $no = $request->start;


    foreach ($products as $product) {
      // dd($product);

      $no++;
      $row = [];
      $row[] = '
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="product_id[]" value=' . $product->id . '>
        </div>
      ';
      $row[] = $product->product_name;

      $button = '
        <a href="' . route('app.products.edit', $product->id) . '" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
        <a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
      ';

      if ($product->product_status_id == 1 && is_role("Super Admin")) {
        $button .= form_custom("formApproveProduct$product->id", route("app.products.approve", $product->id), "fa-solid fa-check", "success", __("Approve this product?"));
        $button .= form_custom("formDeclineProduct$product->id", route("app.products.decline", $product->id), "fa-solid fa-xmark", "danger", __("Decline this product?"));
      }
      $row[] = $button;

      $row[] = myr_currency($product->order_items_sum_grand_total);
      $row[] = myr_currency($product->product_sell_price);
      $row[] = $product->product_stock;
      $row[] = $product->variations_count;
      $row[] = '<p class="text-' . $product->color . '">' . $product->product_status . '</p>';

      $data[] = $row;
    }

    $output = [
      "draw" => $request->draw,
      "recordsTotal" => $count,
      "recordsFiltered" => $count,
      "data" => $data
    ];

    return \response()->json($output, 200);
  }


  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    $vendors = Vendor::all();

    return $this->view("admin.product.index", "Product Management", [
      'vendors' => $vendors
    ], TRUE);
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    $categories = ProductCategory::where('parent_category', 1)->get();
    $sub_categories = ProductCategory::where('parent_category', 0)->get();
    $product_levels = ProductLevel::all();
    $conditions = ProductCondition::all();
    $payment_releases = ProductPaymentRelease::all();
    $guarantees = ProductGuarantee::all();

    $type = request()->segment(2);

    return $this->view("admin.product.create", "Create Product", [
      'categories' => $categories,
      'sub_categories' => $sub_categories,
      'conditions' => $conditions,
      'type' => $type,
      'product_levels' => $product_levels,
      'payment_releases' => $payment_releases,
      'guarantees' => $guarantees
    ], TRUE);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductRequest $request)
  {
    $response = $this->product_service->store($request);
    return \response_json($response);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   */
  public function edit(Product $product)
  {
    $categories = ProductCategory::where('parent_category', 1)->get();
    $sub_categories = ProductCategory::where('parent_category', 0)->get();
    $conditions = ProductCondition::all();
    $product_levels = ProductLevel::all();
    $package = ProductPackage::query()->where("product_id", $product->id)->first();
    $payment_releases = ProductPaymentRelease::all();
    $guarantees = ProductGuarantee::all();
    $variations = ProductVariation::query()
      ->select(["variation"])
      ->where('product_id', $product->id)
      ->get();

    $type = request()->segment(2);

    return $this->view("admin.product.edit", "Edit Product", [
      'categories' => $categories,
      'sub_categories' => $sub_categories,
      'conditions' => $conditions,
      'product' => $product->load('product_images', 'product_package'),
      'type' => $type,
      'product_levels' => $product_levels,
      "package" => $package,
      'payment_releases' => $payment_releases,
      'guarantees' => $guarantees,
      'variations' => $variations
    ], TRUE);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(ProductRequest $request, Product $product)
  {
    $response = $this->product_service->update($request, $product);
    return \response_json($response);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {
    $product->load('product_images');
    foreach ($product->product_images as $product_image) {
      Storage::delete($product_image->product_image);
    }
    Storage::delete($product->product_video);

    $product->delete();
    $response = \response_success_default("Product has been deleted!", FALSE, \route("app.products.index"));
    return \response_json($response);
  }

  /**
   * Approve product
   *
   * @param Product $product
   */
  public function approve(Product $product)
  {
    Product::query()
      ->where("id", $product->id)
      ->update([
        "product_status_id" => 2
      ]);

    $response = \response_success_default(__("Product has been approved!"), $product->id, \route("app.products.index"));
    return response_json($response);
  }

  /**
   * Decline product
   *
   * @param Product $product
   */
  public function decline(Product $product)
  {
    Product::query()
      ->where("id", $product->id)
      ->update([
        "product_status_id" => 3
      ]);

    $response = \response_success_default(__("Product has been declined!"), $product->id, \route("app.products.index"));
    return response_json($response);
  }
}
