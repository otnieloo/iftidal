<?php

namespace Database\Seeders;

use App\Models\VendorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    VendorType::create([
      "vendor_type" => "Enterprise"
    ]);
    VendorType::create([
      "vendor_type" => "Sdn Bhd"
    ]);
    VendorType::create([
      "vendor_type" => "Bhd"
    ]);
  }
}
