<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Order extends Model
{
  use HasFactory, SoftDeletes;
  protected $guarded = ["id"];


  public function scopeOnCreated(Builder $query){
    $userId = request()->user()->id;

    $query->where('user_id', $userId)->where('order_status_id', 1);
  }


  public function user()
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }

  public function type()
  {
    return $this->belongsTo(EventType::class, "event_type_id", "id");
  }

  public function location()
  {
    return $this->belongsTo(Location::class, "location_id", "id");
  }

  public function order_products()
  {
    return $this->hasMany(OrderProduct::class, "order_id", "id");
  }

  public function payment_status()
  {
    return $this->belongsTo(PaymentStatus::class, "payment_status_id", "id");
  }

  public function status()
  {
    return $this->belongsTo(OrderStatus::class, "order_status_id", "id");
  }

  public function order_vendor_category(){
    return $this->hasMany(OrderVendorCategory::class);
  }
}
