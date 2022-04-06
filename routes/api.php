<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ApplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post("/register", [AuthController::class, "register"])->name("auth.register");
// login
Route::post("/login", [AuthController::class, "login"])->name("auth.login");

Route::group(["middleware" => ["auth:sanctum"]], function(){

// logout
Route::get("/logout", [AuthController::class, "logout"])->name("auth.logout");
// dashboard
Route::get("/dashboard", [AuthController::class, "index"])->name("auth.dashboard");
// edit profile
Route::post("/edit_profile", [AuthController::class, "edit_profile"])->name("edit_profile");
// apply job
Route::get("/apply/{id}", [ApplyController::class, "apply"])->name("apply");
Route::post("/details/{id}", [ApplyController::class, "details"])->name("details");
});