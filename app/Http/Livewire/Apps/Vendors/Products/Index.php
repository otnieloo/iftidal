<?php

namespace App\Http\Livewire\Apps\Vendors\Products;

use Livewire\Component;

class Index extends Component
{
  public bool $is_product = true;

  public function change_tab($is_product)
  {

    if ($this->is_product != $is_product) {
      $this->is_product = $is_product;
      $this->dispatchBrowserEvent('refresh-datatable', ['is_product' => $this->is_product]);
    }
  }

  public function render()
  {
    return view('livewire.apps.vendors.products.index');
  }
}
