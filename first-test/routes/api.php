<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api/v1/events',[EventController::class, 'index']);
Route::get('/api/v1/events/active-events',[EventController::class, 'getActiveEvent']);
Route::get('/api/v1/events/{id} ',[EventController::class, 'getOneEvent']);
Route::post('/api/v1/events',[EventController::class, 'createEvent']);
Route::put('/api/v1/events/{id} ',[EventController::class, 'createUpdate']);
Route::patch('/api/v1/events/{id}',[EventController::class, 'updateEvent']);
Route::delete('/api/v1/events/{id} ',[EventController::class, 'deleteEvent']);