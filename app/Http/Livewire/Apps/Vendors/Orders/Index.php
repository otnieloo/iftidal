<?php

namespace App\Http\Livewire\Apps\Vendors\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  public bool $all_order = true;


  public function change_tab($all_order)
  {
    if ($this->all_order != $all_order) {
      $this->all_order = $all_order;
      $this->dispatchBrowserEvent('refresh-datatable', ['all_order' => $this->all_order]);
    }
  }


  public function render()
  {
    return view('livewire.apps.vendors.orders.index');
  }
}
