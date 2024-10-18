<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
  use HasFactory;
  protected $guarded = ["id"];

  public function subs()
  {
    return $this->hasMany(VendorCategory::class, "parent_category_id", "id");
  }

  public function parent_category()
  {
    return $this->belongsTo(VendorCategory::class, "parent_category_id", "id");
  }

  public function vendors()
  {
    return $this->hasMany(Vendor::class, "vendor_category_id", "id");
  }
}
