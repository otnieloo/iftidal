<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventDashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $start_date_string = str_replace(' ', '+', request()->query("start"));
    $end_date_string = str_replace(' ', '+', request()->query("end"));

    $start_date = Carbon::parse($start_date_string)->format("Y-m-d");
    $end_date = Carbon::parse($end_date_string)->format("Y-m-d");

    $get_events = Order::query()
      ->select([
        "event_name",
        "event_date",
        "event_start_time",
      ])
      ->where("user_id", auth()->user()->id)
      ->whereBetween("event_date", [$start_date, $end_date])
      ->get();

    $response = response_data($get_events);
    return response_json($response);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
