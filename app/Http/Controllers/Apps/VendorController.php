<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorBussiness;
use App\Models\VendorCategory;
use App\Models\VendorType;
use App\Services\VendorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{

  private VendorService $vendor_service;

  public function __construct()
  {
    $this->vendor_service = new VendorService;
  }


  /**
   * Get list vendor
   *
   * @param Request $request
   */
  public function get(Request $request)
  {
    $vendors = $this->vendor_service->get_list_paged($request);
    $count = $this->vendor_service->get_list_count($request);

    $data = [];
    $no = $request->start;

    foreach ($vendors as $vendor) {
      $no++;
      $row = [];
      $row[] = $no;
      $row[] = $vendor->company_name;
      $row[] = $vendor->company_phone;
      $row[] = $vendor->company_email;
      $row[] = $vendor->company_address;
      $row[] = $vendor->contact_person_name;
      $row[] = $vendor->contact_person_phone;
      $row[] = $vendor->contact_person_email;
      $row[] = $vendor->register_date;
      $row[] = $vendor->apporved_date;

      $button = "<a href='" . \route("app.vendors.show", $vendor->id) . "' class='btn btn-info btn-sm m-1'><i class='fa-solid fa-pen-to-square'></i></a>";
      $button .= form_delete("formUser$vendor->id", route("app.vendors.destroy", $vendor->id));

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
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    return $this->view_admin("admin.vendors.index", "Vendor Management", [], TRUE);
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    $vendor_businesses = VendorBussiness::all();
    $vendor_categories = VendorCategory::query()->whereNotNull("parent_category_id")->get();

    return $this->view_admin("admin.vendors.create", "Tambah Vendor", [
      "type" => "create",
      "vendor_businesses" => $vendor_businesses,
      "vendor_categories" => $vendor_categories
    ], FALSE);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(VendorRequest $request)
  {
    $response = $this->vendor_service->store($request);
    return \response_json($response);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Vendor  $vendor
   */
  public function show(Vendor $vendor)
  {
    $data = [
      "vendor" => Vendor::query()
        ->with(["category"])
        ->where("id", $vendor->id)
        ->first(),
      "user" => auth()->user(),
      "vendor_businesses" => VendorBussiness::all(),
      "vendor_categories" => VendorCategory::all(),
      "vendor_types" => VendorType::all(),
    ];

    return $this->view_admin("admin.vendors.show", "Detail Vendor", $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Vendor  $vendor
   */
  public function edit(Vendor $vendor)
  {
    $vendor_businesses = VendorBussiness::all();
    $vendor_categories = VendorCategory::query()->whereNotNull("parent_category_id")->get();

    return $this->view_admin("admin.vendors.edit", "Edit Vendor", [
      "vendor" => $vendor,
      "type" => "edit",
      "vendor_businesses" => $vendor_businesses,
      "vendor_categories" => $vendor_categories
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Vendor  $vendor
   * @return \Illuminate\Http\Response
   */
  public function update(VendorRequest $request, Vendor $vendor)
  {
    $vendor->load('user');
    $response = $this->vendor_service->update($request, $vendor);
    return \response_json($response);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Vendor  $vendor
   * @return \Illuminate\Http\Response
   */
  public function destroy(Vendor $vendor)
  {
    $vendor->delete();

    $response = \response_success_default("Vendor has been deleted!", FALSE, \route("app.vendors.index"));
    return \response_json($response);
  }

  /**
   * Approve the vendor
   *
   * @param  \App\Models\Vendor  $vendor
   */
  public function approve(Vendor $vendor)
  {
    Vendor::query()
    ->where("id", $vendor->id)
    ->update([
      "vendor_status_id" => 3,
    ]);

    User::query()
    ->where("vendor_id", $vendor->id)
    ->update([
      "user_status_id" => 3,
    ]);

    $response = response_success_default(__("Vendor has been approved!"), FALSE, url()->previous());
    return response_json($response);
  }

  /**
   * Decline the vendor
   *
   * @param  \App\Models\Vendor  $vendor
   */
  public function decline(Vendor $vendor)
  {
    Vendor::query()
    ->where("id", $vendor->id)
    ->update([
      "vendor_status_id" => 4,
    ]);

    User::query()
    ->where("vendor_id", $vendor->id)
    ->update([
      "user_status_id" => 4,
    ]);

    $response = response_success_default(__("Vendor has been declined!"), FALSE, url()->previous());
    return response_json($response);
  }
}
