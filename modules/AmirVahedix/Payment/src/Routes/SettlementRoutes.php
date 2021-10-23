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

    Route::get('/{settlement}/accept', [SettlementController::class, 'accept'])
        ->name('dashboard.settlements.accept');

    Route::get('/{settlement}/reject', [SettlementController::class, 'reject'])
        ->name('dashboard.settlements.reject');

    Route::get('/{settlement}/cancel', [SettlementController::class, 'cancel'])
        ->name('dashboard.settlements.cancel');
});
