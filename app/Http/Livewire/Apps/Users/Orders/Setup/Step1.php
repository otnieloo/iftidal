<?php

namespace App\Http\Livewire\Apps\Users\Orders\Setup;

use App\Models\EventType;
use App\Models\Location;
use App\Models\Order;
use Livewire\Component;

class Step1 extends Component
{
  public $event_name;
  public $event_type_id;
  public $event_date;
  public $event_start_time;
  public $event_end_time;
  public $location_id;
  public $event_guest_count;
  public $event_start_budget;
  public $event_end_budget;
  public $order;

  protected $rules = [
    "event_name" => [
      "required",
      "string",
      "max:200"
    ],
    "event_type_id" => [
      "required",
      "exists:event_types,id"
    ],
    "event_date" => [
      "required",
      "date_format:Y-m-d"
    ],
    "event_start_time" => [
      "required",
      "date_format:H:i"
    ],
    "event_end_time" => [
      "required",
      "date_format:H:i"
    ],
    "location_id" => [
      "required",
      "exists:locations,id"
    ],
    "event_guest_count" => [
      "required",
      "numeric"
    ],
    "event_start_budget" => [
      "required",
      "numeric"
    ],
    "event_end_budget" => [
      "required",
      "numeric"
    ],
  ];

  public function mount()
  {
    $this->event_guest_count = 0;
    $this->event_date = date('Y-m-d');

    $get_order = Order::query()->where("order_status_id", 1)->orderBy("id", "DESC")->first();
    if ($get_order) {
      $this->order = $get_order;

      $this->event_date = date('Y-m-d', strtotime($get_order->event_date));
      $this->event_start_time = date('H:i', strtotime($get_order->event_start_time));
      $this->event_end_time = date('H:i', strtotime($get_order->event_end_time));
      $this->location_id = $get_order->location_id;
      $this->event_guest_count = $get_order->event_guest_count;
      $this->event_start_budget = $get_order->event_start_budget;
      $this->event_end_budget = $get_order->event_end_budget;
      $this->event_name = $get_order->event_name;
      $this->event_type_id = $get_order->event_type_id;

      $this->emit("step1-success", $get_order->id);
    }
  }

  public function save()
  {
    $this->validate();

    $values = [
      "user_id" => auth()->user()->id,
      "event_name" => $this->event_name,
      "event_type_id" => $this->event_type_id,
      "order_status_id" => 1,
      "payment_status_id" => 1,
      "event_date" => $this->event_date,
      "event_start_time" => $this->event_start_time,
      "event_end_time" => $this->event_end_time,
      "location_id" => $this->location_id,
      "event_guest_count" => $this->event_guest_count,
      "event_start_budget" => $this->event_start_budget,
      "event_end_budget" => $this->event_end_budget,
    ];

    if ($this->order) {
      Order::query()
        ->where("id", $this->order->id)
        ->update($values);

      $order = $this->order;
    } else {
      $order = Order::create($values);
    }

    $this->emit("step1-success", $order->id);
  }

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function render()
  {
    $data = [
      "event_types" => EventType::query()->orderBy("event_type", "ASC")->get(),
      "locations" => Location::query()->orderBy("location", "ASC")->get(),
    ];

    return view('livewire.apps.users.orders.setup.step1', $data);
  }
}
