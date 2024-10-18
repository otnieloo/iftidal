<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class RegisterUser extends Component
{
  public $register_manual = FALSE;

  public $name;
  public $email;
  public $password;

  protected $rules = [
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

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function set_manual()
  {
    $this->register_manual = TRUE;
  }

  public function render()
  {
    return view('livewire.auth.register-user');
  }
}
