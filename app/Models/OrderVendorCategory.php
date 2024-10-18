<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderVendorCategory extends Model
{
  use HasFactory;
  protected $guarded = ["id"];

  public function category()
  {
    return $this->belongsTo(VendorCategory::class, "vendor_category_id", "id");
  }
}
