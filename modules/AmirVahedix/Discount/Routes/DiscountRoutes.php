<?php

use AmirVahedix\Discount\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DiscountController::class, 'index'])
    ->name('admin.discounts.index');

Route::post('/', [DiscountController::class, 'store'])
    ->name('admin.discounts.store');
