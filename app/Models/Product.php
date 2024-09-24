<?php

namespace App\Models;

use App\Models\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  protected static function booted(): void
  {
    static::addGlobalScope(new VendorScope);
  }

  public function product_images()
  {
    return $this->hasMany(ProductImage::class);
  }

  public function product_package()
  {
    return $this->hasOne(ProductPackage::class);
  }
}
