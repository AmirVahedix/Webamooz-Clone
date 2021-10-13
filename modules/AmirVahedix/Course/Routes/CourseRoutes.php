<?php

use AmirVahedix\Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');

Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');

Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');

Route::delete('/courses/{course}', [CourseController::class, 'delete'])->name('admin.courses.delete');
