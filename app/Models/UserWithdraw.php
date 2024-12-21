<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWithdraw extends Model
{
  use HasFactory;
  protected $guarded = ["id"];

  public function status()
  {
    return $this->belongsTo(UserWithdrawStatus::class, "user_withdraw_status_id", "id");
  }
}
