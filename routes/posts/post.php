<?php


use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


// Posts
Route::get('/insert', [PostController::class, 'showInsert'])->name('insert.show');
Route::post('/insert', [PostController::class, 'doInsert'])->name('doInsert');
Route::get('/show/{id}', [PostController::class, 'showPost'])->name('show');
Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/edit/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('delete');

// Posts por tipo
Route::get('/posts/type/{type}', [PostController::class, 'getPostsByType'])->name('type');

// Comments
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}/delete', [CommentController::class, 'delete'])->name('comments.delete');

// Comentario individual (restricción numérica)
Route::get('/{id}', [CommentController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('comments.show');

Route::get('/admin/posts', [PostController::class, 'indexPosts'])->name('admin.posts');
Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->name('edit');
Route::put('/admin/posts/{id}', [PostController::class, 'update'])->name('update');
Route::delete('/admin/posts/{id}', [PostController::class, 'delete'])->name('delete');
