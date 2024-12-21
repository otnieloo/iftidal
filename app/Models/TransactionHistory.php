<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
  use HasFactory;
  protected $guarded = ["id"];

  public function status()
  {
    return $this->belongsTo(TransactionHistoryStatus::class, "transaction_history_status_id", "id");
  }

  public function type()
  {
    return $this->belongsTo(TransactionHistoryType::class, "transaction_history_type_id", "id");
  }
}
