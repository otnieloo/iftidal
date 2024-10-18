<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use App\Models\UserStatus;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  private CustomerService $service;

  public function __construct()
  {
    $this->service = new CustomerService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->view_admin("admin.customers.index", "List Customer", [], TRUE);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [
      "user_statuses" => UserStatus::all()
    ];

    return $this->view_admin("admin.customers.create", __("Add New Customer"), $data, TRUE);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CustomerRequest $request)
  {
    $response = $this->service->store($request);
    return response_json($response);
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
  public function edit(User $customer)
  {
    $data = [
      "customer" => $customer,
      "user_statuses" => UserStatus::all(),
    ];

    return $this->view_admin("admin.customers.edit", __("Edit Customer"), $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(CustomerRequest $request, User $customer)
  {
    $response = $this->service->update($request, $customer);
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

  /**
   * Verified customer
   * 
   * @param User $customer
   */
  public function verified(User $customer)
  {
    User::query()
    ->where("id", $customer->id)
    ->update([
      "email_verified-at" => date('Y-m-d H:i:s'),
    ]);

    $response = response_success_default(__("Success verified customer!"), FALSE, route('app.customers.index'));
    return response_json($response);
  }
}
