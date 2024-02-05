<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function () {
    // Tasks List
    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    // Admin-only Routes
    Route::middleware(['admin'])->group(function () {
        // Create Task Form
        Route::get('/tasks/create', [TaskController::class, 'create'])
            ->name('tasks.create');

        // Store Task
        Route::post('/tasks', [TaskController::class, 'store'])
            ->name('tasks.store');

        // Statistics List
        Route::get('/statistics', [TaskController::class, 'statistics'])
            ->name('tasks.statistics');

        // Delete Task
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    });
});


