<?php

use App\Http\Controllers\AuthenticationController;
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

Route::get("/login", function() {
    return view("login");
})->name("login");

Route::post("/login", [AuthenticationController::class, "login"])->name("do-login");

Route::get("/register", function() {
    return view("register");
})->name("register");

Route::post("/register", [AuthenticationController::class, "register"])->name("do-register");

Route::middleware("auth")->post("/logout", [AuthenticationController::class, "logout"])->name("logout");

Route::middleware("auth")->get("/", function() {
    return view("home");
})->name("home");