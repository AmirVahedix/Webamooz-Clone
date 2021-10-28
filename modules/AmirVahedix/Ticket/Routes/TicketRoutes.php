<?php

use AmirVahedix\Ticket\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// prefix: dashboard/tickets

Route::get('/', [TicketController::class, 'index'])->name('dashboard.tickets.index');

Route::get('/create', [TicketController::class, 'create'])->name('dashboard.tickets.create');

Route::post('/', [TicketController::class, 'store'])->name('dashboard.tickets.store');
