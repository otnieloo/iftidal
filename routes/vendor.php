<?php

use App\Http\Controllers\Apps\Vendor\DashboardController;
use App\Http\Controllers\Apps\Vendor\OrderController;
use App\Http\Controllers\Apps\Vendor\ProductController;
use App\Http\Controllers\Apps\Vendor\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "check_division:2"])->group(function() {
  Route::get("/dashboard", DashboardController::class)->name("vendor.dashboard.index");

  Route::get("/profiles", [ProfileController::class, "index"])->name("vendor.profiles.index");
  Route::put("/profiles", [ProfileController::class, "update"])->name("vendor.profiles.update");

  Route::post("/products/get", [ProductController::class, "get"])->name("vendor.products.get");
  Route::resource('products', ProductController::class, ["as" => "vendor"]);

  Route::post("/services/get", [ProductController::class, "get_service"])->name("vendor.services.get");
  Route::get("/services/create", [ProductController::class, "create"])->name("vendor.services.create");
  Route::get("/services/{product}/edit", [ProductController::class, "edit"])->name("vendor.services.edit");

  Route::get("/orders", [OrderController::class, "index"])->name("vendor.orders.index");
  Route::get("/orders/{order}", [OrderController::class, "show"])->name("vendor.orders.show");
});
