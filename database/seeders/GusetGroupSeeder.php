<?php

namespace Database\Seeders;

use App\Models\GuestGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GusetGroupSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    GuestGroup::create([
      "group_name" => "Family"
    ]);
    GuestGroup::create([
      "group_name" => "Friend"
    ]);
    GuestGroup::create([
      "group_name" => "Officemate"
    ]);
    GuestGroup::create([
      "group_name" => "Neighbour"
    ]);
  }
}
