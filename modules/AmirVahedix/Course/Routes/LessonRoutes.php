<?php

use AmirVahedix\Course\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])
    ->name('admin.lessons.create');

Route::post('courses/{course}/lessons', [LessonController::class, 'store'])
    ->name('admin.lessons.store');

Route::delete('courses/{course}/lesson/{lesson}/delete', [LessonController::class, 'delete'])
    ->name('admin.lessons.destroy');
