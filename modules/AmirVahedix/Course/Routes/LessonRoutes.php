<?php

use AmirVahedix\Course\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])
    ->name('admin.lessons.create');
