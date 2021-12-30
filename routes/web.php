<?php

use App\Http\Controllers\HomeController;
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

Route::get(
    'appointment/get',
    'App\Http\Controllers\AppointmentController@get',
)->name('appointment.get');

Route::get('call/get', 'App\Http\Controllers\CallController@get')->name(
    'call.get',
);

Route::get('listing/get', 'App\Http\Controllers\ListingController@get')->name(
    'listing.get',
);

Route::get('client/get', 'App\Http\Controllers\ClientController@get')->name(
    'client.get',
);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Controller@dashboard')->name(
        'dashboard',
    );
    Route::post(
        'create-listing',
        'App\Http\Controllers\ListingController@createListing',
    );

    Route::post(
        'update-listing',
        'App\Http\Controllers\ListingController@updateListing',
    );

    Route::post(
        'create-client',
        'App\Http\Controllers\ClientController@createClient',
    );

    Route::post(
        'update-client',
        'App\Http\Controllers\ClientController@updateClient',
    );

    Route::resource(
        'appointment',
        'App\Http\Controllers\AppointmentController',
    );

    Route::resource('listing', 'App\Http\Controllers\ListingController');

    Route::resource('client', 'App\Http\Controllers\ClientController');
});
