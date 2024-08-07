<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', [TaskController::class, 'index'])->name('tasks');
Route::post('/task/create', [TaskController::class, 'create'])->name('task.add');
Route::post('/task/delete/{task}', [TaskController::class, 'delete'])->name('task.delete');
Route::post('/task/complete/{task}', [TaskController::class, 'complete'])->name('task.complete');

