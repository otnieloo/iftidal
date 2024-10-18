<?php

namespace App\Http\Controllers\Apps\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCondition;
use App\Models\ProductLevel;
use App\Models\ProductPackage;
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
      $row[] = $no;
      $row[] = $product->product_name;
      $row[] = myr_currency($product->product_sell_price);
      $row[] = myr_currency($product->product_capital_price);
      $row[] = $product->product_slot;
      $row[] = $product->product_level;
      $row[] = $product->product_status;

      $button = "<a href='" . route('vendor.products.edit', $product->id) . "' class='btn btn-info btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>";
      // $button .= form_delete("formProduct$product->id", route("vendor.products.destroy", $product->id));

      $row[] = $button;
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
      $no++;
      $row = [];
      $row[] = $no;
      $row[] = $product->product_name;
      $row[] = myr_currency($product->product_sell_price);
      $row[] = myr_currency($product->product_sell_price);
      $row[] = $product->product_stock;
      $row[] = $product->product_condition;
      $row[] = $product->product_status;


      $button = "<a href='" . route('vendor.products.edit', $product->id) . "' class='btn btn-info btn-sm'>Edit</a>";
      // $button .= form_delete("formProduct$product->id", route("vendor.products.destroy", $product->id));

      $row[] = $button;
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
    $type = request()->segment(2);

    return $this->view_admin("vendors.products.create", "Create Product", [
      'categories' => $categories,
      'sub_categories' => $sub_categories,
      'conditions' => $conditions,
      'type' => $type,
      'product_levels' => $product_levels,

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
    $package = ProductPackage::query()->where("product_id", $product->id)->first();

    $type = request()->segment(2);

    return $this->view_admin("vendors.products.edit", "Edit Product", [
      'categories' => $categories,
      'sub_categories' => $sub_categories,
      'conditions' => $conditions,
      'product' => $product->load('product_images', 'product_package'),
      'type' => $type,
      'product_levels' => $product_levels,
      "package" => $package
    ], TRUE);
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
