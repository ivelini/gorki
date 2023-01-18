<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservedRoomController;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', function (Request $request) {
            $user = $request->user();
            $user->role = $user->roles->first()->name;
            return $user;
        });
    });

    Route::group(['prefix' => 'rooms'], function () {
        Route::post('', [ReservedRoomController::class, 'store']);
        Route::get('', [ReservedRoomController::class, 'index']);
        Route::delete('/{id}', [ReservedRoomController::class, 'destroy']);
        Route::put('/{id}', [ReservedRoomController::class, 'update']);
    });
});
