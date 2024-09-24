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
            'product_status' => 'Pending'
        ]);

        ProductStatus::create([
            'product_status' => 'Published'
        ]);

        ProductStatus::create([
            'product_status' => 'Rejected'
        ]);
    }
}
