<?php

use AmirVahedix\Payment\Http\Controllers\SettlementController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard/settlements')->group(function() {
    Route::get('/create', [SettlementController::class, 'create'])
        ->name('dashboard.settlements.create');
});
