<?php

use AmirVahedix\Payment\Http\Controllers\SettlementController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/settlements')->group(function() {
    Route::get('/', [SettlementController::class, 'index'])
        ->name('dashboard.settlements.index');

    Route::get('/create', [SettlementController::class, 'create'])
        ->name('dashboard.settlements.create');

    Route::post('/', [SettlementController::class, 'store'])
        ->name('dashboard.settlements.store');
});
