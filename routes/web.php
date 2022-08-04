<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketMessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

// Routes for which there should be authorization.
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('/tickets')->name('tickets.')->group(function () {
        Route::get('/not-accepted', [TicketController::class, 'notAccepted'])->name('index.not-accepted');
        Route::get('/accepted-by-me', [TicketController::class, 'acceptedByAuthUser'])->name('index.accepted-by-autorized-user');
        Route::middleware('admin')->get('/accepted', [TicketController::class, 'accepted'])->name('index.all-accepted');
        Route::middleware('admin')->get('/closed', [TicketController::class, 'closed'])->name('index.closed');

        Route::put('/{ticket}/accept', [TicketController::class, 'accept'])->name('accept');
        Route::put('/{ticket}/close', [TicketController::class, 'close'])->name('close');
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('index');
        Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
    });
});

// Routes for which there should be no authorization.
Route::get('/', function () {
    return response()->redirectToRoute('tickets.create');
});

Route::prefix('/tickets')->name('tickets.')->group(function () {
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/', [TicketController::class, 'store'])->name('store');

    Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
    Route::post('/{ticket}/messages', [TicketMessageController::class, 'store'])->name('messages.store');
});

// Separated routes for authorization.
require_once 'web.partials/auth.php';
