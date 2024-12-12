<?php

use App\Http\Controllers\Apps\User\CartController;
use App\Http\Controllers\Apps\User\DashboardController;
use App\Http\Controllers\Apps\User\EventController;
use App\Http\Controllers\Apps\User\OrderController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\Apps\User\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/events/finishpayment', [OrderController::class, 'finish_payment']);
Route::post('/events/finishpayment', [OrderController::class, 'finish_payment']);

Route::middleware(["auth", "check_division:3"])->group(function () {
  Route::get("/dashboard", DashboardController::class)->name("user.dashboard.index");

  Route::get("/events", [EventController::class, "index"])->name("user.events.index");
  Route::get("/events/create", [EventController::class, "create"])->name("user.events.create");
  Route::get("/events/checkevent", [OrderController::class, "check_on_created_event"]);
  Route::post("/events/step1", [OrderController::class, "store_step1"])->name("user.events.step1");
  Route::post("/events/step2", [OrderController::class, "store_step2"])->name("user.events.step2");
  Route::post("/events/step4", [OrderController::class, "store_step4"])->name("user.events.step4");
  Route::post('/events/addtocart', [OrderController::class, 'add_to_cart']);
  Route::get('/events/listorder', [OrderController::class, 'show_list_order']);
  Route::delete('/events/{orderProduct}', [OrderController::class, 'remove_from_cart']);
  Route::post('/events/checkout', [OrderController::class, 'checkout']);

  Route::post("/events/payment", [PaymentController::class, "store"])->name("user.events.payment.store");


  Route::get('/products', [ProductController::class, 'index']);


  Route::post("/events/cart", [CartController::class, "store"])->name("user.events.cart.store");

  Route::get("/orders", [OrderController::class, "index"])->name("user.orders.index");
  Route::get("/orders/{order}", [OrderController::class, "show"])->name("user.orders.show");
});
