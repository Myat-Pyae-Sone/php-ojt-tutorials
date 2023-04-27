<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'tasks'])->name('tasks#taskPage');
Route::post('/addTask', [TaskController::class, 'addTask'])->name('tasks#addTask');
Route::delete('/deleteTask/{id}', [TaskController::class, 'deleteTask'])->name('task#delete');
