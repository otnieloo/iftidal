<?php

namespace Database\Seeders;

use App\Models\OrderVendorStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderVendorStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    OrderVendorStatus::create([
      "order_vendor_status" => "Watch",
      "color" => "41AAC4"
    ]);
    OrderVendorStatus::create([
      "order_vendor_status" => "Deposit",
      "color" => "41AAC4"
    ]);
    OrderVendorStatus::create([
      "order_vendor_status" => "Delivery",
      "color" => "FE9310"
    ]);
    OrderVendorStatus::create([
      "order_vendor_status" => "Completed",
      "color" => "78D11E"
    ]);
    OrderVendorStatus::create([
      "order_vendor_status" => "Cancelled",
      "color" => "F092A8"
    ]);
    OrderVendorStatus::create([
      "order_vendor_status" => "Return/Refund",
      "color" => "F092A8"
    ]);
    OrderVendorStatus::create([
      "order_vendor_status" => "Dispute",
      "color" => "F092A8"
    ]);
  }
}
