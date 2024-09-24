<?php

namespace App\Http\Livewire\Apps\Admin\Product;

use App\Models\Vendor;
use Livewire\Component;

class Index extends Component
{
  public $text = 'TEST';
  public $vendors;
  public bool $is_product = true;



  public function mount()
  {
    $this->vendors = Vendor::all();
  }


  public function change_tab($is_product)
  {

    if ($this->is_product != $is_product) {
      $this->is_product = $is_product;
      $this->dispatchBrowserEvent('refresh-datatable', ['is_product' => $this->is_product]);
    }
  }

  public function render()
  {
    return view('livewire.apps.admin.product.index');
  }
}
