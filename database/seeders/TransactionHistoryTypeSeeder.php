<?php

namespace Database\Seeders;

use App\Models\TransactionHistoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionHistoryTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    TransactionHistoryType::create([
      "transaction_history_type" => "Deposit",
    ]);
    TransactionHistoryType::create([
      "transaction_history_type" => "Top Up",
    ]);
    TransactionHistoryType::create([
      "transaction_history_type" => "Withdraw",
    ]);
  }
}
