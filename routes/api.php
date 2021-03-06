<?php

use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Controllers\GetUserControllerWithouthID;
use App\Infrastructure\Controllers\StatusController;
use \App\Infrastructure\Controllers\GetUserListController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/status', StatusController::class);
Route::get('users/list', GetUserListController::class);
Route::get('users/{id_user}', GetUserController::class);
Route::get('users/', GetUserControllerWithouthID::class);



