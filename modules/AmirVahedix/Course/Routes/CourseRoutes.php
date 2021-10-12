<?php

use AmirVahedix\Course\Http\Requests\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
