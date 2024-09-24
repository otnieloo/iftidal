<?php

namespace Database\Seeders;

use App\Models\VendorStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    VendorStatus::create([
      "vendor_status" => "Registered"
    ]);
    VendorStatus::create([
      "vendor_status" => "Review"
    ]);
    VendorStatus::create([
      "vendor_status" => "Approved"
    ]);
    VendorStatus::create([
      "vendor_status" => "Declined"
    ]);
  }
}
