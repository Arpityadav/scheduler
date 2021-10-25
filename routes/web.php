<?php

use App\Http\Controllers\SchedulesController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/events/create', [\App\Http\Controllers\EventController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('event.create');

Route::post('/events/', [\App\Http\Controllers\EventController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('event.store');


Route::get('/schedules/', [SchedulesController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('schedules.index');

Route::get('/schedules/{schedule}', [SchedulesController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('schedules.show');

require __DIR__.'/auth.php';
