<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $events = \App\Models\Event::with('category')->oldest('created_at')->get();
    return view('welcome', compact('events'));
});

Route::get('/detail-event/{id}', function ($id) {
    $event = \App\Models\Event::with('category')->findOrFail($id);
    return view('event-detail', compact('event'));
});

Route::get('/checkout/{id}', function ($id) {
    $event = \App\Models\Event::with('category')->findOrFail($id);
    return view('checkout', compact('event'));
});

Route::get('/ticket/{id}', function ($id) {
    $event = \App\Models\Event::with('category')->findOrFail($id);
    return view('ticket', compact('event'));
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/event', function () {
    return view('admin.events');
});

Route::get('/transaksi', function () {
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
