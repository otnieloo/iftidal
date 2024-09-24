<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVendorRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return TRUE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      "name" => [
        "required", "string", "max:255"
      ],
      "email" => [
        "required", "string", "email", "max:255"
      ],
      "password" => [
        "required", "string", "min:6"
      ],
      "company_name" => [
        "required", "string", "max:255",
      ],
      "company_legal_number" => [
        "required", "string", "max:255",
      ],
      "vendor_category_id" => [
        "required", "exists:vendor_categories,id"
      ],
      "vendor_type_id" => [
        "required", "exists:vendor_types,id"
      ],
      "vendor_business_id" => [
        "required", "exists:vendor_businesses,id"
      ]
    ];
  }
}
