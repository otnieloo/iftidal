<?php

namespace Database\Seeders;

use App\Models\PaymentVendorStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentVendorStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    PaymentVendorStatus::create([
      "payment_vendor_status" => "Pending",
      "color" => "warning"
    ]);
    PaymentVendorStatus::create([
      "payment_vendor_status" => "Partialy",
      "color" => "success"
    ]);
    PaymentVendorStatus::create([
      "payment_vendor_status" => "Completed",
      "color" => "grey"
    ]);
    PaymentVendorStatus::create([
      "payment_vendor_status" => "Cancelled",
      "color" => "danger"
    ]);
  }
}
