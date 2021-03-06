<?php

use AmirVahedix\Payment\Http\Controllers\PaymentController;
use AmirVahedix\Payment\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::any('payment/callback', [PaymentController::class, 'callback'])
    ->name('payments.callback');

Route::prefix('dashboard')->group(function() {
    Route::get('payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
});
