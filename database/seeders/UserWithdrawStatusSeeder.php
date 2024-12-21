<?php

namespace Database\Seeders;

use App\Models\UserWithdrawStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWithdrawStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    UserWithdrawStatus::create([
      "user_withdraw_status" => "Pending",
      "color" => "warning"
    ]);
    UserWithdrawStatus::create([
      "user_withdraw_status" => "Completed",
      "color" => "success"
    ]);
    UserWithdrawStatus::create([
      "user_withdraw_status" => "Decline",
      "color" => "danger"
    ]);
  }
}
