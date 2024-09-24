<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    UserStatus::create([
      "user_status" => "Registered"
    ]);
    UserStatus::create([
      "user_status" => "Review"
    ]);
    UserStatus::create([
      "user_status" => "Approved"
    ]);
    UserStatus::create([
      "user_status" => "Declined"
    ]);
  }
}
