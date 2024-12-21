<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    OrderStatus::create([
      "order_status" => "On-Created"
    ]);
    OrderStatus::create([
      "order_status" => "Upcoming"
    ]);
    OrderStatus::create([
      "order_status" => "Ingoing"
    ]);
    OrderStatus::create([
      "order_status" => "Completed"
    ]);
    OrderStatus::create([
      "order_status" => "Cancelled"
    ]);
  }
}
