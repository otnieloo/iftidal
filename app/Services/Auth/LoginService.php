<?php

namespace App\Services\Auth;

use App\Models\ProjectSetting;
use App\Models\SessionToken;
use App\Models\User;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginService extends BaseService
{
  /**
   * Create a session token
   *
   * @param int $user_id
   */
  private function create_session_token($user_id)
  {
    do {
      $token = random_string(20);
      $check_exists = SessionToken::query()->where("session_token", $token)->exists();
    } while ($check_exists);

    SessionToken::create([
      "user_id" => $user_id,
      "session_token" => $token,
      "active_time" => date("Y-m-d H:i:s"),
      "expire_time" => date("Y-m-d H:i:s", strtotime("+200minute")),
      "is_login" => 1
    ]);

    session(["session_token" => $token]);
  }

  /**
   * Check login multi device
   *
   * @param int $user_id
   * @return bool
   */
  private function check_multi_login($user_id)
  {
    $check_allow_multi_login = ProjectSetting::query()->where("multi_login_device", 1)->exists();

    if (!$check_allow_multi_login) {
      $get_user_login = SessionToken::query()->where("user_id", $user_id)->where("is_login", 1)->where("expire_time", ">", date("Y-m-d H:i:s"))->exists();

      if ($get_user_login) {
        return FALSE;
      }
    }

    return TRUE;
  }

  /**
   * Store login
   *
   * @param Request $request
   */
  public function login(Request $request)
  {
    $response = \create_response();

    $get_user = User::where(function ($query) use ($request) {
      $query->where("email", $request->email)->orWhere("username", $request->email);
    })
      ->whereNotNull("username")
      ->first();

    if ($get_user) {
      if (Hash::check($request->password, $get_user->password)) {
        $check_multi_login = $this->check_multi_login($get_user->id);

        if (!$check_multi_login) {
          $response->message = __("Currently user has login in another device!");
          $response->status_code = 403;
          goto end;
        }

        if (!$get_user->email_verified_at) {
          $response->message = __("Please verify your email first!");
          $response->status_code = 403;
          goto end;
        }

        if ($get_user->user_status_id == 2) {
          $response->message = __("Your account will be review!");
          $response->status_code = 403;
          goto end;
        }

        if ($get_user->user_status_id == 4) {
          $response->message = __("Your account has been banned!");
          $response->status_code = 403;
          goto end;
        }

        $remember = $request->has("remember_me");
        Auth::loginUsingId($get_user->id, $remember);

        $this->create_session_token($get_user->id);
        $response->status = TRUE;
        $response->status_code = 200;
        $response->message = __("Success login!");

        if ($get_user->role->division == 1) {
          $response->next_url = \route("app.dashboard");
        } else if ($get_user->role->division == 2) {
          $response->next_url = \route("vendor.dashboard.index");
        } else {
          $response->next_url = route('user.dashboard.index');
        }
      } else {
        $response->message = __("Wrong password!");
        $response->status_code = 403;
      }
    } else {
      $response->message = __("User not found!");
      $response->status_code = 403;
    }

    end:
    return $response;
  }

  /**
   * Login with google
   *
   * @param Request $request
   */
  public function login_google(Request $request)
  {
    $response = create_response();
    $error = FALSE;
    $this->trans_begin();

    try  {
      $get_account = Socialite::driver("google")->user();
      // dd($get_account);

      $get_user = User::query()
      ->where("email", $get_account->email)
      ->first();

      if ($get_user) {
        $user = $get_user;

        if (!$user->email_verified_at) {
          $values = [
            "email_verified_at" => date("Y-m-d H:i:s"),
            // "user_status_id" => 3
          ];

          User::query()
          ->where("id", $user->id)
          ->update($values);
        }
      } else {
        $array_name = explode(" ", $get_account->getName());
        do {
          $username = $array_name[0].rand(1000, 9999);
          $check_exists = User::query()->where("username", $username)->exists();
        } while ($check_exists);

        $values = [
          "google_id" => $get_account->getId(),
          "role_id" => 3,
          "user_status_id" => 3,
          "name" => $get_account->getName(),
          "email" => $get_account->getEmail(),
          "username" => $username,
          "email_verified_at" => date("Y-m-d H:i:s"),
          "password" => Hash::make($get_account->getId()),
        ];

        $user = User::create($values);
      }

      Auth::loginUsingId($user->id, TRUE);
      $this->create_session_token($user->id);

      $response->status = TRUE;
      $response->status_code = 200;
      $response->message = __("Success login!");

      if ($user->role->division == 1) {
        $response->next_url = "app.dashboard";
      } else if ($user->role->division == 2) {
        $response->next_url = "vendor.dashboard.index";
      } else {
        $response->next_url = "user.dashboard.index";
      }
    } catch (\Exception $e) {
      $error = TRUE;
      if ($e->getCode() == 403) {
        $response->message = $e->getMessage();
        $response->status_code = 403;
      } else {
        $response = response_errors_default();
        ErrorService::error($e, "AccountService::store");
      }
    }

    end:
    if ($error) {
      $this->trans_rollback();
    } else {
      $this->trans_commit();
    }

    return $response;
  }
}
