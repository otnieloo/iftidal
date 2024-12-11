<?php namespace App\Supports;

use App\Models\Order;

class OrderSupport 
{
  /**
   * Generate order number 
   * 
   * @return string
   */
  public function generate_number()
  {
    do {
      $get_last_order = Order::query()->count();
      $get_last_order = $get_last_order + 1;

      $order_number = "INV" . date("ymd") . str_pad($get_last_order, 4, "0", STR_PAD_LEFT);
      $check_order = Order::query()->where('order_number', $order_number)->first();
    } while ($check_order);

    return $order_number;
  }
}