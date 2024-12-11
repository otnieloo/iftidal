<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
  public function index()
  {
    return $this->view("user.event.event-setup", "Event Setup", [], TRUE);
  }
}
