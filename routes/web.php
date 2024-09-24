<?php

use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\ProductController;
use App\Http\Controllers\Apps\ProjectSettingController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UserController;
use App\Http\Controllers\Apps\VendorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UploadImageController;
use App\Models\SessionToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Livewire\Apps\Admin\Product\Index as ProductLivewire;

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

Route::get("/logout", function () {
  Auth::logout();
  Alert::success("Sukses!", "Berhasil logout!");
  SessionToken::query()->where("session_token", session("session_token"))->update(["is_login" => 0]);

  return redirect()->route("login");
});

Route::get("/register", [RegisterController::class, "index"])->name("register.index");
Route::post("/register/vendor", [RegisterController::class, "store_vendor"])->name("register.store.vendor");
// End Authentication

Route::middleware(["auth", "check_maintanance", "check_division:1", "check_session_token"])->group(function () {
  Route::get("/app/dashboard", DashboardController::class)->name("app.dashboard")->middleware("check_authorized:002D");

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
});


Route::get('/loadimage', [UploadImageController::class, 'load']);
Route::post('/uploadimage', [UploadImageController::class, 'process']);
Route::post('/revertupload', [UploadImageController::class, 'revert']);

Route::get("/maintenance", function () {
  auth()->logout();
  return view("admin.maintenance");
})->name("maintenance")->middleware("check_maintanance");
