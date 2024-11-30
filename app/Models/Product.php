<?php

namespace App\Models;

use App\Models\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
    return $this->hasOne(ProductPackage::class, "product_id", "id");
  }

  public function productImage(): Attribute
  {
    return new Attribute(
      get: fn($value) => asset("storage/{$value}"),
    );
  }

  public function order_items()
  {
    return $this->hasMany(OrderProduct::class, "product_id", "id");
  }

  public function status()
  {
    return $this->belongsTo(ProductStatus::class, "product_status_id", "id");
  }

  public function variations()
  {
    return $this->hasMany(ProductVariation::class, "product_id", "id");
  }
}
