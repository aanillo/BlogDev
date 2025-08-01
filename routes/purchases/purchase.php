<?php

use App\Http\Controllers\PurchaseController;

Route::get('/purchase-checkout/{book_id}', [PurchaseController::class, 'create'])->name('purchaseCheckout');
Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/purchase/success/{purchase}', [PurchaseController::class, 'success'])->name('purchase.success');
Route::get('/purchase/failure/{purchase}', [PurchaseController::class, 'failure'])->name('purchase.failure');
Route::get('/paypal/checkout/{purchase}', [PurchaseController::class, 'processPayPalPayment']);
Route::get('/purchase-checkout', [PurchaseController::class, 'checkoutAll'])->name('purchaseCheckoutAll');
Route::post('/cart/checkout', [PurchaseController::class, 'storeAll'])->name('purchase.storeAll');

Route::get('/admin/purchases', [PurchaseController::class, 'indexPurchase'])->name('admin.purchases');
Route::delete('/admin/purchases/{purchase}', [PurchaseController::class, 'deletePurchase'])->name('admin.deletePurchase');