<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Department::create([
      "department" => "Inventory"
    ]);
    Department::create([
      "department" => "Logistics"
    ]);
    Department::create([
      "department" => "Packaging"
    ]);
    Department::create([
      "department" => "Delivery"
    ]);
    Department::create([
      "department" => "Sales"
    ]);
  }
}
