<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'indexLog'])->name('home')->middleware('auth');
Route::get('/admin', [HomeController::class, 'indexAdmin'])->name('admin')->middleware('auth');


Route::prefix('users')->group(base_path('routes/users/user.php'));
Route::prefix('books')->group(base_path('routes/books/book.php'));
Route::prefix('writers')->group(base_path('routes/writers/writer.php'));
Route::prefix('comments')->group(base_path('routes/comments/comment.php'));
Route::prefix('purchases')->group(base_path('routes/purchases/purchase.php'));
Route::prefix('carts')->group(base_path('routes/carts/cart.php'));