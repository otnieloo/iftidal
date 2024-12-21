<?php namespace App\Services;

      use App\Http\Requests\UserWithdrawRequest;
      use App\Models\TransactionHistory;
      use App\Models\UserBalance;
      use App\Models\UserWithdraw;
      use App\Services\Cores\BaseService;
      use App\Supports\TransactionNumberSupport;

class WithdrawService extends BaseService
{
  /**
   * Store withdraw
   *
   * @param \App\Http\Requests\UserWithdrawRequest $request
   * @return \stdClass
   */
  public function store_withdraw(UserWithdrawRequest $request)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try  {
      $user_balance = UserBalance::query()
      ->where("user_id", auth()->user()->id)
      ->first();

      if ($request->amount > $user_balance->credit_balance) {
        $error = TRUE;
        $response->message = "Balance not available!";
        $response->status_code = 403;
        goto end;
      }

      $values = [
        "user_id" => auth()->user()->id,
        "user_withdraw_status_id" => 1,
        "withdraw_number" => (new TransactionNumberSupport)->generate_withdraw_number(),
        "withdraw_time" => date("Y-m-d H:i:s"),
        "withdraw_amount" => $request->amount,
        "information_bank" => $request->information_bank,
      ];

      $wd = UserWithdraw::create($values);

      $values = [
        "user_id" => $wd->user_id,
        "transaction_history_status_id" => 1,
        "transaction_history_type_id" => 3,
        "transaction_time" => date("Y-m-d H:i:s"),
        "transaction_number" => $wd->withdraw_number,
        "description" => "Topup Wallet",
        "amount" => $wd->withdraw_amount,
        "reference_id" => $wd->id,
        "route" => "user.financials.index"
      ];
      TransactionHistory::create($values);

      UserBalance::query()
      ->where("user_id", auth()->user()->id)
      ->decrement("credit_balance", $request->amount);
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "WithdrawService::store_withdraw");
      }
    }

    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_success_default("Request withdraw created!", FALSE, route("user.financials.index"));
    }

    return $response;
  }
}
