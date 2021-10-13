<?php

use AmirVahedix\Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');

Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');

Route::get('/admin/courses/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');
Route::patch('/admin/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');

Route::delete('/admin/courses/{course}', [CourseController::class, 'delete'])->name('admin.courses.delete');

Route::get('/admin/courses/{course}/reject', [CourseController::class, 'reject'])->name('admin.courses.reject');
Route::get('/admin/courses/{course}/accept', [CourseController::class, 'accept'])->name('admin.courses.accept');
