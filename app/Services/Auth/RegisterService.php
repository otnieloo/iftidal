<?php namespace App\Services\Auth;
      use App\Http\Requests\RegisterVendorRequest;
      use App\Models\User;
      use App\Models\Vendor;
      use App\Services\Cores\BaseService;
      use App\Services\Cores\ErrorService;
      use Illuminate\Auth\Events\Registered;
      use Illuminate\Support\Facades\Hash;

class RegisterService extends BaseService
{
  /**
   * Register vendor
   *
   * @param RegisterVendorRequest $request
   */
  public function store_vendor(RegisterVendorRequest $request)
  {
    $response = create_response();
    $error = FALSE;
    $this->trans_begin();

    try  {
      $values_vendor = [
        "vendor_status_id" => 1,
        "vendor_category_id" => $request->vendor_category_id,
        "vendor_business_id" => $request->vendor_business_id,
        "vendor_type_id" => $request->vendor_type_id,
        "company_name" => $request->company_name,
        "company_phone" => "",
        "company_email" => $request->email,
        "company_address" => "",
        "company_legal_number" => $request->company_legal_number,
        "contact_person_name" => $request->name,
        "contact_person_phone" => "",
        "contact_person_email" => $request->email,
        "register_date" => date("Y-m-d")
      ];
      $vendor = Vendor::create($values_vendor);

      $array_name = explode(" ", $request->name);
      do {
        $username = $array_name . rand(1, 99999);
        $check_exists = User::query()->where("username", $username)->exists();
      } while ($check_exists);

      $values_user = [
        "vendor_id" => $vendor->id,
        "role_id" => 2,
        "user_status_id" => 1,
        "name" => $request->name,
        "email" => $request->email,
        "username" => $username,
        "password" => Hash::make($request->password),
      ];
      $user = User::create($values_user);

      event(new Registered($user));
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "RegisterService::store_vendor");
      }
    }

    end:
    if ($error) {
      $this->trans_rollback();
    } else {
      $this->trans_commit();
      $response = response_success_default(__("Successfully registered! Please check your email!"));
    }

    return $response;
  }
}
