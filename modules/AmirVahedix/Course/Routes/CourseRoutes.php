<?php

use AmirVahedix\Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');

Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');

Route::get('/courses/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');
Route::patch('/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');

Route::delete('/courses/{course}', [CourseController::class, 'delete'])->name('admin.courses.delete');

Route::get('/courses/{course}/accept', [CourseController::class, 'accept'])->name('admin.courses.accept');
Route::get('/courses/{course}/reject', [CourseController::class, 'reject'])->name('admin.courses.reject');

Route::get('/courses/{course}/details', [CourseController::class, 'details'])->name('admin.courses.details');

Route::post('/courses/{course}/buy', [CourseController::class, 'buy'])
    ->name('courses.buy');
