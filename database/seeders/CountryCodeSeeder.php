<?php

namespace Database\Seeders;

use App\Models\CountryCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountryCodeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    CountryCode::create([
      "code" => 6,
      "country" => "Malaysia"
    ]);
    CountryCode::create([
      "code" => 62,
      "country" => "Indonesia"
    ]);
  }
}
