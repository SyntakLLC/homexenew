<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Controller@dashboard')->name(
        'dashboard',
    );
});

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

Route::resource('appointment', 'App\Http\Controllers\AppointmentController');
Route::resource('listing', 'App\Http\Controllers\ListingController');
Route::resource('client', 'App\Http\Controllers\ClientController');
