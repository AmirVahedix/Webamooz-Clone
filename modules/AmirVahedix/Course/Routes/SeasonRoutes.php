<?php

// prefix: dashboard/seasons

use AmirVahedix\Course\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;

Route::post('/{course}', [SeasonController::class, 'store'])->name('admin.seasons.store');
