<?php

namespace Database\Seeders;

use App\Models\GuestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    GuestStatus::create([
      "status_name" => "Maybe",
      "color" => "warning"
    ]);
    GuestStatus::create([
      "status_name" => "Yes",
      "color" => "success"
    ]);
    GuestStatus::create([
      "status_name" => "No",
      "color" => "danger"
    ]);
  }
}
