<?php

namespace Database\Seeders;

use App\Models\VendorBussiness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBusinessedSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    VendorBussiness::create([
      "vendor_business" => "Service"
    ]);
    VendorBussiness::create([
      "vendor_business" => "Product"
    ]);
    VendorBussiness::create([
      "vendor_business" => "Both"
    ]);
  }
}
