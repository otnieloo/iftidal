<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
        "required", "string", "max:200"
      ],
      "email" => [
        "required", "string", "email", "max:255", "unique:users"
      ],
      "password" => [
        "required", "string", "min:6", "max:100"
      ]
    ];
  }
}
