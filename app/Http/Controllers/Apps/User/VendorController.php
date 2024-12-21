<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\PaymentVendorStatus;
use App\Models\VendorCategory;
use App\Services\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
  private VendorService $service;

  public function __construct()
  {
    $this->service = new VendorService();
  }

  public function get(Request $request)
  {

  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      "vendor_categories" => VendorCategory::query()->whereNotNull("parent_category_id")->get(),
      "order_statuses" => OrderStatus::all(),
      "payment_vendor_statuses" => PaymentVendorStatus::all()
    ];

    return $this->view("users.vendors.index", "My Vendors", $data, TRUE);
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
