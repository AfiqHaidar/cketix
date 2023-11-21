<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --------- Concert -------------- //

// concert index
Route::get('/concert', [
    ConcertController::class, 'index'
])->middleware(['auth', 'verified'])->name('concert.index');

Route::get('/concert/{concert:name}', [
    ConcertController::class, 'show'
])->middleware(['auth', 'verified'])->name('concert.detail');

Route::get('/{guest}', [
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

Route::get('/transaction-history', [
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
});

require __DIR__ . '/auth.php';
