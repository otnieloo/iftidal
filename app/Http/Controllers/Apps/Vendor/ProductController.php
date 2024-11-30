<?php

namespace App\Http\Controllers\Apps\Vendor;

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
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  private ProductService $service;

  public function __construct()
  {
    $this->service = new ProductService;
  }

  /**
   * Get list product
   *
   * @param Request $request
   */
  public function get_service(Request $request)
  {
    $products = $this->service->get_list_paged($request, true);
    $count = $this->service->get_list_count($request, true);

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

      $row[] = '
        <a href="'. route('vendor.services.edit', $product->id) .'" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
        <a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
      ';

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
    $products = $this->service->get_list_paged($request);
    $count = $this->service->get_list_count($request);

    $data = [];
    $no = $request->start;


    foreach ($products as $product) {
      // dd($product);

      $no++;
      $row = [];
      $row[] = '
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="product_id[]" value='. $product->id .'>
        </div>
      ';
      $row[] = $product->product_name;

      $row[] = '
        <a href="'. route('vendor.products.edit', $product->id) .'" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
        <a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
      ';

      $row[] = myr_currency($product->order_items_sum_grand_total);
      $row[] = myr_currency($product->product_sell_price);
      $row[] = $product->product_stock;
      $row[] = $product->variations_count;
      $row[] = '<p class="text-'. $product->color .'">'. $product->product_status .'</p>';

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
    return $this->view_admin("vendors.products.index", "Product Management", [], TRUE);
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

    return $this->view_admin("vendors.products.create", "Create Product", [
      'categories' => $categories,
      'sub_categories' => $sub_categories,
      'conditions' => $conditions,
      'type' => $type,
      'product_levels' => $product_levels,
      'payment_releases' => $payment_releases,
      'guarantees' => $guarantees,

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
    $response = $this->service->store($request);
    return \response_json($response);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   */
  public function edit(Product $product)
  {
    $categories = ProductCategory::where('parent_category', 1)->get();
    $sub_categories = ProductCategory::where('parent_category', 0)->get();
    $conditions = ProductCondition::all();
    $product_levels = ProductLevel::all();
    $payment_releases = ProductPaymentRelease::all();
    $guarantees = ProductGuarantee::all();
    $variations = ProductVariation::query()
    ->select(["variation"])
    ->where('product_id', $product->id)
    ->get();

    $package = ProductPackage::query()->where("product_id", $product->id)->first();

    $type = request()->segment(2);

    $data = [
      'categories' => $categories,
      'sub_categories' => $sub_categories,
      'conditions' => $conditions,
      'product' => $product->load('product_images', 'product_package'),
      'type' => $type,
      'product_levels' => $product_levels,
      "package" => $package,
      'payment_releases' => $payment_releases,
      'guarantees' => $guarantees,
      'variations' => $variations,
    ];

    return $this->view_admin("vendors.products.edit", "Edit Product", $data, TRUE);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   */
  public function update(ProductRequest $request, Product $product)
  {
    $response = $this->service->update($request, $product);
    return \response_json($response);
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
