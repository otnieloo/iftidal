<?php

namespace Database\Seeders;

use App\Models\VendorCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    VendorCategory::create([
      "vendor_category" => "Accessories"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Jewelry & Trinkets"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Props"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Wigs"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Mask"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Shoes"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Hats / Caps"
    ]);
    VendorCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "vendor_category" => "Shawls / Viei"
    ]);

    VendorCategory::create([
      "vendor_category" => "Agency"
    ]);
    $agency_id = VendorCategory::where("vendor_category", "Agency")->first()->id;
    VendorCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "vendor_category" => "Travel"
    ]);
    VendorCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "vendor_category" => "Pre-Marriage Course"
    ]);
    VendorCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "vendor_category" => "Hotel"
    ]);
    VendorCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "vendor_category" => "Rental Car / Boat / Helicopter"
    ]);
  }
}
