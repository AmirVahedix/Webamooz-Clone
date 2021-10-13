<?php

use AmirVahedix\Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard/courses', [CourseController::class, 'index'])->name('admin.courses.index');

Route::get('/dashboard/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
Route::post('/dashboard/courses', [CourseController::class, 'store'])->name('admin.courses.store');

Route::get('/dashboard/courses/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');
Route::patch('/dashboard/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');

Route::delete('/dashboard/courses/{course}', [CourseController::class, 'delete'])->name('admin.courses.delete');

Route::get('/dashboard/courses/{course}/reject', [CourseController::class, 'reject'])->name('admin.courses.reject');
Route::get('/dashboard/courses/{course}/accept', [CourseController::class, 'accept'])->name('admin.courses.accept');
