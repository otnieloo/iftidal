<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportDashboardController extends Controller
{
  private ReportService $service;

  public function __construct()
  {
    $this->service = new ReportService;
  }

  /**
   * Get reports graphs dashboard
   *
   * @param Request $request
   */
  public function get_graphs(Request $request)
  {
    $response = $this->service->get_graphs_dashboard_user($request);
    return \response_json($response);
  }
}
