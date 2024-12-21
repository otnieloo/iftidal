<?php

namespace App\Http\Livewire\Apps\Users\Vendors;

use App\Models\OrderProduct;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  public $keyword;
  public $vendor_category_id;
  public $event_date;
  public $order_status_id;
  public $payment_vendor_status_id;

  public $sort_column = 'order_products.id'; // Default column
  public $sort_direction = 'asc'; // Default direction

  protected $listeners = ["set_keyword", "set_filter"];

  public function sortBy($column)
  {
    if ($this->sort_column === $column) {
      $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
    } else {
      $this->sort_column = $column;
      $this->sort_direction = 'asc';
    }
  }

  public function set_filter($input)
  {
    $this->vendor_category_id = $input["vendor_category_id"];
    $this->event_date = $input["event_date"];
    $this->order_status_id = $input["order_status_id"];
    $this->payment_vendor_status_id = $input["payment_vendor_status_id"];
  }

  public function set_keyword($keyword)
  {
    $this->keyword = $keyword;
  }

  private function get_vendors()
  {
    $columns = [
      "v.company_name", "vc.vendor_category", "o.event_date", "os.order_status",
      "pv.payment_vendor_status", "order_products.grand_total",
      "pv.color AS color_pv"
    ];
    $keyword = $this->keyword;
    $vendor_category_id = $this->vendor_category_id;
    $event_date = $this->event_date;
    $order_status_id = $this->order_status_id;
    $payment_vendor_status_id = $this->payment_vendor_status_id;

    return OrderProduct::query()
    ->select($columns)
    ->with(["payment_vendor"])
    ->join("orders AS o", "order_products.order_id", "=", "o.id")
    ->join("order_statuses AS os", "o.order_status_id", "=", "os.id")
    ->join("payment_vendor_statuses AS pv", "order_products.payment_vendor_status_id", "=", "pv.id")
    ->join("vendors as v", "order_products.vendor_id", "=", "v.id")
    ->join("vendor_categories AS vc", "v.vendor_category_id", "=", "vc.id")
    ->where("o.user_id", auth()->user()->id)
    ->when($vendor_category_id, function($query) use ($vendor_category_id) {
      return $query->where("v.id", $vendor_category_id);
    })
    ->when($event_date, function($query) use ($event_date) {
      return $query->where("o.event_date", $event_date);
    })
    ->when($order_status_id, function($query) use ($order_status_id) {
      return $query->where("o.order_status_id", $order_status_id);
    })
    ->when($payment_vendor_status_id, function($query) use ($payment_vendor_status_id) {
      return $query->where("order_products.payment_vendor_status_id", $payment_vendor_status_id);
    })
    ->when($keyword, function($query) use ($keyword, $columns) {
      return $query->where(function ($q) use ($keyword, $columns) {
        $loop = 0;
        foreach ($columns as $column) {
          if ($loop <= 5) {
              $q->orWhere($column, 'like', "%" . $keyword . "%");
          }
          $loop++;
        }
      });
    })
    ->orderBy($this->sort_column, $this->sort_direction)
    ->paginate(10);
  }

  public function render()
  {
    $data = [
      "vendors" => $this->get_vendors()
    ];

    return view('livewire.apps.users.vendors.index', $data);
  }
}
