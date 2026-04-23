<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NewsController;

Route::get('/', [GameController::class, 'homeView'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->intended('/admin');
        }
        return app(GameController::class)->homeView();
    })->name('dashboard');

    Route::get('/search', [GameController::class, 'searchView'])->name('search');
    Route::get('/api/search-suggestions', [GameController::class, 'suggestions'])->name('api.search.suggestions');

    Route::get('/giohang', [CartController::class, 'index'])->name('giohang');


    Route::prefix('tin-tuc')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('/{id}', [NewsController::class, 'show'])->name('news.show');
    });


    Route::get('/inventory', [GameController::class, 'indexView'])->name('inventory');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout-view', [OrderController::class, 'checkoutView'])->name('checkout.view');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    Route::get('/api/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/api/my-orders/{id}', [OrderController::class, 'showOrder']);

    Route::get('/my-orders/{id}/{game_id?}', [OrderController::class, 'showOrderView'])->name('keys');

    Route::get('/library', [OrderController::class, 'myLibraryView'])->name('library');

});

Route::get('/api/games', [GameController::class, 'index']);
Route::get('/api/games/{id}', [GameController::class, 'show']);

Route::get('/games/{id}', [GameController::class, 'showView'])->name('games.show');

Route::post('/payos-webhook', [OrderController::class, 'handlePayOSWebhook'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class, 'web', 'auth', 'csrf']);

require __DIR__ . '/auth.php';