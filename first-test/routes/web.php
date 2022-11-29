<?php

use App\Http\Controllers\EventController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events', [EventController::class, 'index'])->name('viewAll');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('viewEvent');
    Route::get('/create', [EventController::class, 'create'])->name('createEvent');
    Route::post('/events/store', [EventController::class, 'store'])->name('storeEvent');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('editEvent');
    Route::post('/events/update', [EventController::class, 'update'])->name('updateEvent');
    Route::delete('/events/{id}/delete', [EventController::class, 'destroy'])->name('destroyEvent');
    Route::post('/search', [EventController::class, 'search']);
});

require __DIR__.'/auth.php';
