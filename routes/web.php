<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

// register
Route::get("/register", [AuthController::class, "register"])->name("auth.register");
Route::post("/requestregister", [AuthController::class, "requestregister"])->name("auth.requestregister");
// login
Route::get("/login", [AuthController::class, "login"])->name("auth.login");
Route::post("/requestlogin", [AuthController::class, "requestlogin"])->name("auth.requestlogin");

Route::middleware("auth")->group(function(){
// logout
Route::get("/logout", [AuthController::class, "logout"])->name("auth.logout");
});