<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
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

Route::redirect("/", "dashboard");

// register
Route::get("/register", [AuthController::class, "register"])->name("auth.register");
Route::post("/requestregister", [AuthController::class, "requestregister"])->name("auth.requestregister");
// login
Route::get("/login", [AuthController::class, "login"])->name("auth.login");
Route::post("/requestlogin", [AuthController::class, "requestlogin"])->name("auth.requestlogin");

Route::middleware("auth")->group(function(){
// logout
Route::get("/logout", [AuthController::class, "logout"])->name("auth.logout");
// dashboard
Route::get("/dashboard", [JobController::class, "index"])->name("job.dashboard");
// profile
Route::get("/profile", [AuthController::class, "profile"])->name("profile");
Route::post("/requestprofile", [AuthController::class, "requestprofile"])->name("requestprofile");
// job
Route::get("/job/create", [JobController::class, "create"])->name("job.create");
Route::post("/job/store", [JobController::class, "store"])->name("job.store");
Route::get("/job/show/{id}", [JobController::class, "show"])->name("job.show");
Route::get("/job/edit/{id}", [JobController::class, "edit"])->name("job.edit");
Route::post("/job/update", [JobController::class, "update"])->name("job.update");

Route::get("/job/destroy/{id}", [JobController::class, "destroy"])->name("job.destroy");
});