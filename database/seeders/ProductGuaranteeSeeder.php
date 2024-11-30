<?php

namespace Database\Seeders;

use App\Models\ProductGuarantee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGuaranteeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ProductGuarantee::create([
      "product_guarantee" => "100% Refundable",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Alternative Service",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Discount",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Goodwill Compensation",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Partial Refund",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Pro-Rated Refundable",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Replacement",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Replacement Vendor",
    ]);
    ProductGuarantee::create([
      "product_guarantee" => "Service Redo",
    ]);
  }
}
