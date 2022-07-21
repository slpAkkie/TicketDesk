<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes used for authentication user.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::middleware('guest')->group(function () {
    Route::prefix('/login')->group(function () {
        Route::get('/', [LoginController::class, 'page'])->name('login');
        Route::post('/', [Logincontroller::class, 'login'])->name('login.try');
    });
});
