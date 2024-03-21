<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketOrderController;
use App\Models\TicketOrder;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'events'], function() {
    Route::get('create', [EventController::class, 'create'])->name('event.create');
    Route::post('create', [EventController::class, 'store'])->name('event.store');
    
    Route::get('', [EventController::class, 'index'])->name('event.index');
    Route::get('json/{event}', [EventController::class, 'getEventJson'])->name('event.json');
    Route::get('show/{event}', [EventController::class, 'show'])->name('event.show');
    
    Route::get('edit/{event}', [EventController::class, 'edit'])->name('event.edit');
    Route::put('update/{event}', [EventController::class, 'update'])->name('event.update');


    Route::get('delete/{event}', [EventController::class, 'delete'])->name('event.delete');
    Route::delete('delete/{event}', [EventController::class, 'destroy'])->name('event.destroy');
});

Route::group(['prefix' => 'ticket-order'], function() {
    Route::get('', [TicketOrderController::class, 'index'])->name('ticketOrder.index');
    Route::post('/filter', [TicketOrderController::class, 'filter'])->name('ticketOrder.filter');

    Route::get('create', [TicketOrderController::class, 'create'])->name('ticketOrder.create');
    Route::post('create', [TicketOrderController::class, 'store'])->name('ticketOrder.store');

    Route::get('show/{ticketOrder}', [TicketOrderController::class, 'show'])->name('ticketOrder.show');

    Route::get('edit/{ticketOrder}', [TicketOrderController::class, 'edit'])->name('ticketOrder.edit');
    Route::put('update/{ticketOrder}', [TicketOrderController::class, 'update'])->name('ticketOrder.update');


    Route::get('delete/{ticketOrder}', [TicketOrderController::class, 'delete'])->name('ticketOrder.delete');
    Route::delete('delete/{ticketOrder}', [TicketOrderController::class, 'destroy'])->name('ticketOrder.destroy');
});
