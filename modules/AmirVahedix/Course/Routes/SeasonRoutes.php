<?php

// prefix: dashboard/seasons

use AmirVahedix\Course\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;

Route::post('/{course}', [SeasonController::class, 'store'])->name('admin.seasons.store');

Route::get('/{season}', [SeasonController::class, 'edit'])->name('admin.seasons.edit');
Route::patch('/{season}', [SeasonController::class, 'update'])->name('admin.seasons.update');

Route::delete('/{season}', [SeasonController::class, 'delete'])->name('admin.seasons.destroy');

Route::get('/{season}/reject', [SeasonController::class, 'reject'])->name('admin.seasons.reject');
Route::get('/{season}/accept', [SeasonController::class, 'accept'])->name('admin.seasons.accept');
