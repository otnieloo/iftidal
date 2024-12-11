<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
    $event = Order::select('id', 'event_guest_count', 'event_date', 'event_start_time', 'event_name')->where('user_id', $request->user()->id)->get();
    $incoming_event = $event->filter(function ($e) {
      return date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($e->event_date . ' ' . $e->event_start_time));
    });


    $data = [
      'vendor' => Vendor::select('id')->get(),
      'event' => $event,
      'incoming_event' => $incoming_event,
      'incoming_guest' => $event->sum('event_guest_count')
    ];


    return $this->view("users.index", "Dashboard", $data, TRUE);
  }
}
