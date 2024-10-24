<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CartController;
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
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;





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

    //Admin - Addresses:
    Route::prefix('addresses')->name('addresses.')->group(function () {
        Route::get('/',                                 [AddressController::class, 'index'])->name('index');
        Route::get('/create',                           [AddressController::class, 'create'])->name('create');
        Route::post('/',                                [AddressController::class, 'store'])->name('store');
        Route::get('/{address}/edit',                   [AddressController::class, 'edit'])->name('edit');
        Route::put('/{address}',                        [AddressController::class, 'update'])->name('update');
        Route::delete('/{address}',                     [AddressController::class, 'destroy'])->name('destroy');
    });

    // Admin - delivery_areas:
    Route::prefix('delivery_areas')->name('delivery_areas.')->group(function () {
        Route::get('/',                                 [DeliveryAreaController::class, 'index'])->name('index');
        Route::get('/create',                           [DeliveryAreaController::class, 'create'])->name('create');
        Route::post('/',                                [DeliveryAreaController::class, 'store'])->name('store');
        Route::get('/edit/{deliveryArea}',              [DeliveryAreaController::class, 'edit'])->name('edit');
        Route::put('/{deliveryArea}',                   [DeliveryAreaController::class, 'update'])->name('update');
        Route::get('/show/{deliveryArea}',              [DeliveryAreaController::class, 'show'])->name('show');
        Route::delete('/{deliveryArea}',                [DeliveryAreaController::class, 'destroy'])->name('destroy');
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

    // Admin - Blog Categories:
    Route::prefix('blog-categories')->name('blog-categories.')->group(function () {
        Route::get('/',                                 [BlogCategoryController::class, 'index'])->name('index');
        Route::get('/create',                           [BlogCategoryController::class, 'create'])->name('create');
        Route::post('/',                                [BlogCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{blogCategory}',              [BlogCategoryController::class, 'edit'])->name('edit');
        Route::put('/{blogCategory}',                   [BlogCategoryController::class, 'update'])->name('update');
        Route::get('/show/{blogCategory}',              [BlogCategoryController::class, 'show'])->name('show');
        Route::delete('/{blogCategory}',                [BlogCategoryController::class, 'destroy'])->name('destroy');
    });


    // Admin - Blogs:
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/',                                 [BlogController::class, 'index'])->name('index');
        Route::get('/create',                           [BlogController::class, 'create'])->name('create');
        Route::post('/',                                [BlogController::class, 'store'])->name('store');
        Route::get('/edit/{blog}',                      [BlogController::class, 'edit'])->name('edit');
        Route::put('/{blog}',                           [BlogController::class, 'update'])->name('update');
        Route::get('/show/{blog}',                      [BlogController::class, 'show'])->name('show');
        Route::delete('/{blog}',                        [BlogController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/',                                 [SliderController::class, 'index'])->name('index');
        Route::get('/create',                           [SliderController::class, 'create'])->name('create');
        Route::post('/',                                [SliderController::class, 'store'])->name('store');
        Route::get('/edit/{slider}',                      [SliderController::class, 'edit'])->name('edit');
        Route::put('/{slider}',                           [SliderController::class, 'update'])->name('update');
        Route::get('/show/{slider}',                      [SliderController::class, 'show'])->name('show');
        Route::delete('/{slider}',                        [SliderController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/',                                 [OrderController::class, 'index'])->name('index');
        Route::get('/create',                           [OrderController::class, 'create'])->name('create');
        Route::post('/',                                [OrderController::class, 'store'])->name('store');
        Route::get('/{order}/edit',                     [OrderController::class, 'edit'])->name('edit');
        Route::put('/{order}',                          [OrderController::class, 'update'])->name('update');
        Route::get('/show/{order}',                     [OrderController::class, 'show'])->name('show');
        Route::delete('/{order}',                       [OrderController::class, 'destroy'])->name('destroy');
        Route::get('/deleted',                          [OrderController::class, 'deleted'])->name('deleted');
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
Route::resource('carts', CartController::class);
