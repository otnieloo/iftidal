<?php

namespace App\Http\Controllers\Apps\Vendor;

use App\Exports\EmployeeTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Supports\ImportStatus;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
  /**
   * View index employee
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index()
  {
    return $this->view("vendors.employees.index", "My Staff", [], TRUE);
  }

  /**
   * Download template employee
   *
   * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
   */
  public function export()
  {
    return (new EmployeeTemplateExport)->download("employees.xlsx");
  }

  public function import()
  {
    (new EmployeeImport)->import(request()->file("file"));
    $response = create_response();

    if (ImportStatus::$status) {
      $response = response_success_default("Import success!", FALSE, route("vendor.employees.index"));
    } else {
      $response->status_code = 500;
      $response->message = ImportStatus::$message;
    }

    return response_json($response); 
  }
}
