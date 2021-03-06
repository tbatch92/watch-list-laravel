<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MovieListController;
use App\Http\Controllers\UserController;
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

Route::middleware("auth")->group(function() {
    Route::get("/", [MovieListController::class, "getListsPage"])->name("home");
    Route::post("/list", [MovieListController::class, "createMovieList"])->name("create-list");
    Route::get("/list/{slug}", [MovieListController::class, "getListPage"])->name("list");

    Route::get("/settings", [UserController::class, "getUserSettingsPage"])->name("settings");
    Route::put("/settings", [UserController::class, "updateUserSettings"])->name("update-settings");
});