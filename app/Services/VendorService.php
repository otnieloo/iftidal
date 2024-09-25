<?php

namespace App\Services;

use App\Http\Requests\ProfileVendorRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VendorRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorStatus;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorService extends BaseService
{
  /**
   * Generate query index page
   *
   * @param Request $request
   */
  private function generate_query_get(Request $request)
  {
    $column_search = ["vendors.company_name", "vendors.company_phone", "vendors.company_email", "vendors.company_address", "vendors.contact_person_name", "vendors.contact_person_phone", "vendors.contact_person_email", "vendors.register_date", "vendors.approved_date"];
    $column_order = [NULL, "vendors.company_name", "vendors.company_phone", "vendors.company_email", "vendors.company_address", "vendors.contact_person_name", "vendors.contact_person_phone", "vendors.contact_person_email", "vendors.register_date", "vendors.approved_date"];
    $order = ["vendors.id" => "DESC"];

    $results = Vendor::query()
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

  public function get_list_paged(Request $request)
  {
    $results = $this->generate_query_get($request);
    if ($request->length != -1) {
      $limit = $results->offset($request->start)->limit($request->length);
      return $limit->get();
    }
  }

  public function get_list_count(Request $request)
  {
    return $this->generate_query_get($request)->count();
  }

  /**
   * Store new vendor
   *
   * @param Request $request
   */
  public function store(VendorRequest $request)
  {
    DB::beginTransaction();
    try {
      $values = $request->validated();

      [$newImage, $movedFile] = move_tmp_file($values['tmp'], 'logo');
      $values['logo'] = $newImage;


      $values['vendor_status_id'] = 3;
      $vendor = Vendor::create($values);


      $user_data = [
        'email' => $request->email,
        'password' => $request->password,
        'name' => $request->name,
        'role_id' => Role::where('division', 2)->first()->id,
        'vendor_id' => $vendor->id,
        'user_status_id' => 3,
        'email_verified_at' => date("Y-m-d H:i:s"),
      ];



      $user = $this->create_user($user_data);

      $response = \response_success_default("Vendor has been created!", $vendor->id, route("app.vendors.index"));
    } catch (\Exception $e) {
      DB::rollBack();
      ErrorService::error($e, "Failed create vendor!");
      $response = \response_errors_default();
    }

    DB::commit();

    return $response;
  }


  public function create_user($data)
  {
    $array_name = explode(" ", $data['name']);
    $username = '';
    do {
      $username = $array_name[0] . rand(1, 99999);
      $check_exists = User::query()->where("username", $username)->exists();
    } while ($check_exists);

    $data['username'] = $username;
    $data["password"] = Hash::make($data['password']);
    $user = User::create($data);

    return $user;
  }


  public function update_user($data)
  {
    $array_name = explode(" ", $data['name']);
    $username = '';
    do {
      $username = $array_name[0] . rand(1, 99999);
      $check_exists = User::query()->where("username", $username)->exists();
    } while ($check_exists);

    $data['username'] = $username;
    $data["password"] = Hash::make($data['password']);
    $user = User::create($data);

    return $user;
  }

  /**
   * Update new vendor
   *
   * @param Request $request
   * @param Vendor $vendor
   */
  public function update(VendorRequest $request, Vendor $vendor)
  {
    try {
      $vendor_id = $vendor->id;
      $values = $request->validated();


      $oldImage = $vendor->logo;
      if ($request->has('tmp')) {
        [$newImage, $movedFile] = move_tmp_file($values['tmp'], 'logo');
        $values['logo'] = $newImage;
      }


      $vendor->update($values);

      $user_data = [
        'email' => $request->email,
        'name' => $request->name,
      ];

      if ($request->password) {
        $user_data['password'] = Hash::make($request->password);
      }
      $vendor->user->update($user_data);

      $response = \response_success_default("Vendor has been updated!", $vendor_id, route("app.vendors.show", $vendor->id));
    } catch (\Exception $e) {
      dd($e->getMessage());
      ErrorService::error($e, "Gagal update user!");
      $response = \response_errors_default();
    }


    if ($request->has('tmp')) {
      Storage::delete($oldImage);
    }

    return $response;
  }

  /**
   * Update profile vendor
   *
   * @param \App\Http\Requests\ProfileVendorRequest $request
   */
  public function update_profile_vendor(ProfileVendorRequest $request)
  {
    $response = create_response();
    $error = FALSE;
    $this->trans_begin();

    try {
      $values = $request->validated();
      $vendor = Vendor::query()->where("id", auth()->user()->vendor_id)->first();

      if ($request->hasFile("company_logo")) {
        $file = $request->file("company_logo");
        $values["logo"] = $file_name = $file->hashName();
        $file->move("./assets/images/vendors-logo/", $file_name);

        if (!empty($vendor->logo)) {
          unlink("./assets/images/vendors-logo/" . basename($vendor->logo));
        }
      }

      if ($request->hasFile("company_banner_logo")) {
        $file = $request->file("company_banner_logo");
        $values["company_banner_logo"] = $file_name = $file->hashName();
        $file->move("./assets/images/vendors-logo/", $file_name);

        if (!empty($vendor->company_banner_logo)) {
          unlink("./assets/images/vendors-logo/" . basename($vendor->company_banner_logo));
        }
      }
      $values["vendor_status_id"] = 2;
      unset($values["company_logo"]);

      // dd($values);
      Vendor::query()
        ->where("id", $vendor->id)
        ->update($values);
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "VendorService::update_profile_vendor");
      }
    }

    end:
    if ($error) {
      $this->trans_rollback();
    } else {
      $this->trans_commit();
      $response = response_success_default(__("Vendor has been updated!"), $vendor->id, route("vendor.profiles.index", ["tab" => "editTab"]));
    }

    return $response;
  }
}
