<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function __invoke(Request $request)
  {
    return $this->view_admin("users.index", "Dashboard", [], TRUE);
  }
}
