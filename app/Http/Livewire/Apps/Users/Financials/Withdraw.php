<?php

namespace App\Http\Livewire\Apps\Users\Financials;

use App\Models\UserWithdraw;
use App\Traits\LivewireSort;
use Livewire\Component;
use Livewire\WithPagination;

class Withdraw extends Component
{
  use WithPagination, LivewireSort;
  protected $paginationTheme = "bootstrap";

  public $keyword_withdraw;

  protected $listeners = ["set_keyword_withdraw"];

  public function set_keyword_withdraw($keyword)
  {
    $this->keyword_withdraw = $keyword;
  }

  private function get_withdraws()
  {
    $keyword = $this->keyword_withdraw;

    return UserWithdraw::query()
    ->with(["status"])
    ->where("user_id", auth()->user()->id)
    ->when($keyword, function($query) use ($keyword) {
      return $query->where(function($q) use ($keyword) {
        return $q->where("withdraw_number", "LIKE", "%$keyword%");
      });
    })
    ->orderBy($this->sort_column, $this->sort_direction)
    ->paginate(20);
  }

  public function render()
  {
    $data = [
      "withdraws" => $this->get_withdraws()
    ];

    return view('livewire.apps.users.financials.withdraw', $data);
  }
}
