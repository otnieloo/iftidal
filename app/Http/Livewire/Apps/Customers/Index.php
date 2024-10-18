<?php

namespace App\Http\Livewire\Apps\Customers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  private function get_customer()
  {
    return User::query()
    ->with(["status"])
    ->where("role_id", 3)
    ->paginate(20);
  }

  public function render()
  {
    $data = [
      "customers" => $this->get_customer()
    ];

    return view('livewire.apps.customers.index', $data);
  }
}
