<?php

use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\AdminMiddleware;

use Illuminate\Support\Facades\Route;


// Client Views demo
Route::get('/',                                             [ProductController::class, 'index'])->name('client.home');
Route::get('/show/{product}',                                             [ProductController::class, 'show'])->name('client.show');

// Route::get('/categories/{id}',                          [PostController::class, 'categories'])->name('client.category');
// Route::get('/author/{id}',                              [PostController::class, 'author'])->name('client.author');
// Route::get('/show/{id}',                                [PostController::class, 'show'])->name('client.show');

// Client - Login - Register:
// Display View:
// Route::get('/login',                                    [AuthenticationController::class, 'displayLogin'])->name('client.login');
// Route::get('/register',                                 [AuthenticationController::class, 'displayRegister'])->name('client.register');

// Login & Register:
// Route::post('/login',                                   [AuthenticationController::class, 'login']);
// Route::post('/register',                                [AuthenticationController::class, 'register']);

// Logout:
// Route::post('/logout',                                  [AuthenticationController::class, 'logout'])->name('client.logout');

// Forgot Password:
// Route::get('forgot-password',                           [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('forgot-password',                          [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('reset-password/{token}',                    [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('reset-password',                           [ResetPasswordController::class, 'reset'])->name('password.update');

// Admin Auth:
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin - Dashboard:
    Route::get('/dashboard',                            [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart',                                [DashboardController::class, 'chart'])->name('chart');

    // Admin - products Categories:
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/',                                 [CategoryController::class, 'index'])->name('index');
        Route::get('/create',                           [CategoryController::class, 'create'])->name('create');
        Route::post('/',                                [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit',                  [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}',                       [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}',                    [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Admin - products:
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',                                 [AdminProductController::class, 'index'])->name('index');
        Route::get('/create',                           [AdminProductController::class, 'create'])->name('create');
        Route::post('/',                                [AdminProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit',                   [AdminProductController::class, 'edit'])->name('edit');
        Route::put('/{product}',                        [AdminProductController::class, 'update'])->name('update');
        Route::get('/show/{product}',                   [AdminProductController::class, 'show'])->name('show');
        Route::delete('/{product}',                     [AdminProductController::class, 'destroy'])->name('destroy');
    });

    // Admin - Tags:
    // Route::prefix('tags')->name('tags.')->group(function() {
    //     Route::get('/',                                 [TagController::class, 'index'])->name('index');
    //     Route::get('/create',                           [TagController::class, 'create'])->name('create');
    //     Route::post('/',                                [TagController::class, 'store'])->name('store');
    //     Route::get('/{id}/edit',                        [TagController::class, 'edit'])->name('edit');
    //     Route::put('/{id}',                             [TagController::class, 'update'])->name('update');
    //     Route::get('/show/{id}',                        [TagController::class, 'show'])->name('show');
    //     Route::delete('/{id}',                          [TagController::class, 'destroy'])->name('destroy');
    // });

    // Admin - Users:
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/',                                 [UserController::class, 'index'])->name('index');
        Route::get('/create',                           [UserController::class, 'create'])->name('create');
        Route::post('/',                                [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}',                      [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}',                           [UserController::class, 'update'])->name('update');
        Route::get('/show/{user}',                      [UserController::class, 'show'])->name('show');
        Route::delete('/{user}',                        [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/',                                 [OrderController::class, 'index'])->name('index');
        Route::get('/create',                           [OrderController::class, 'create'])->name('create');
        Route::post('/',                                [OrderController::class, 'store'])->name('store');
        Route::get('/{order}/edit',                      [OrderController::class, 'edit'])->name('edit');
        Route::put('/{order}',                           [OrderController::class, 'update'])->name('update');
        Route::get('/show/{order}',                      [OrderController::class, 'show'])->name('show');
        Route::delete('/{order}',                        [OrderController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('shipping')->name('shipping.')->group(function () {
        Route::get('/',                                 [UserController::class, 'index'])->name('index');
        Route::get('/create',                           [UserController::class, 'create'])->name('create');
        Route::post('/',                                [UserController::class, 'store'])->name('store');
        Route::get('/{shipping}/edit',                      [UserController::class, 'edit'])->name('edit');
        Route::put('/{shipping}',                           [UserController::class, 'update'])->name('update');
        Route::get('/show/{shipping}',                      [UserController::class, 'show'])->name('show');
        Route::delete('/{shipping}',                        [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/',                                 [UserController::class, 'index'])->name('index');
        Route::get('/payment',                           [UserController::class, 'create'])->name('create');
        Route::post('/',                                [UserController::class, 'store'])->name('store');
        Route::get('/{payment}/edit',                      [UserController::class, 'edit'])->name('edit');
        Route::put('/{payment}',                           [UserController::class, 'update'])->name('update');
        Route::get('/show/{payment}',                      [UserController::class, 'show'])->name('show');
        Route::delete('/{payment}',                        [UserController::class, 'destroy'])->name('destroy');
    });
});