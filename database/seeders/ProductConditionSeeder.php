<?php

namespace Database\Seeders;

use App\Models\ProductCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductConditionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ProductCondition::create([
      'product_condition' => 'Brand New',
    ]);

    ProductCondition::create([
      'product_condition' => 'Used',
    ]);
  }
}
