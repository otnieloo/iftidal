<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserBalance;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function __invoke(Request $request)
  {
    $events = Order::query()
    ->select('id', 'event_guest_count', 'event_date', 'event_start_time', 'event_name')
    ->where('user_id', $request->user()->id)
    ->get();

    $data = [
      'vendors' => OrderProduct::query()
      ->with("order")
      ->whereHas("order", function($query) {
        return $query->where("user_id", request()->user()->id);
      })
      ->groupBy("vendor_id")
      ->get(),

      "events" => $events,
      "balance" => UserBalance::query()->where("user_id", $request->user()->id)->first(),
      "guests" => Guest::query()->where("user_id", $request->user()->id)->get(),
    ];

    return $this->view("users.index", "Dashboard", $data, TRUE);
  }
}
