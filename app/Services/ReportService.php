<?php namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\Cores\BaseService;
use Illuminate\Http\Request;

class ReportService extends BaseService
{
  /**
   * Get report graph dashboard
   *
   * @param \Illuminate\Http\Request $request
  */
  public function get_graphs_dashboard_user(Request $request)
  {
    $type = $request->query("type");
    $vendor_id = auth()->user()->vendor_id;
    $reports = [];

    if ($type == "Monthly") {
      for ($i = 1; $i <= 12; $i++) {
        $month_name = date("F", mktime(0, 0, 0, $i, 10));
        $month = $i < 10 ? "0$i": $i;

        $get_month_now = Order::query()
        ->where("user_id", auth()->user()->id)
        ->whereMonth("event_date", $month)
        ->whereYear("event_date", date("Y"))
        ->sum("grand_total");

        $get_month_prev = Order::query()
        ->where("user_id", auth()->user()->id)
        ->whereMonth("event_date", $month)
        ->whereYear("event_date", date("Y", strtotime("-1 year")))
        ->sum("grand_total");

        $reports[] = [
          "month" => $month,
          "month_name" => $month_name,
          "now" => $get_month_now,
          "prev" => $get_month_prev
        ];
      }
    } else {
      for ($i = 1; $i <= date("t"); $i++) {
        $day = $i < 10 ? "0$i": $i;

        $day_now = date("Y-m-$day");
        $day_prev = date("Y-m-$day", strtotime("-1 month"));

        $get_day_now = Order::query()
        ->where("user_id", auth()->user()->id)
        ->where("event_date", $day_now)
        ->sum("grand_total");

        $get_day_prev = Order::query()
        ->where("user_id", auth()->user()->id)
        ->where("event_date", $day_prev)
        ->sum("grand_total");

        $reports[] = [
          "day" => $day_now,
          "now" => $get_day_now,
          "prev" => $get_day_prev,
        ];
      }
    }

    $response = response_data($reports);
    return $response;
  }

  /**
   * Get report graph dashboard
   *
   * @param \Illuminate\Http\Request $request
  */
  public function get_graphs_dashboard(Request $request)
  {
    $type = $request->query("type");
    $vendor_id = auth()->user()->vendor_id;
    $reports = [];

    if ($type == "Monthly") {
      for ($i = 1; $i <= 12; $i++) {
        $month_name = date("F", mktime(0, 0, 0, $i, 10));
        $month = $i < 10 ? "0$i": $i;

        $get_month_now = OrderProduct::query()
        ->whereHas("order", function($query) use ($month) {
          return $query->whereMonth("event_date", $month)->whereYear("event_date", date("Y"));
        })
        ->where("vendor_id", $vendor_id)
        ->sum("grand_total");

        $get_month_prev = OrderProduct::query()
        ->whereHas("order", function($query) use ($month) {
          return $query->whereMonth("event_date", $month)->whereYear("event_date", date("Y") - 1);
        })
        ->where("vendor_id", $vendor_id)
        ->sum("grand_total");

        $reports[] = [
          "month" => $month,
          "month_name" => $month_name,
          "now" => $get_month_now,
          "prev" => $get_month_prev
        ];
      }
    } else {
      for ($i = 1; $i <= date("t"); $i++) {
        $day = $i < 10 ? "0$i": $i;

        $day_now = date("Y-m-$day");
        $day_prev = date("Y-m-$day", strtotime("-1 month"));

        $get_day_now = OrderProduct::query()
        ->whereHas("order", function($query) use ($day_now) {
          return $query->where("event_date", $day_now);
        })
        ->where("vendor_id", $vendor_id)
        ->sum("grand_total");

        $get_day_prev = OrderProduct::query()
        ->whereHas("order", function($query) use ($day_prev) {
          return $query->where("event_date", $day_prev);
        })
        ->where("vendor_id", $vendor_id)
        ->sum("grand_total");

        $reports[] = [
          "day" => $day_now,
          "now" => $get_day_now,
          "prev" => $get_day_prev,
        ];
      }
    }

    $response = response_data($reports);
    return $response;
  }
}
