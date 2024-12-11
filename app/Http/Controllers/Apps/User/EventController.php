<?php

namespace App\Http\Controllers\Apps\User;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use App\Models\Location;
use App\Models\Order;
use App\Models\VendorCategory;
use Illuminate\Http\Request;

class EventController extends Controller
{




  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->view("users.events.index", "Events", [], TRUE);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [
      "event_types" => EventType::query()->orderBy("event_type", "ASC")->get(),
      "locations" => Location::query()->orderBy("location", "ASC")->get(),
      "categories" => VendorCategory::query()->with(["subs"])->whereNull("parent_category_id")->get(),
    ];
    // dd($data["categories"]);


    // return $this->view('user.event.event-setup', 'Setup Event', $data, TRUE);
    return $this->view("users.events.create", "Setup Event", $data, TRUE);
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
