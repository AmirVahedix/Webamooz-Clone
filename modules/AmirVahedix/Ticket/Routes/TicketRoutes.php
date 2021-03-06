<?php

use AmirVahedix\Ticket\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// prefix: dashboard/tickets

Route::get('/', [TicketController::class, 'index'])->name('dashboard.tickets.index');

Route::get('/create', [TicketController::class, 'create'])->name('dashboard.tickets.create');

Route::post('/', [TicketController::class, 'store'])->name('dashboard.tickets.store');

Route::get('/{ticket}/show', [TicketController::class, 'show'])->name('dashboard.tickets.show');

Route::post('/{ticket}/reply', [TicketController::class, 'reply'])->name('dashboard.tickets.reply');

Route::get('/{ticket}/close', [TicketController::class, 'close'])->name('dashboard.tickets.close');

Route::delete('/{ticket}/destroy', [TicketController::class, 'delete'])->name('dashboard.tickets.destroy');

