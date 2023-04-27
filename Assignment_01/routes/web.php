<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;

//students
Route::get('/', [StudentController::class, 'list'])->name('student#list');
Route::get('createPage', [StudentController::class, 'createPage'])->name('student#createPage');
Route::post('student/create', [StudentController::class, 'create'])->name('student#create');
Route::get('student/delete/{id}', [StudentController::class, 'delete'])->name('student#delete');
Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student#edit');
Route::post('student/update/{id}', [StudentController::class, 'update'])->name('student#update');

// majors
Route::get('major', [MajorController::class, 'majorList'])->name('major#list');
Route::get('major/createPage', [MajorController::class, 'MajorCreatePage'])->name('major#createPage');
Route::post('major/create', [MajorController::class, 'majorCreate'])->name('major#create');
Route::get('major/delete/{id}', [MajorController::class, 'majorDelete'])->name('major#delete');
Route::get('major/edit/{id}', [MajorController::class, 'majorEdit'])->name('major#edit');
Route::post('major/update/{id}', [MajorController::class, 'majorUpdate'])->name('major#update');