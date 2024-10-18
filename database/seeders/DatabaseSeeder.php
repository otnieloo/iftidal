<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      RoleSeed::class,
      UserStatusSeeder::class,
      UserSeed::class,
      ModuleSeeder::class,
      ProjectSettingSeed::class,
      VendorStatusSeeder::class,
      VendorSeeder::class,
      ProductConditionSeeder::class,
      ProductLevelSeeder::class,
      ProductCategorySeeder::class,
      ProductStatusSeeder::class,
      VendorTypeSeeder::class,
      VendorBusinessedSeeder::class,
      VendorCategorySeeder::class,

      OrderStatusSeeder::class,
      EventTypeSeeder::class,
      PaymentStatusSeeder::class,
      LocationSeeder::class,
    ]);
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
  }
}
