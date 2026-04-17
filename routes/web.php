<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/event-detail', function () {
    return view('event-detail');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/ticket', function () {
    return view('ticket');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/dashboard/events', function () {
    return view('admin.events');
});

Route::get('/dashboard/transactions', function () {
    return view('admin.transactions');
});

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
