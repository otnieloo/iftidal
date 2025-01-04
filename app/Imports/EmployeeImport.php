<?php

namespace App\Imports;

use App\Models\CountryCode;
use App\Models\Department;
use App\Models\Employee;
use App\Services\Cores\ErrorService;
use App\Supports\ImportStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImport implements ToCollection
{
  use Importable;

  /**
   * @param Collection $collection
   */
  public function collection(Collection $collection)
  {
    DB::beginTransaction();
    try {
      $index = 0;
      foreach ($collection as $row) {

        if ($index > 2) {

          $country_code = CountryCode::query()
          ->where("code", $row[1])
          ->first();

          if (!$country_code) {
            ImportStatus::$message = "Country code not found!";
            throw new \Exception("Country code not found!");
          }

          $department = Department::query()
          ->where("department", $row[3])
          ->first();

          if (!$department) {
            ImportStatus::$message = "Department not found!";
            throw new \Exception("Department not found!");
          }

          $values = [
            "country_code_id" => $country_code->id,
            "department_id" => $department->id,
            "name" => $row[0],
            "phone_number" => $row[2],
            "location" => $row[4],
          ];

          Employee::create($values);
        }

        $index++;
      }

      DB::commit();
      ImportStatus::$status = TRUE;
    } catch (\Exception $e) {
      DB::rollBack();
      ErrorService::error($e, "EmployeeImport");
      ImportStatus::$message = "Server error!";
    }
  }
}
