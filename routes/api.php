<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/home', function (Request $request) {
    return $request->user();
});


Route::prefix("user")->group(function (){
    Route::post("/register", [UserController::class, "addUser"])->name("user.register");
    Route::post("/login", array(LoginController::class, "login"))->name("user.login");
});