<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PromoCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Events routes
    Route::resource('events', EventController::class);

    // Ticket Types Management
    Route::post('/events/{event}/ticket-types', [TicketTypeController::class, 'store'])->name('ticket-types.store');
    Route::patch('/ticket-types/{ticketType}/add-quantity', [TicketTypeController::class, 'addQuantity'])->name('ticket-types.add-quantity');
    Route::patch('/ticket-types/{ticketType}/remove-quantity', [TicketTypeController::class, 'removeQuantity'])->name('ticket-types.remove-quantity');
    
    // Categories routes
    Route::resource('categories', CategoryController::class);
    
    // Tickets routes
    Route::resource('tickets', TicketController::class);
    Route::get('/my-tickets', [TicketController::class, 'myTickets'])->name('tickets.my-tickets');
    Route::post('/tickets/{ticket}/cancel', [TicketController::class, 'cancel'])->name('tickets.cancel');
    
    // Transactions routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/my-transactions', [TransactionController::class, 'myTransactions'])->name('transactions.my-transactions');

    // Agents routes
    Route::resource('agents', AgentController::class);

    // Promo Codes routes
    Route::resource('promo-codes', PromoCodeController::class);
    Route::post('promo-codes/validate', [PromoCodeController::class, 'validateCode'])->name('promo-codes.validate');
});

require __DIR__.'/auth.php';
