<?php

namespace Database\Seeders;

use App\Models\ProductStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ProductStatus::create([
      'product_status' => 'Pending',
      'color' => 'warning'
    ]);

    ProductStatus::create([
      'product_status' => 'Published',
      'color' => 'success'
    ]);

    ProductStatus::create([
      'product_status' => 'Rejected',
      'color' => 'danger'
    ]);
  }
}
