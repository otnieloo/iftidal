<?php

namespace App\Services;

use App\Http\Livewire\Apps\Users\Financials\TransactionHistory;
use App\Http\Requests\UserRequest;
use App\Models\SessionToken;
use App\Models\User;
use App\Models\UserBalance;
use App\Models\UserWalletTopup;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use App\Supports\TransactionNumberSupport;
use App\Validations\UserValidation;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
  /**
   * Generate query index page
   *
   * @param Request $request
   */
  private function generate_query_get(Request $request)
  {
    $column_search = ["users.name", "users.email", "r.role_name"];
    $column_order = [NULL, "users.name", "users.email", "r.role_name"];
    $order = ["users.id" => "DESC"];

    $results = User::query()
      ->join("roles AS r", "r.id", "users.role_id")
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

    if (auth()->user()->role_id != 1) {
      $results->where("role_id", "!=", 1);
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
   * Store new user
   *
   * @param Request $request
   */
  public function store(UserRequest $request)
  {
    try {
      $values = $request->validated();
      $values["password"] = Hash::make($values["password"]);
      $user = User::create($values);

      $response = \response_success_default("Berhasil menambahkan user!", $user->id, route("app.users.show", $user->id));
    } catch (\Exception $e) {
      ErrorService::error($e, "Gagal store user!");
      $response = \response_errors_default();
    }

    return $response;
  }

  /**
   * Update new user
   *
   * @param Request $request
   * @param User $user
   */
  public function update(UserRequest $request, User $user)
  {
    try {
      $user_id = $user->id;
      $values = $request->validated();
      if ($values["password"]) {
        $values["password"] = Hash::make($values["password"]);
      } else {
        unset($values["password"]);
      }

      // dd($values);
      $user->update($values);

      $response = \response_success_default("Berhasil update data user!", $user_id, route("app.users.show", $user->id));
    } catch (\Exception $e) {
      ErrorService::error($e, "Gagal update user!");
      $response = \response_errors_default();
    }

    return $response;
  }

  /**
   * Get last admin online
   *
   */
  public function get_admin_online()
  {
    $query = SessionToken::query()
      ->select([
        "u.name",
        "session_tokens.active_time",
        "u.id",
        DB::raw("MAX(session_tokens.active_time) AS max_time")
      ])
      ->join("users AS u", "u.id", "session_tokens.user_id")
      ->where("is_login", 1)
      ->having("max_time", ">", DB::raw("(NOW() - INTERVAL 15 MINUTE)"))
      ->groupBy("session_tokens.user_id")
      ->get()
      ->map(function ($item) {
        $to_time = strtotime(date("Y-m-d H:i:s"));
        $from_time = strtotime($item->max_time);
        $last_active = round(abs($to_time - $from_time) / 60);
        if ($last_active <= 0) {
          $last_active = "Active";
        } else {
          $last_active .= "m ago";
        }

        $item->last_active = $last_active;
        return $item;
      });

    return $query;
  }

  /**
   * store wallet customer
   *
   * @param \Illuminate\Http\Request $request
   * @return \stdClass
   */
  public function store_wallet(Request $request)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try  {
      if (!$request->amount) {
        $error = TRUE;
        $response->message = "Amount is required!";
        $response->status_code = 400;
        goto end;
      }

      $values = [
        "user_id" => auth()->user()->id,
        "transaction_number" => (new TransactionNumberSupport)->generate_wallet_number(),
        "transaction_time" => date("Y-m-d H:i:s"),
        "amount" => $request->amount,
      ];

      $trx = UserWalletTopup::create($values);
      $key = env('SECRET_INFINPAY');
      $apiKey = env('API_KEY_INFINPAY');

      $payload = [
        'merchant_code' => env("MERCHANT_INFINPAY"),
        "merchant_reference" => $trx->transaction_number,
        'amount' => $trx->amount,
        'currency' => 'MYR',
        'description' => "Transaction for wallet number $trx->transaction_number",
        'response_url' => url("user/wallet/finish-payment"),
        'payment_update_url' => url("user/wallet/finish-payment"),
        'customer' => [
          'customer_name' => auth()->user()->name,
          'customer_email' => auth()->user()->email
        ],
        'enable_auto_capture' => "false",
        'payment_type' => [
          'card' => 'true',
          'ewallet' => 'true',
          'online_banking' => 'true'
        ]
      ];
      // dd($payload);

      $jwt = JWT::encode($payload, base64_decode($key), 'HS256', $apiKey);

      $response->status_code = 200;
      $response->message = "Success";
      $response->data = $jwt;
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "UserService::store_wallet");
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
    }

    return $response;
  }

  /**
   * Handle payment callback
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\stdClass
   */
  public function handle_payment(Request $request)
  {
    $response = create_response();
    $error = FALSE;

    // Start Database Transaction
    $this->trans_begin();

    // Let's start!
    try {
      $key = env('SECRET_INFINPAY');
      $decode = JWT::decode($request->jwt, new Key(base64_decode($key), 'HS256'));
      info("FInish Topup Wallet", (array) $decode);

      if ($decode) {
        $trx_code = $decode->transaction->result_code;

        if ($trx_code == 0) {
          $status = $decode->transaction->payment_status;

          if (in_array(env("APP_ENV"), ["local", "staging"])) {
            $check_status = in_array($status, ["SALES", "Captured"]);
          } else {
            $check_status = in_array($status, ["Captured"]);
          }

          if ($check_status) {
            $trx = UserWalletTopup::query()->where("transaction_number", $decode->merchant_reference)->first();

            if ($trx) {
              UserWalletTopup::query()
              ->where("id", $trx->id)
              ->update([
                "is_payment" => 1,
                "pg_reference" => $decode->transaction->transaction_reference,
              ]);

              UserBalance::query()
                ->where("user_id",  $trx->user_id)
                ->increment("wallet", $trx->amount);

              $values = [
                "user_id" => $trx->user_id,
                "transaction_history_status_id" => 2,
                "transaction_history_type_id" => 2,
                "transaction_time" => date("Y-m-d H:i:s"),
                "transaction_number" => $trx->transaction_number,
                "description" => "Topup Wallet",
                "amount" => $trx->amount,
                "reference_id" => $trx->id,
                "route" => "user.financials.index"
              ];

              \App\Models\TransactionHistory::create($values);
            } else {
              $error = TRUE;
              $response->message = "Order Not Found!";
            }
          } else {
            $error = TRUE;
            $response->message = "Order Payment Failed!";
            $response->status_code = 400;
          }
        } else {
          $error = TRUE;
          $response->message = "Order Payment Failed!";
          $response->status_code = 400;
        }
      } else {
        $error = TRUE;
        $response->message = "Invalid Signature!";
        $response->status_code = 403;
      }
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "UserService::handle_payment");
      }
    }

    info("Results Payment Wallet", (array) $response);
    // Final check
    end:
    if ($error) {
      // If have error, Rollback database
      $this->trans_rollback();
    } else {
      // Success, commit database and return response success
      $this->trans_commit();
      $response = response_success_default("Payment Success!");
    }

    return $response;
  }
}
