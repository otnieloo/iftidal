<?php

namespace App\Http\Livewire\Apps\Vendors\Employees;

use App\Models\CountryCode;
use App\Models\Department;
use App\Models\Employee;
use App\Traits\AlertLivewire;
use App\Traits\LivewireSort;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination, LivewireSort, AlertLivewire;

  public $per_page = 10;
  public $keyword;

  public $name;
  public $country_code_id;
  public $phone_number;
  public $department_id;
  public $location;

  public function reset_input()
  {
    $this->name = "";
    $this->country_code_id = "";
    $this->phone_number = "";
    $this->department_id = "";
    $this->location = "";
  }

  public function save()
  {
    $this->validate([
      "name" => "required",
      "country_code_id" => "required",
      "phone_number" => "required",
      "department_id" => "required",
      "location" => "required",
    ]);

    Employee::create([
      "name" => $this->name,
      "country_code_id" => $this->country_code_id,
      "phone_number" => $this->phone_number,
      "department_id" => $this->department_id,
      "location" => $this->location,
    ]);

    $this->reset_input();
    $this->alert_success("Employee has been saved!");
  }

  private function get_employees()
  {
    $keyword = $this->keyword;

    return Employee::query()
    ->select([
      "employees.id",
      "employees.name",
      "employees.phone_number",
      "employees.location",
      "cc.country",
      "cc.code",
      "d.department",
    ])
    ->join("country_codes as cc", "employees.country_code_id", "=", "cc.id")
    ->join("departments AS d", "employees.department_id", "=", "d.id")
    ->when($keyword, function ($query) use ($keyword) {
      $query->where("employees.name", "like", "%$keyword%")
      ->orWhere("employees.phone_number", "like", "%$keyword%")
      ->orWhere("employees.location", "like", "%$keyword%")
      ->orWhere("cc.country", "like", "%$keyword%")
      ->orWhere("cc.code", "like", "%$keyword%")
      ->orWhere("d.department", "like", "%$keyword%");
    })
    ->orderBy($this->sort_column, $this->sort_direction)
    ->paginate($this->per_page);
  }

  public function render()
  {
    $data = [
      "employees" => $this->get_employees(),
      "country_codes" => CountryCode::all(),
      "departments" => Department::all(),
    ];

    return view('livewire.apps.vendors.employees.index', $data);
  }
}
