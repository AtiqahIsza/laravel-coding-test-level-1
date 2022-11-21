<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APIController;

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

Route::get('/api/v1/events',[APIController::class, 'index']);
Route::get('/api/v1/events/active-events',[APIController::class, 'getActiveEvent']);
Route::get('/api/v1/events/{id} ',[APIController::class, 'getOneEvent']);
Route::post('/api/v1/events',[APIController::class, 'createEvent']);
Route::put('/api/v1/events/{id} ',[APIController::class, 'createUpdate']);
Route::patch('/api/v1/events/{id}',[APIController::class, 'updateEvent']);
Route::delete('/api/v1/events/{id} ',[APIController::class, 'deleteEvent']);