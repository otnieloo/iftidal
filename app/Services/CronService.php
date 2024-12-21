<?php namespace App\Services;

      use App\Models\User;
      use App\Models\UserBalance;
      use App\Services\Cores\BaseService;

class CronService extends BaseService
{
  /**
   * Store balance user existsing
   *
   * @return void
   */
  public function store_user_balance()
  {
    $users = User::query()
    ->where("role_id", 3)
    ->get();

    foreach ($users as $user) {
      UserBalance::create([
        "user_id" => $user->id,
      ]);
    }
  }
}
