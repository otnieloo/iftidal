<?php

use App\Http\Controllers\Apps\User\CartController;
use App\Http\Controllers\Apps\User\DashboardController;
use App\Http\Controllers\Apps\User\EventController;
use App\Http\Controllers\Apps\User\EventDashboardController;
use App\Http\Controllers\Apps\User\OrderController;
use App\Http\Controllers\Apps\User\ReportDashboardController;
use App\Http\Controllers\Apps\User\UserFinancialController;
use App\Http\Controllers\Apps\User\VendorController;
use App\Http\Controllers\Apps\User\WalletController;
use App\Http\Controllers\Apps\User\WithdrawController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\Apps\User\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/events/finishpayment', [OrderController::class, 'finish_payment']);
Route::post('/events/finishpayment', [OrderController::class, 'finish_payment']);

Route::get("/wallet/finish-payment", [WalletController::class, "finish_payment"])->name("user.wallet.finish-payment");
Route::post("/wallet/finish-payment", [WalletController::class, "finish_payment"])->name("user.wallet.finish-payment");

// Route::post('/events/callback-payment', [OrderController::class, 'callback_payment']);
// Route::get('/events/callback-payment', [OrderController::class, 'callback_payment']);

Route::middleware(["auth", "check_division:3"])->group(function () {
  Route::get("/dashboard", DashboardController::class)->name("user.dashboard.index");

  Route::get("/dashboard/events", [EventDashboardController::class, "index"])->name("user.dashboard.get-event");
  Route::get("/dashboard/graphs", [ReportDashboardController::class, "get_graphs"])->name("user.dashboard.get-graphs");

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

  Route::get("/orders", [OrderController::class, "index"])->name("user.orders.index");
  Route::get("/orders/{order}", [OrderController::class, "show"])->name("user.orders.show");

  Route::get("/vendors", [VendorController::class, "index"])->name("user.vendors.index");
  Route::post("/vendors/get", [VendorController::class, "get"])->name("user.vendors.get");

  Route::get("/financials", [UserFinancialController::class, "index"])->name("user.financials.index");
  Route::post("/wallet", [WalletController::class, "store"])->name("user.wallet.store");
  Route::post("/withdraw", [WithdrawController::class, "store"])->name("user.withdraw.store");
});
