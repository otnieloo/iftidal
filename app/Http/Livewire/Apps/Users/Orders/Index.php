<?php

namespace App\Http\Livewire\Apps\Users\Orders;

use Livewire\Component;

class Index extends Component
{

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
    return view('livewire.apps.users.orders.index');
  }
}
