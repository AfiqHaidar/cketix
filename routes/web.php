<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// --------- Concert -------------- //

Route::get('/dashboard', [
    ConcertController::class, 'dashboard'
])->middleware(['auth', 'verified'])->name('dashboard');

// concert index
Route::get('/concert', [
    ConcertController::class, 'index'
])->middleware(['auth', 'verified'])->name('concert.index');

Route::get('/concert/{id}', [
    ConcertController::class, 'show'
])->middleware(['auth', 'verified'])->name('concert.detail');

Route::get('/guest/{guest}', [
    ConcertController::class, 'guest'
])->middleware(['auth', 'verified'])->name('concert.guest');

// --------- Transaction -------------- //

// concert index
Route::post('/concert/{detail:date}/buy', [
    TransactionController::class, 'index'
])->middleware(['auth', 'verified'])->name('ticket.transaction');

Route::post('/concert/{detail:date}/buy/{category:id}', [
    TransactionController::class, 'store'
])->middleware(['auth', 'verified'])->name('ticket.create');

// --------- Users -------------- //

Route::get('/transaction-histori', [
    UserController::class, 'transactionHistory'
])->middleware(['auth', 'verified'])->name('user.transaction');

Route::get('/transaction-history/{transaction:id}', [
    UserController::class, 'transactionReceipt'
])->middleware(['auth', 'verified'])->name('user.receipt');

Route::get('/ticket', [
    UserController::class, 'ticket'
])->middleware(['auth', 'verified'])->name('user.ticket');



// -------- Middelware : Auth ---------- //

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/transaction-history', [ProfileController::class, 'transactionHistory'])->name('profile.transaction');
    Route::get('/ticket', [ProfileController::class, 'ticket'])->name('profile.ticket');
    Route::get('/transaction-history/{transaction:id}', [ProfileController::class, 'transactionReceipt'])->name('profile.receipt');
});

Route::middleware('admin')->group(function () {

    // -------- Admin ---------- //
    route::get('/admin/page', [AdminController::class, 'index'])->name('admin.welcomepage');
    route::get('/admin/guest', [AdminController::class, 'guest'])->name('admin.guest');
    route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');
});




require __DIR__ . '/auth.php';
