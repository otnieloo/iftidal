<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
  use HasFactory;
  protected $guarded = ["id"];

  public function order()
  {
    return $this->belongsTo(Order::class, "order_id", "id");
  }

  public function vendor()
  {
    return $this->belongsTo(Vendor::class, "vendor_id", "id");
  }

  public function product()
  {
    return $this->belongsTo(Product::class, "product_id", "id");
  }

  public function product_category()
  {
    return $this->belongsTo(ProductCategory::class, "product_category_id", "id");
  }

  public function payment_vendor()
  {
    return $this->belongsTo(PaymentVendorStatus::class, "payment_vendor_status_id", "id");
  }

  public function customer()
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }
}
