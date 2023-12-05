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

// --------- Search -------------- //

Route::post('/concert/search', [
    ConcertController::class, 'indexSearch'
])->middleware(['auth', 'verified'])->name('concert.index.search');


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

    // -------- Transaction ---------- //
    route::get('/admin/transaction', [AdminController::class, 'transaction'])->name('admin.transaction');
    route::get('/admin/paymentTr/{transaction:id}', [AdminController::class, 'paymentTr'])->name('admin.payment.tr');
    route::get('/admin/payment-accept/{transaction:id}', [AdminController::class, 'acceptPayment'])->name('admin.acceptPayment');
    route::get('/admin/payment-decline/{transaction:id}', [AdminController::class, 'declinePayment'])->name('admin.declinePayment');

    // -------- Banner ---------- //
    route::get('/admin/banner', [AdminController::class, 'banner'])->name('admin.banner');
    route::get('/admin/banner/add', [AdminController::class, 'addBanner'])->name('admin.addBanner');
    route::get('/admin/banner/edit/{id}', [AdminController::class, 'editBanner'])->name('admin.editBanner');
    // route::post('/admin/banner/create', [AdminController::class, 'createBanner'])->name('admin.createBanner');

    // -------- Concert ---------- //
    route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');
    route::get('/admin/concert/add', [AdminController::class, 'addConcert'])->name('admin.addConcert');
    route::post('/admin/concert/create', [AdminController::class, 'createConcert'])->name('admin.createConcert');
    route::get('/admin/concert/edit/{id}', [AdminController::class, 'editConcert'])->name('admin.editConcert');
    route::post('/admin/concert/update/{concert:id}', [AdminController::class, 'updateConcert'])->name('admin.updateConcert');
    route::get('/admin/concert/delete/{concert:id}', [AdminController::class, 'deleteConcert'])->name('admin.deleteConcert');
    route::get('/admin/concert', [AdminController::class, 'concert'])->name('admin.concert');

    // -------- Guest Star Details---------- //
    route::get('/admin/guest_details', [AdminController::class, 'guest_details'])->name('admin.guest_details');
    route::get('/admin/guest_details/add', [AdminController::class, 'addGuestDetails'])->name('admin.addGuestDetails');
    route::post('/admin/guest_details/create', [AdminController::class, 'createGuestDetails'])->name('admin.createGuestDetails');
    route::get('/admin/guest_details/edit/{id}', [AdminController::class, 'editGuestDetails'])->name('admin.editGuestDetails');
    route::post('/admin/guest_details/update/{guest_details:id}', [AdminController::class, 'updateGuestDetails'])->name('admin.updateGuestDetails');
    route::get('/admin/guest_details/delete/{guest_details:id}', [AdminController::class, 'deleteGuestDetails'])->name('admin.deleteGuestDetails');

    // -------- Concert Details---------- //
    route::get('/admin/concert_details', [AdminController::class, 'concert_details'])->name('admin.concert_details');
    route::get('/admin/concert_details/add', [AdminController::class, 'addConcertDetails'])->name('admin.addConcertDetails');
    route::post('/admin/concert_details/create', [AdminController::class, 'createConcertDetails'])->name('admin.createConcertDetails');
    route::get('/admin/concert_details/edit/{id}', [AdminController::class, 'editConcertDetails'])->name('admin.editConcertDetails');
    route::post('/admin/concert_details/update/{concert_details:id}', [AdminController::class, 'updateConcertDetails'])->name('admin.updateConcertDetails');
    route::get('/admin/concert_details/delete/{concert_details:id}', [AdminController::class, 'deleteConcertDetails'])->name('admin.deleteConcertDetails');

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

    // -------- Payment Method ---------- //
    route::get('/admin/payment', [AdminController::class, 'payment'])->name('admin.payment');
    route::get('/admin/payment/add', [AdminController::class, 'addPayment'])->name('admin.addPayment');
    route::post('/admin/payment/create', [AdminController::class, 'createPayment'])->name('admin.createPayment');
    route::get('/admin/payment/edit/{id}', [AdminController::class, 'editPayment'])->name('admin.editPayment');
    route::post('/admin/payment/update/{payment:id}', [AdminController::class, 'updatePayment'])->name('admin.updatePayment');
    route::get('/admin/payment/delete/{payment:id}', [AdminController::class, 'deletePayment'])->name('admin.deletePayment');
    route::get('/admin/payment', [AdminController::class, 'payment'])->name('admin.payment');

    // -------- Category ---------- //
    route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    route::get('/admin/categories/add', [AdminController::class, 'addCategories'])->name('admin.addCategories');
    route::post('/admin/categories/create', [AdminController::class, 'createCategories'])->name('admin.createCategories');
    route::get('/admin/categories/edit/{id}', [AdminController::class, 'editCategories'])->name('admin.editCategories');
    route::post('/admin/categories/update/{categories:id}', [AdminController::class, 'updateCategories'])->name('admin.updateCategories');
    route::get('/admin/categories/delete/{categories:id}', [AdminController::class, 'deleteCategories'])->name('admin.deleteCategories');
    route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
});



foreach (scandir($path = app_path('Http/Module')) as $dir) {
    if (file_exists($filepath = "{$path}/{$dir}/Presentation/web.php")) {
        require $filepath;
    }
};


require __DIR__ . '/auth.php';
