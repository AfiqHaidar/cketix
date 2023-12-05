<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Jobs\SendTicketMail;
use App\Mail\PromotionMail;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

Route::post('transaction-payment/{transaction:id}', [
    TransactionController::class, 'transactionPayment'
])->middleware(['auth', 'verified'])->name('ticket.payment');

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

    route::get('/admin/guest', [AdminController::class, 'guest'])->name('admin.guest');
    route::get('/admin/guest/add', [AdminController::class, 'addGuest'])->name('admin.addGuest');
    route::post('/admin/guest/create', [AdminController::class, 'createGuest'])->name('admin.createGuest');
    route::get('/admin/guest/edit/{id}', [AdminController::class, 'editGuest'])->name('admin.editGuest');
    route::post('/admin/guest/update/{guest:id}', [AdminController::class, 'updateGuest'])->name('admin.updateGuest');
    route::get('/admin/guest/delete/{guest:id}', [AdminController::class, 'deleteGuest'])->name('admin.deleteGuest');

    route::get('/admin/transaction', [AdminController::class, 'transaction'])->name('admin.transaction');
    route::get('/admin/payment/{transaction:id}', [AdminController::class, 'payment'])->name('admin.payment');
    route::get('/admin/payment-accept/{transaction:id}', [AdminController::class, 'acceptPayment'])->name('admin.acceptPayment');
    route::get('/admin/payment-decline/{transaction:id}', [AdminController::class, 'declinePayment'])->name('admin.declinePayment');

    route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');

    route::get('/admin/banner', [AdminController::class, 'banner'])->name('admin.banner');
    route::get('/admin/banner/add', [AdminController::class, 'addBanner'])->name('admin.addBanner');
    route::get('/admin/banner/edit/{id}', [AdminController::class, 'editBanner'])->name('admin.editBanner');
    // route::post('/admin/banner/create', [AdminController::class, 'createBanner'])->name('admin.createBanner');
});



foreach (scandir($path = app_path('Http/Module')) as $dir) {
    if (file_exists($filepath = "{$path}/{$dir}/Presentation/web.php")) {
        require $filepath;
    }
};


require __DIR__ . '/auth.php';
