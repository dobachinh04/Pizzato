<?php

use App\Events\MessageSent;
use App\Http\Controllers\Client\RefundController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ChatController;
use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Client\ProductController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Client\Auth\AuthenticationController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Client\MomoController;
use App\Http\Controllers\Client\VnpayController;
use Illuminate\Support\Facades\Redis;
// Client Views demo
// Route::get('/',                                             [ProductController::class, 'index'])->name('client.home');
// Route::get('/show/{product}',                               [ProductController::class, 'show'])->name('client.show');

// Route::get('/categories/{id}',                          [PostController::class, 'categories'])->name('client.category');
// Route::get('/author/{id}',                              [PostController::class, 'author'])->name('client.author');
// Route::get('/show/{id}',                                [PostController::class, 'show'])->name('client.show');

// Display View:
// Route::get('/login', [AuthenticationController::class, 'displayLogin'])->name('client.login');
// Route::get('/register', [AuthenticationController::class, 'displayRegister'])->name('client.register');

// Login & Register:
// Route::post('/login', [AuthenticationController::class, 'login']);
// Route::post('/register', [AuthenticationController::class, 'register']);

// Route cho form đặt lại mật khẩu trực tiếp, không qua email
Route::get('/forgot-password', [AuthenticationController::class, 'showForgotPasswordForm'])->name('password.request');

// Route để xử lý việc đặt lại mật khẩu
Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('password.update');





Route::get('/client/carts', [CartController::class, 'index'])->name('client.carts.cart');
Route::put('/carts/{id}', [CartController::class, 'update'])->name('carts.update');
Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
Route::delete('/carts/destroy-all', [CartController::class, 'destroyAll'])->name('carts.destroyAll');




// Momo Payment
Route::get('payment/momo',             [MomoController::class, 'createPayment'])->name('payment.momo.create');
Route::get('payment/momo/callback',    [MomoController::class, 'callback'])->name('payment.momo.callback');

// VNPay routes
Route::get('payment/vnpay', [VnpayController::class, 'createPayment'])->name('payment.vnpay.create');
Route::get('payment/vnpay/callback', [VnpayController::class, 'callback'])->name('payment.vnpay.callback');

Route::get('/chat', [ChatController::class, 'index'])->name('client.chat.index');


// Oder
Route::get('/client/order_history', [OrderController::class, 'index'])
    ->name('client.order_history.index');
    // ->middleware('auth');
    Route::get('/client/order_history/{order}', [OrderController::class, 'show'])
    ->name('client.order_history.show');
    // ->middleware('auth');

// refund
Route::get('refunds/create', [RefundController::class, 'create'])->name('refunds.create');
Route::post('/refunds', [RefundController::class, 'store'])->name('refunds.store');
