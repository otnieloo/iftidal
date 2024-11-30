<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileVendorRequest extends FormRequest
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
      "company_name" => [
        "required", "string", "max:200"
      ],
      "vendor_category_id" => [
        "required", "exists:vendor_categories,id"
      ],
      "company_email" => [
        "required", "string", "email", "max:255"
      ],
      "company_address" => [
        "required", "string", "max:255"
      ],
      "company_description" => [
        "required", "string", "max:400"
      ],
      "company_logo" => [
        "nullable", "image", "max:2048"
      ],
      "company_banner_logo" => [
        "nullable", "image", "max:5048"
      ],
      "latitude" => [
        "string", "max:100"
      ],
      "longitude" => [
        "string", "max:100"
      ],
    ];
  }
}
