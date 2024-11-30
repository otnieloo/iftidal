<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'vendor_id' => ['required', 'exists:vendors,id'],
      'product_name' => ['required'],
      'product_category_id' => ['required', 'exists:product_categories,id'],
      'product_subcategory_id' => ['required', 'exists:product_categories,id'],
      'product_condition_id' => ['nullable', 'exists:product_conditions,id'],
      'product_level_id' => ['nullable', 'exists:product_levels,id'],
      'product_capital_price' => ['required', 'numeric'],
      'product_sell_price' => ['required', 'numeric'],
      'product_sku' => ['nullable'],
      'product_slot' => ['nullable'],
      // 'product_stock' => [$this->has("product_condition_id") ? 'required' : 'nullable'],
      'product_description' => ['required'],
      'tmp' => ['required', 'array'],
      'tmp.*' => ['required'],
      'tmp_video' => ['nullable'],
      'package_type' => ['nullable', 'numeric'],
      'minimum_qty' => ['nullable', 'numeric'],
      'package_price_percent' => ['nullable', 'numeric'],
      'package_price_per_product' => ['nullable', 'numeric'],
      'package_price_total' => ['nullable', 'numeric'],

      'variations' => [
        "required", 'array'
      ],

      'payment_release_id' => [
        'required', 'exists:product_payment_releases,id'
      ],

      'product_guarantee_id' => [
        'required', 'exists:product_guarantees,id'
      ]
    ];
  }
}
