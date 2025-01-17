<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Role::create([
      "role_name" => "Super Admin"
    ]);

    Role::create([
      "role_name" => "Vendor",
      "division" => 2
    ]);

    Role::create([
      "role_name" => "Customer",
      "division" => 3
    ]);
  }
}
