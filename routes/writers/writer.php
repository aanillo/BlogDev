<?php


use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WriterController::class, 'mostrarVistaAutores'])->name('writers');
Route::get('/autor/{id}', [WriterController::class, 'showWriter'])->name('show');

Route::get('/admin/writers', [WriterController::class, 'indexWriters'])->name('admin.writers');

Route::get('/insert', [WriterController::class, 'showInsert'])->name('insertWriter');
Route::post('/store', [WriterController::class, 'doInsert'])->name('doInsertWriter');
Route::get('/admin/writers/{id}/edit', [WriterController::class, 'edit'])->name('editWriter');
Route::put('/admin/writers/{id}', [WriterController::class, 'update'])->name('updateWriter');
Route::delete('/admin/writers/{id}', [WriterController::class, 'delete'])->name('deleteWriter');