<?php


use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/comments', [CommentController::class, 'indexComments'])->name('admin.comments');
Route::delete('/admin/comments/{id}', [CommentController::class, 'deleteComment'])->name('admin.delete');