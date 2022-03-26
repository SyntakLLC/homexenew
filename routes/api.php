<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', [
    HomeController::class,
    'returnUser',
]);

Route::post('/sanctum/token', [HomeController::class, 'authorizeMobile']);

Route::post('/client/create', [ClientController::class, 'mobileStore']);
Route::put('/client/update', [ClientController::class, 'mobileUpdate']);
Route::put('/goal/update', [UserController::class, 'mobileGoalUpdate']);
