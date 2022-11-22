<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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
    return view('welcome');
});

//Route::resource('events', EventController::class);

//Route::get('/settings/manageStage/{id}/addMap', [\App\Http\Controllers\StageMapController::class, 'create'])->name('addStageMap');
Route::get('/events', [EventController::class, 'index'])->name('viewAll');
Route::get('/events/{id}', [EventController::class, 'show'])->name('viewEvent');
Route::get('/create', [EventController::class, 'create'])->name('createEvent');
Route::post('/events/store', [EventController::class, 'store'])->name('storeEvent');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('editEvent');
Route::post('/events/update', [EventController::class, 'update'])->name('updateEvent');
Route::delete('/events/{id}/delete', [EventController::class, 'destroy'])->name('destroyEvent');
Route::post('/search', [EventController::class, 'search']);