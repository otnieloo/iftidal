<?php

namespace App\Http\Livewire\Apps\Vendors\Profiles;

use App\Models\VendorCategory;
use Livewire\Component;

class Update extends Component
{
  public $vendor;
  public $categories = [];

  public function mount()
  {
    $this->categories = VendorCategory::query()->whereNotNull("parent_category_id")->orderBy("parent_category")->get();
  }

  public function render()
  {
    return view('livewire.apps.vendors.profiles.update');
  }
}
