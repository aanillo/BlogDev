<?php


use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'mostrarVistaLibros'])->name('books');
Route::get('/generos', [BookController::class, 'showGeneros'])->name('generos');
Route::get('/libros', [BookController::class, 'mostrarPorGenero'])->name('libros');
Route::get('/libro/{id}', [BookController::class, 'showBook'])->name('showBook');
Route::post('/books/{id}/rate', [BookController::class, 'rate'])->name('rateBook')->middleware('auth');

Route::get('/admin/books', [BookController::class, 'indexBooks'])->name('admin.books');

Route::get('/insert', [BookController::class, 'showInsert'])->name('insert');
Route::post('/store', [BookController::class, 'doInsert'])->name('doInsert');
Route::get('/admin/books/{id}/edit', [BookController::class, 'edit'])->name('edit');
Route::put('/admin/books/{id}', [BookController::class, 'update'])->name('update');
Route::delete('/admin/books/{id}', [BookController::class, 'delete'])->name('delete');
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
Route::get('/{id}', [CommentController::class, 'show'])->name('comments.show');
Route::delete('/comments/{id}/delete', [CommentController::class, 'delete'])->name('comments.delete');

Route::middleware(['auth'])->group(function() {
    //Route::get('/', [BookController::class, 'mostrarVistaLibros'])->name('books');
    // Route::get('/generos', [BookController::class, 'showGeneros'])->name('generos');
    // Route::get('/insert', [BookController::class, 'create'])->name('posts.insert');
    // Route::post('/store', [BookController::class, 'store'])->name('posts.store');
    // Route::get('/show', [BookController::class, 'show'])->name('posts.show');
    // Route::delete('/{id}', [BookController::class, 'delete'])->name('posts.delete');
    // Route::put('/{id}/like', [BookController::class, 'likePost'])->name('posts.like');
});


/*
Route::get('/rutaNoProtegida', function() {
    return view('viewNoProtegida');
});*/
