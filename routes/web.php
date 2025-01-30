<?php

use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['CTA_LINK' => true]);
});

Route::get('paypal', [PaypalController::class, 'index'])->name('paypal.index');
Route::get('paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PaypalController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaypalController::class, 'paymentCancel'])->name('paypal.payment.cancel');
