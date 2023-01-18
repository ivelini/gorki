<?php

use App\Http\Controllers\ProfileController;
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

Route::domain('test.gorki')->group(function () {
    Route::get('/', [\App\Http\Controllers\TestController::class, 'test']);
});

Route::get('/{any?}', function ($any = null) {
    if($any == 'login') {
        return view('auth.login');
    }
    elseif ($any == 'register') {
        return view('auth.register');
    }
    else {
        return view('frontend');
    }
});

require __DIR__.'/auth.php';
