<?php

use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{item_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');