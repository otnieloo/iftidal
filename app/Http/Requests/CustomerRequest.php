<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    $rules = [
      "name" => [
        "required", "string", "max:200"
      ],
      "email" => [
        "required", "string", "email", "unique:users,id," . $this->route('customer')->id
      ],
      "user_status_id" => [
        "required", "exists:user_statuses,id"
      ],
      "password" => [
        "nullable", "string", "min:6"
      ]
    ];

    // dd($rules);

    return $rules;
  }
}
