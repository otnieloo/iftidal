<?php namespace App\Services;

use App\Http\Requests\CustomerRequest;
use App\Models\User;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use Illuminate\Support\Facades\Hash;

class CustomerService extends BaseService
{
  /**
   * Store new customer
   * 
   * @param CustomerRequest $request
   */
  public function store(CustomerRequest $request)
  {
    $response = create_response();
    $error = FALSE;
    $this->trans_begin();

    try  {
      $values = [
        "name" => $request->name,
        "email" => $request->email,
        "user_status_id" => $request->user_status_id,
        "role_id" => 3,
        "password" => Hash::make($request->password)
      ];

      $user = User::create($values);
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "CustomerService::store");
      }
    }

    end:
    if ($error) {
      $this->trans_rollback();
    } else {
      $this->trans_commit();
      $response = response_success_default(__("Success created new customer!"), $user->id, route("app.customers.index"));
    }

    return $response;
  }

  /**
   * Update customer
   * 
   * @param CustomerRequest $request
   */
  public function update(CustomerRequest $request, User $customer)
  {
    $response = create_response();
    $error = FALSE;
    $this->trans_begin();

    try  {
      $values = [
        "name" => $request->name,
        "email" => $request->email,
        "user_status_id" => $request->user_status_id,
      ];

      if ($request->filled("password")) {
        $values["password"] = Hash::make($request->password);
      }

      User::query()
      ->where("id", $customer->id)
      ->update($values);
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "CustomerService::update");
      }
    }

    end:
    if ($error) {
      $this->trans_rollback();
    } else {
      $this->trans_commit();
      $response = response_success_default(__("Success updatd customer!"), FALSE, route("app.customers.index"));
    }

    return $response;
  }
}