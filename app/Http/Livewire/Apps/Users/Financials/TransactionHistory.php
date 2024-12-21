<?php

namespace App\Http\Livewire\Apps\Users\Financials;

use App\Traits\LivewireSort;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionHistory extends Component
{
  use WithPagination, LivewireSort;
  protected $paginationTheme = "bootstrap";

  public $keyword;

  public $listeners = ["set_keyword"];

  public function set_keyword($keyword)
  {
    $this->keyword = $keyword;
  }

  private function get_transaction_histrory()
  {
    $keyword = $this->keyword;

    return \App\Models\TransactionHistory::query()
    ->with(["status", "type"])
    ->where("user_id", auth()->user()->id)
    ->when($keyword, function($query) use ($keyword) {
      return $query->where("description", "like", "%{$keyword}%")
      ->orWhere("amount", "like", "%{$keyword}%")
      ->orWhere("transaction_number", "like", "%{$keyword}%");
    })
    ->orderBy($this->sort_column, $this->sort_direction)
    ->paginate(20);
  }

  public function render()
  {
    $data = [
      "transactions" => $this->get_transaction_histrory(),
    ];

    return view('livewire.apps.users.financials.transaction-history', $data);
  }
}
