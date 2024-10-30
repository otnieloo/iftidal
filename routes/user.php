<?php

use App\Http\Controllers\Apps\User\CartController;
use App\Http\Controllers\Apps\User\DashboardController;
use App\Http\Controllers\Apps\User\EventController;
use App\Http\Controllers\Apps\User\OrderController;

use Illuminate\Support\Facades\Route;


Route::middleware(["auth", "check_division:3"])->group(function () {
  Route::get("/dashboard", DashboardController::class)->name("user.dashboard.index");

  Route::get("/events", [EventController::class, "index"])->name("user.events.index");
  Route::get("/events/create", [EventController::class, "create"])->name("user.events.create");
  Route::post("/events/cart", [CartController::class, "store"])->name("user.events.cart.store");


  Route::get("/orders", [OrderController::class, "index"])->name("user.orders.index");
  Route::get("/orders/{order}", [OrderController::class, "show"])->name("user.orders.show");
});
