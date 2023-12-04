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


// -------- Admin ---------- //
Route::middleware('admin')->group(function () {
    route::get('/admin/page', [AdminController::class, 'index'])->name('admin.welcomepage');
    
    // -------- Profile ---------- //
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.destroy');
    
    // -------- Guest Star ---------- //
    route::get('/admin/guest', [AdminController::class, 'guest'])->name('admin.guest');
    route::get('/admin/guest/add', [AdminController::class, 'addGuest'])->name('admin.addGuest');
    route::post('/admin/guest/create', [AdminController::class, 'createGuest'])->name('admin.createGuest');
    route::get('/admin/guest/edit/{id}', [AdminController::class, 'editGuest'])->name('admin.editGuest');
    route::post('/admin/guest/update/{guest:id}', [AdminController::class, 'updateGuest'])->name('admin.updateGuest');
    route::get('/admin/guest/delete/{guest:id}', [AdminController::class, 'deleteGuest'])->name('admin.deleteGuest');

    // -------- Concert ---------- //
    route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');
    route::get('/admin/concert/add', [AdminController::class, 'addConcert'])->name('admin.addConcert');
    route::post('/admin/concert/create', [AdminController::class, 'createConcert'])->name('admin.createConcert');
    route::get('/admin/concert/edit/{id}', [AdminController::class, 'editConcert'])->name('admin.editConcert');
    route::post('/admin/concert/update/{concert:id}', [AdminController::class, 'updateConcert'])->name('admin.updateConcert');
    route::get('/admin/concert/delete/{concert:id}', [AdminController::class, 'deleteConcert'])->name('admin.deleteConcert');
    route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');
    
    // -------- Venue ---------- //
    route::get('/admin/venue', [AdminController::class, 'venue'])->name('admin.venue');
    route::get('/admin/venue/add', [AdminController::class, 'addVenue'])->name('admin.addVenue');
    route::post('/admin/venue/create', [AdminController::class, 'createVenue'])->name('admin.createVenue');
    route::get('/admin/venue/edit/{id}', [AdminController::class, 'editVenue'])->name('admin.editVenue');
    route::post('/admin/venue/update/{venue:id}', [AdminController::class, 'updateVenue'])->name('admin.updateVenue');
    route::get('/admin/venue/delete/{venue:id}', [AdminController::class, 'deleteVenue'])->name('admin.deleteVenue');
    route::get('/admin/venue', [AdminController::class, 'venue'])->name('admin.venue');

    // -------- City ---------- //
    route::get('/admin/city', [AdminController::class, 'city'])->name('admin.city');
    route::get('/admin/city/add', [AdminController::class, 'addCity'])->name('admin.addCity');
    route::post('/admin/city/create', [AdminController::class, 'createCity'])->name('admin.createCity');
    route::get('/admin/city/edit/{id}', [AdminController::class, 'editCity'])->name('admin.editCity');
    route::post('/admin/city/update/{city:id}', [AdminController::class, 'updateCity'])->name('admin.updateCity');
    route::get('/admin/city/delete/{city:id}', [AdminController::class, 'deleteCity'])->name('admin.deleteCity');
    route::get('/admin/city', [AdminController::class, 'city'])->name('admin.city');
});




require __DIR__ . '/auth.php';
