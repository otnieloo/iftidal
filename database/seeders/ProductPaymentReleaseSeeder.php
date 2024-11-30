<?php

namespace Database\Seeders;

use App\Models\ProductPaymentRelease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPaymentReleaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ProductPaymentRelease::create([
      "payment_release" => "10% now, 90% later",
    ]);
    ProductPaymentRelease::create([
      "payment_release" => "20% now, 80% later",
    ]);
    ProductPaymentRelease::create([
      "payment_release" => "30% now, 70% later",
    ]);
    ProductPaymentRelease::create([
      "payment_release" => "40% now, 60% later",
    ]);

    ProductPaymentRelease::create([
      "payment_release" => "30% now, 30% midway, 40% later",
    ]);
    ProductPaymentRelease::create([
      "payment_release" => "25% now, 25% midway, 50% later",
    ]);
    ProductPaymentRelease::create([
      "payment_release" => "10% now, 40% midway, 50% later",
    ]);
  }
}
