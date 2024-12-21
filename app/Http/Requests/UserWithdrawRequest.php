<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserWithdrawRequest extends FormRequest
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
      "amount" => [
        "required", "string"
      ],
      "information_bank" => [
        "required", "string", "max:255"
      ]
    ];
  }
}
