<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/tin-tuc', function () {
        return view('news.index');
    })->name('news.index');


    Route::get('/tin-tuc/chi-tiet', function () {
        return view('news.show');
    })->name('news.show');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/add/{id}', [CartController::class, 'add']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/my-orders/{id}', [OrderController::class, 'showOrder']);
});


Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);

Route::get('/games', function () {
    return view('games');
});

require __DIR__ . '/auth.php';