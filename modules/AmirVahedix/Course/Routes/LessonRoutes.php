<?php

use AmirVahedix\Course\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])
    ->name('admin.lessons.create');

Route::post('courses/{course}/lessons', [LessonController::class, 'store'])
    ->name('admin.lessons.store');

Route::get('courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])
    ->name('admin.lessons.edit');

Route::patch('courses/{course}/lessons/{lesson}', [LessonController::class, 'update'])
    ->name('admin.lessons.update');

Route::delete('courses/{course}/lesson/{lesson}/delete', [LessonController::class, 'delete'])
    ->name('admin.lessons.destroy');

Route::delete('courses/{course}/lesson/multiple/deleteMultiple', [LessonController::class, 'multipleDelete'])
    ->name('admin.lessons.delete.multiple');

Route::get('courses/{course}/lesson/{lesson}/accept', [LessonController::class, 'accept'])
    ->name('admin.lessons.accept');

Route::patch('courses/{course}/lesson/accept/all', [LessonController::class, 'acceptAll'])
    ->name('admin.lessons.acceptAll');

Route::patch('courses/{course}/lesson/accept/multiple', [LessonController::class, 'acceptMultiple'])
    ->name('admin.lessons.accept.multiple');

Route::get('courses/{course}/lesson/{lesson}/reject', [LessonController::class, 'reject'])
    ->name('admin.lessons.reject');

Route::patch('courses/{course}/lesson/reject/multiple', [LessonController::class, 'rejectMultiple'])
    ->name('admin.lessons.reject.multiple');
