<?php

// prefix: dashboard/seasons

use AmirVahedix\Course\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;

Route::post('/{course}', [SeasonController::class, 'store'])->name('admin.seasons.store');

Route::get('/{season}', [SeasonController::class, 'edit'])->name('admin.seasons.edit');
Route::patch('/{season}', [SeasonController::class, 'update'])->name('admin.seasons.update');

Route::delete('/{season}', [SeasonController::class, 'delete'])->name('admin.seasons.destroy');
