<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class VendorRequest extends FormRequest
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
      'company_name' => ['required'],
      'vendor_business_id' => [
        "required", "exists:vendor_bussinesses,id"
      ],
      'vendor_category_id' => [
        "required", "exists:vendor_categories,id"
      ],
      'company_phone' => ['required'],
      'company_email' => ['required', 'email:dns'],
      'company_address' => ['required'],
      'contact_person_name' => ['required'],
      'contact_person_phone' => ['required'],
      'contact_person_email' => ['required'],
      'latitude' => ['required'],
      'longitude' => ['required'],
      'tmp' => ['nullable'],
      \request()->method() == "POST" ? "unique:users,email" : Rule::unique("users", "email")->ignore($this->vendor->user->id, "id")->whereNull("deleted_at"),
      'name' => ['nullable'],
      'password' => ['nullable', 'confirmed'],
      'password_confirmation' => ['nullable']
    ];
  }
}
