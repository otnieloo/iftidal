<?php

namespace App\Console\Commands;

use App\Models\OrderProduct;
use App\Services\CronService;
use Illuminate\Console\Command;

class TestFunction extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'function:test';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $order_products = OrderProduct::all();

    foreach ($order_products as $product) {
      OrderProduct::query()
      ->where("id", $product->id)
      ->update([
        "payment_vendor_available" => $product->grand_total
      ]);
    }
  }
}
