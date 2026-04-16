<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// --- TRANG CHỦ ---
Route::get('/', function () {
    return view('welcome');
});

// --- NHÓM ROUTE YÊU CẦU ĐĂNG NHẬP ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Logic điều hướng Dashboard (Admin vào /admin, User ở lại /dashboard)
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->intended('/admin');
        }
        return view('dashboard');
    })->name('dashboard');

    // Tìm kiếm
    Route::get('/search', [GameController::class, 'searchView'])->name('search');
    Route::get('/api/search-suggestions', [GameController::class, 'suggestions'])->name('api.search.suggestions');

    // Tin tức
    Route::get('/tin-tuc', function () {
        return view('news.index');
    })->name('news.index');
    Route::get('/tin-tuc/chi-tiet', function () {
        return view('news.show');
    })->name('news.show');

    // Kho đồ / Thư viện
    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');
    Route::get('/library', [OrderController::class, 'myLibraryView'])->name('library');

    // Profile cá nhân
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Giỏ hàng (Cart)
    Route::get('/giohang', [CartController::class, 'index'])->name('giohang');
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Đơn hàng & Thanh toán (Checkout)
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/my-orders/{id}', [OrderController::class, 'showOrderView'])->name('orders.show');

    // API cho Mobile hoặc AJAX (Nếu cần)
    Route::get('/api/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/api/my-orders/{id}', [OrderController::class, 'showOrder']);
});

// --- NHÓM ROUTE CÔNG KHAI (KHÔNG CẦN ĐĂNG NHẬP CŨNG XEM ĐƯỢC) ---
Route::get('/games', [GameController::class, 'indexView'])->name('home');
Route::get('/games/{id}', [GameController::class, 'showView'])->name('games.show');

// API Games
Route::get('/api/games', [GameController::class, 'index']);
Route::get('/api/games/{id}', [GameController::class, 'show']);

// Nhóm route mặc định của Laravel Breeze/Jetstream
require __DIR__ . '/auth.php';