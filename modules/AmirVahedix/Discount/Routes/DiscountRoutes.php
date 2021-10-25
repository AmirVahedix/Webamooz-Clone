<?php

use AmirVahedix\Discount\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;

Route::get('discount', [DiscountController::class, 'index'])
    ->name('admin.discounts.index');
