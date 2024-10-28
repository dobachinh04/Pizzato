<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
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
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Client\PaymentController;

// Client Views demo
Route::get('/',                                             [ProductController::class, 'index'])->name('client.home');
Route::get('/show/{product}',                               [ProductController::class, 'show'])->name('client.show');

// Route::get('/categories/{id}',                          [PostController::class, 'categories'])->name('client.category');
// Route::get('/author/{id}',                              [PostController::class, 'author'])->name('client.author');
// Route::get('/show/{id}',                                [PostController::class, 'show'])->name('client.show');

// Display View:
Route::get('/login', [AuthenticationController::class, 'displayLogin'])->name('client.login');
Route::get('/register', [AuthenticationController::class, 'displayRegister'])->name('client.register');

// Login & Register:
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

// Route cho form đặt lại mật khẩu trực tiếp, không qua email
Route::get('/forgot-password', [AuthenticationController::class, 'showForgotPasswordForm'])->name('password.request');

// Route để xử lý việc đặt lại mật khẩu
Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('password.update');

// Logout:
// Route::post('/logout',                                  [AuthenticationController::class, 'logout'])->name('client.logout');

// Forgot Password:
// Route::get('forgot-password',                           [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('forgot-password',                          [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('reset-password/{token}',                    [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('reset-password',                           [ResetPasswordController::class, 'reset'])->name('password.update');


Route::resource('cart', CartController::class);
Route::get('/admin/carts', [CartController::class, 'index'])->name('admin.carts.giohang');

Route::put('/carts/{id}', [CartController::class, 'update'])->name('carts.update');
Route::delete('/carts/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
Route::delete('/carts/destroy-all', [CartController::class, 'destroyAll'])->name('carts.destroyAll');


// Route::get('/checkout/index',    [CheckoutController::class, 'index'])->name('checkout.index');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('payment', [PaymentController::class, 'VnpayPayment'])->name('payment.create');
Route::get('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
