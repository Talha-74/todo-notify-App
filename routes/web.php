<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Task CRUD
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/task/store', [TaskController::class, 'store'])->name('tasks.store');
Route::middleware(['auth', 'task.update'])->group(function() {
Route::post('/task/update', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
});


