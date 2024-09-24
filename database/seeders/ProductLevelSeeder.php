<?php

namespace Database\Seeders;

use App\Models\ProductLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductLevelSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ProductLevel::create([
      'product_level' => 'Beginner',
    ]);

    ProductLevel::create([
      'product_level' => 'Intermediate',
    ]);

    ProductLevel::create([
      'product_level' => 'Expert',
    ]);
  }
}
