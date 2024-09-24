<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ProductCategory::create([
      "category" => "Accessories"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Jewelry & Trinkets"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Props"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Wigs"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Mask"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Shoes"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Hats / Caps"
    ]);
    ProductCategory::create([
      "parent_category_id" => 1,
      "parent_category" => "Accessories",
      "category" => "Shawls / Viei"
    ]);

    ProductCategory::create([
      "category" => "Agency"
    ]);
    $agency_id = ProductCategory::where("category", "Agency")->first()->id;
    ProductCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "category" => "Travel"
    ]);
    ProductCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "category" => "Pre-Marriage Course"
    ]);
    ProductCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "category" => "Hotel"
    ]);
    ProductCategory::create([
      "parent_category_id" => $agency_id,
      "parent_category" => "Agency",
      "category" => "Rental Car / Boat / Helicopter"
    ]);
  }
}
