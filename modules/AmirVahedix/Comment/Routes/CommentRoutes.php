<?php

use AmirVahedix\Comment\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;


Route::post('/coments/{commentable}', [CommentsController::class, 'store'])
    ->name('comments.store');
