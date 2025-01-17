<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterVendorRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\VendorBussiness;
use App\Models\VendorCategory;
use App\Models\VendorType;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  private RegisterService $service;

  public function __construct()
  {
    $this->service = new RegisterService();
  }

  /**
   * Display register as user
   *
   */
  public function index_user()
  {
    return view("auth.user.register");
  }

  /**
   * Store register user
   *
   * @param \App\Http\Requests\UserRegisterRequest
   */
  public function store_user(UserRegisterRequest $request)
  {
    $response = $this->service->store_user($request);
    return \response_json($response);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index_vendor()
  {
    $data = [
      'vendor_categories' => VendorCategory::where('parent_category_id', NULL)->get(),
      'vendor_bussinesses' => VendorBussiness::all(),
      'vendor_types' => VendorType::all()
    ];


    return view("auth.vendor.register", $data);
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
   * Store a newly vendor created resource in storage.
   *
   * @param \App\Http\Requests\RegisterVendorRequest $request
   */
  public function store_vendor(RegisterVendorRequest $request)
  {
    $response = $this->service->store_vendor($request);
    return \response_json($response);
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
