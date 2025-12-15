<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{game}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

// Fallback for dashboard route to prevent 404/RouteNotFound
Route::get('/dashboard', function () {
    return redirect()->route('games.index');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Friends & Chat
    Route::get('/friends', [\App\Http\Controllers\FriendController::class, 'index'])->name('friends.index');
    Route::post('/friends', [\App\Http\Controllers\FriendController::class, 'store'])->name('friends.store');
    Route::patch('/friends/{id}', [\App\Http\Controllers\FriendController::class, 'update'])->name('friends.update');
    Route::delete('/friends/{id}', [\App\Http\Controllers\FriendController::class, 'destroy'])->name('friends.destroy');

    Route::get('/chat/{userId}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{userId}', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');

    // Forum Routes
    Route::get('/games/{gameId}/forum', [\App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::get('/games/{gameId}/forum/{postId}', [\App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/games/{gameId}/forum', [\App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::post('/forum/{postId}/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('games', \App\Http\Controllers\Admin\GameController::class);
    });
});

require __DIR__.'/auth.php';
