<?php

namespace App\Http\Controllers\Apps\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileVendorRequest;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\VendorBussiness;
use App\Models\VendorCategory;
use App\Models\VendorType;
use App\Services\VendorService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  private VendorService $service;

  public function __construct()
  {
    $this->service = new VendorService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      "vendor" => Vendor::query()
      ->with(["category"])
      ->where("id", auth()->user()->vendor_id)
      ->first(),
      "user" => auth()->user(),
      "vendor_businesses" => VendorBussiness::all(),
      "vendor_categories" => VendorCategory::all(),
      "vendor_types" => VendorType::all(),

      "products" => Product::query()->where("vendor_id", auth()->user()->vendor_id)->where("product_service", 0)->get(),
      "services" => Product::query()->where("vendor_id", auth()->user()->vendor_id)->where("product_service", 1)->get(),
    ];
    $data["product_details"] = array_merge($data["products"]->toArray(), $data["services"]->toArray());
    // dd($data["vendor"]);

    return $this->view_admin("vendors.profiles.index", "Profile", $data, TRUE);
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
  public function update(ProfileVendorRequest $request)
  {
    $response = $this->service->update_profile_vendor($request);
    return response_json($response);
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
