<?php

use AmirVahedix\Comment\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;


Route::post('/coments', [CommentsController::class, 'store'])
    ->name('comments.store');
