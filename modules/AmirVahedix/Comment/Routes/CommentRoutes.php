<?php

use AmirVahedix\Comment\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;


Route::post('/comments', [CommentsController::class, 'store'])
    ->name('comments.store');

Route::prefix('/dashboard/comments')->name('dashboard.comments.')->group(function() {
    Route::get('/', [CommentsController::class, 'index'])->name('index');
    Route::delete('/{comment}', [CommentsController::class, 'delete'])->name('destroy');
    Route::get('/{comment}/approve', [CommentsController::class, 'approve'])->name('approve');
    Route::get('/{comment}/reject', [CommentsController::class, 'reject'])->name('reject');
});
