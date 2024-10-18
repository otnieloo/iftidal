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
            "order_status" => "Created"
        ]);
        OrderStatus::create([
            "order_status" => "Process Approval"
        ]);
        OrderStatus::create([
            "order_status" => "Approval"
        ]);
        OrderStatus::create([
            "order_status" => "On Progress"
        ]);
        OrderStatus::create([
            "order_status" => "Finish"
        ]);
    }
}
