<?php

use AmirVahedix\Front\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::get('/courses/{slug}', [FrontController::class, 'singleCourse'])
    ->name('courses.single');

Route::get('/c/{id}', [FrontController::class, 'shortCourseLink'])
    ->name('courses.link.short');
