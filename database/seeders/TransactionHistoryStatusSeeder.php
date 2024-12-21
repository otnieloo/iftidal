<?php

namespace Database\Seeders;

use App\Models\TransactionHistoryStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionHistoryStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    TransactionHistoryStatus::create([
      "transaction_history_status" => "Pending",
      "color" => "warning"
    ]);
    TransactionHistoryStatus::create([
      "transaction_history_status" => "Completed",
      "color" => "success"
    ]);
    TransactionHistoryStatus::create([
      "transaction_history_status" => "Failed",
      "color" => "danger"
    ]);
  }
}
