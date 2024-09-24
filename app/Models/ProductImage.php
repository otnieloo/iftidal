<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
  use HasFactory;
  protected $guaarded = ['id'];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function productImage() : Attribute
  {
    return new Attribute(
      get: fn($value) => "product/image/$value",
    );
  }
}
