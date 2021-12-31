<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
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

Route::get('/', HomeController::class);

// Route::get(
//     'appointment/get',
//     'App\Http\Controllers\AppointmentController@get',
// )->name('appointment.get');

// Route::get('call/get', [CallController::class, 'index'])->name('call.get');
//
// Route::get('listing/get', [ListingController::class, 'index'])->name(
//     'listing.get',
// );

// Route::get('client/get', 'App\Http\Controllers\ClientController@get')->name(
//     'client.get',
// );

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name(
        'dashboard',
    );

    Route::resource('appointment', AppointmentController::class);

    Route::resource('listing', ListingController::class);

    Route::resource('client', ClientController::class);
});
