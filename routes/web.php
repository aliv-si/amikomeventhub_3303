<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/detail-event/{id}', [EventController::class, 'detail'])->name('detail-event');

// Route::get('/checkout/{id}', [TicketController::class, 'checkout'])->name('checkout');

Route::get('/ticket/{id}', [TicketController::class, 'ticket'])->name('ticket');

// Ranah Admin

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {

    // Rute Login bebas akses

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Mengamankan Route Administrasidi balik tembok (Middleware)

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route Profile
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories');
        Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::get('categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}/edit', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}/edit', [AdminCategoryController::class, 'destroy'])->name('categories.delete');

        Route::get('/event', [AdminEventController::class, 'index'])->name('event');
        Route::post('/event', [AdminEventController::class, 'store'])->name('event.store');
        Route::get('/event/create', [AdminEventController::class, 'create'])->name('event.create');
        Route::get('/event/{id}/edit', [AdminEventController::class, 'edit'])->name('event.edit');
        Route::put('/event/{id}/edit', [AdminEventController::class, 'update'])->name('event.update');
        Route::delete('/event/{id}/edit', [AdminEventController::class, 'destroy'])->name('event.delete');

        Route::get('/partner', [AdminPartnerController::class, 'index'])->name('partner');
        Route::post('/partner', [AdminPartnerController::class, 'store'])->name('partner.store');
        Route::get('/partner/create', [AdminPartnerController::class, 'create'])->name('partner.create');
        Route::get('/partner/{id}/edit', [AdminPartnerController::class, 'edit'])->name('partner.edit');
        Route::put('/partner/{id}/edit', [AdminPartnerController::class, 'update'])->name('partner.update');
        Route::delete('/partner/{id}/edit', [AdminPartnerController::class, 'destroy'])->name('partner.delete');


        Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
        
        Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class);
    });
});

Route::get('/api/vouchers/check', [App\Http\Controllers\CheckoutController::class, 'checkVoucher'])->name('vouchers.check');

Route::get('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
Route::get('/payment/{order_id}', [App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{orderId}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
Route::post('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransWebhookController::class, 'handle']);

// Route Rating
Route::post('/rating/{order_id}', [\App\Http\Controllers\RatingController::class, 'store'])->name('rating.store');

// Route Tugas Bikin Sendiri

// Route::get('/profil', function () {
//     return view('profil');
// });

// Route::get('/katalog', function () {
//     return view('katalog');
// });

// Route::get('/bantuan', function () {
//     return view('bantuan');
// });

// Route::get('/kontak', function () {
//     return view('kontak');
// });

// Route Google Socialite
Route::get('/auth/google/callback', [\App\Http\Controllers\GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/google/{event_id}', [\App\Http\Controllers\GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
