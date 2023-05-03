<?php

use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

//students
Route::get('/', [StudentController::class, 'index'])->name('student.index');
Route::get('/create', [StudentController::class, 'create'])->name('student.create');
Route::post('store', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
Route::get('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

// majors
Route::get('/major', [MajorController::class, 'index'])->name('major.index');
Route::get('/major/create', [MajorController::class, 'majorCreate'])->name('major.create');
Route::post('/major/store', [MajorController::class, 'majorStore'])->name('major.store');
Route::get('/major/edit/{id}', [MajorController::class, 'majorEdit'])->name('major.edit');
Route::post('/major/update/{id}', [MajorController::class, 'majorUpdate'])->name('major.update');
Route::get('/major/{id}', [MajorController::class, 'majorDestroy'])->name('major.destroy');

// export and import
Route::get('importExportView', [StudentController::class, 'importExportView'])->name('student.import');
Route::post('/import', [StudentController::class, 'import'])->name('import');
Route::get('/exportStudents', [StudentController::class, 'export'])->name('export.student');
