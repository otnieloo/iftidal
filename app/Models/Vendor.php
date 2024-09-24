<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
  use HasFactory, SoftDeletes;
  protected $guarded = ['id'];


  public function user()
  {
    return $this->hasOne(User::class);
  }

  public function category()
  {
    return $this->belongsTo(VendorCategory::class, "vendor_category_id", "id");
  }

  public function logo(): Attribute
  {
    return new Attribute(
      get: fn($value) => !empty ($value) ? asset("assets/images/vendors-logo/$value") : NULL,
    );
  }

  public function companyBannerLogo(): Attribute
  {
    return new Attribute(
      get: fn($value) => !empty ($value) ? asset("assets/images/vendors-logo/$value") : NULL,
    );
  }
}
