<?php

use AmirVahedix\Payment\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::any('payment/callback', [PaymentController::class, 'callback'])
    ->name('payments.callback');
