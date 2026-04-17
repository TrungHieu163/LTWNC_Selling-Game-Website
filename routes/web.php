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

    // --- PHẦN PHÚC THÊM: Logic Admin Dashboard ---
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->intended('/admin');
        }
        return view('dashboard');
    })->name('dashboard');
    // ------------------------------------------

    Route::get('/search', [GameController::class, 'searchView'])->name('search');
    Route::get('/api/search-suggestions', [GameController::class, 'suggestions'])->name('api.search.suggestions');

    Route::get('/giohang', [CartController::class, 'index'])->name('giohang');

    Route::get('/tin-tuc', function () {
        return view('news.index');
    })->name('news.index');

    Route::get('/tin-tuc/chi-tiet', function () {
        return view('news.show');
    })->name('news.show');

    // Giữ nguyên route này của bạn ông
    Route::get('/giohang', function () {
        return view('giohang');
    })->name('giohang');

    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/add/{id}', [CartController::class, 'add']);
    Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::get('/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/my-orders/{id}', [OrderController::class, 'showOrder']);

    // --- CÁC ROUTE BỊ ĐẨY RA NGOÀI ĐÃ ĐƯỢC ĐƯA VÀO TRONG GROUP ---
    Route::get('/games', function () {
        return view('games');
    });

    Route::get('/games', [GameController::class, 'index']);
    Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    Route::get('/api/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/api/my-orders/{id}', [OrderController::class, 'showOrder']);

    Route::get('/my-orders/{id}', [OrderController::class, 'showOrderView'])->name('orders.show');

    Route::get('/library', [OrderController::class, 'myLibraryView'])->name('library');
}); // Đóng đúng ngoặc middleware tại đây

// --- PUBLIC ROUTES ---
Route::get('/api/games', [GameController::class, 'index']);
Route::get('/api/games/{id}', [GameController::class, 'show']);

Route::get('/games', [GameController::class, 'indexView'])->name('home');
Route::get('/games/{id}', [GameController::class, 'showView'])->name('games.show');

require __DIR__ . '/auth.php';