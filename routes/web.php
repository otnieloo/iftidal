<?php

use App\Http\Controllers\Apps\CustomerController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\OrderController;
use App\Http\Controllers\Apps\ProductController;
use App\Http\Controllers\Apps\ProjectSettingController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UserController;
use App\Http\Controllers\Apps\VendorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\User\EventController;
use App\Models\SessionToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

// Start Authentication
Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "store"])->name("login.store");

Route::get("/oauth/google", function () {
  return Socialite::driver('google')->redirect();
})->name("login.google");

Route::get("/oauth/google/callback", [LoginController::class, "callback_google"])->name("login.google.callback");

Route::get("/logout", function () {
  Auth::logout();
  Alert::success("Sukses!", "Berhasil logout!");
  SessionToken::query()->where("session_token", session("session_token"))->update(["is_login" => 0]);

  return redirect()->route("login");
});

Route::get("/register/user", [RegisterController::class, "index_user"])->name("register.user.index");
Route::post("/register/user", [RegisterController::class, "store_user"])->name("register.user.store");

Route::get("/register/vendor", [RegisterController::class, "index_vendor"])->name("register.vendor.index");
Route::post("/register/vendor", [RegisterController::class, "store_vendor"])->name("register.vendor.store");
// End Authentication

Route::get("/email/verify/{id}/{hash}", function (Request $request) {
  $user = User::findOrFail($request->route('id'));

  if (hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
    $user->markEmailAsVerified();
    return view("auth.verify-email");
  }

  return redirect()->route('login');
})->name("verification.verify");
Route::get("/must-verify-email", function () {
  return view("auth.must-verified");
})->name("verification.notice");

Route::middleware(["auth", "check_maintanance", "verified", "check_session_token"])->group(function () {
  Route::get("/app/dashboard", DashboardController::class)->name("app.dashboard")->middleware("check_authorized:002D");

  Route::get("/app/customers", [CustomerController::class, "index"])->name("app.customers.index");
  Route::get("/app/customers/create", [CustomerController::class, "create"])->name("app.customers.create");
  Route::post("/app/customers", [CustomerController::class, "store"])->name("app.customers.store");
  Route::get("/app/customers/{customer}/edit", [CustomerController::class, "edit"])->name("app.customers.edit");
  Route::put("/app/customers/{customer}", [CustomerController::class, "update"])->name("app.customers.update");

  Route::post("/app/users/get", [UserController::class, "get"])->name("app.users.get")->middleware("check_authorized:003U");
  Route::resource("/app/users", UserController::class, ["as" => "app"])->middleware("check_authorized:003U|004R");

  Route::post("/app/vendors/get", [VendorController::class, "get"])->name("app.vendors.get")->middleware("check_authorized:007V");
  Route::resource("/app/vendors", VendorController::class, ["as" => "app"])->middleware("check_authorized:007V");
  Route::put("/app/vendors/{vendor}/approve", [VendorController::class, "approve"])->name("app.vendors.approve");
  Route::put("/app/vendors/{vendor}/decline", [VendorController::class, "decline"])->name("app.vendors.decline");

  Route::resource("/app/roles", RoleController::class, ["as" => "app"])->middleware("check_authorized:004R");
  Route::post("/app/roles/{role}/assign-user", [RoleController::class, "assign_user"])->name("app.roles.assign_user")->middleware("check_authorized:004R");

  Route::get("/app/settings", [ProjectSettingController::class, "index"])->name("app.settings.index")->middleware("check_authorized:005S");
  Route::put("/app/settings", [ProjectSettingController::class, "update"])->name("app.settings.update")->middleware("check_authorized:005S");


  Route::post("/app/products/get", [ProductController::class, "get"])->name("app.products.get");
  Route::resource('app/products', ProductController::class, ["as" => "app"]);
  Route::post("/app/services/get", [ProductController::class, "get_service"])->name("app.products.get");
  Route::resource('app/services', ProductController::class, ["as" => "app"]);

  Route::put("/app/products/{product}/approve", [ProductController::class, "approve"])->name("app.products.approve");
  Route::put("/app/products/{product}/decline", [ProductController::class, "decline"])->name("app.products.decline");


  Route::get('/app/orders/get', [OrderController::class, 'data']);
  Route::get("/app/orders", [OrderController::class, "index"])->name("app.orders.index");
  Route::get("/app/orders/{order}", [OrderController::class, "show"])->name("app.orders.show");
});

Route::get('app/event-setup', [EventController::class, 'index']);


Route::get('/loadimage', [UploadImageController::class, 'load']);
Route::post('/uploadimage', [UploadImageController::class, 'process']);
Route::post('/revertupload', [UploadImageController::class, 'revert']);

Route::get("/maintenance", function () {
  auth()->logout();
  return view("admin.maintenance");
})->name("maintenance")->middleware("check_maintanance");
