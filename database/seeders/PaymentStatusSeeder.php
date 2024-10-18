<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::create([
            "payment_status" => "Unpaid"
        ]);
        PaymentStatus::create([
            "payment_status" => "Down Payment"
        ]);
        PaymentStatus::create([
            "payment_status" => "Paid"
        ]);
    }
}
