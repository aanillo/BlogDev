<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'indexLog'])->name('home')->middleware('auth');
Route::get('/admin', [HomeController::class, 'indexAdmin'])->name('admin')->middleware('auth');


Route::prefix('users')->group(base_path('routes/users/user.php'));
Route::prefix('posts')->group(base_path('routes/posts/post.php'));
Route::prefix('comments')->group(base_path('routes/comments/comment.php'));
