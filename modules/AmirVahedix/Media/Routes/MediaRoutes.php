<?php

use AmirVahedix\Media\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('media/{media}', [MediaController::class, 'download'])
    ->name('media.download')->middleware('signed');
