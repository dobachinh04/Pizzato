<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\MenuController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\Auth\AuthenticationController;
use App\Http\Controllers\Client\CouponController as ClientCouponController;
use App\Http\Controllers\Client\ProductReviewController as ClienProductReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });v

// AuthController
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// IndexController
Route::get('/menu', [IndexController::class, 'getMenuPizza']);
Route::get('/categories', [IndexController::class, 'getCategories']);
Route::get('/hot-product', [IndexController::class, 'getHotProduct']);

// MenuController
Route::get('/menus', [MenuController::class, 'getMenuPizza']);

// DetailController
Route::get('/detail/{id}', [DetailController::class, 'getDetailPizza']);
Route::get('/similar-pizza/{id}', [DetailController::class, 'getSimilarPizzas']);

// BlogController
// http://127.0.0.1:8000/api/blogs
Route::get('/blogs', [BlogController::class, 'getBlog']);

// http://127.0.0.1:8000/api/blog/1
Route::get('/blog/{id}', [BlogController::class, 'getBlogDetail']);

// Payment
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Coupons
// http://127.0.0.1:8000/api/coupons
Route::get('/coupons', [ClientCouponController::class, 'getListCoupon']); // Lấy danh sách mã giảm giá khả dụng
// http://127.0.0.1:8000/api/show/code (code coupon not id)
Route::get('/show/{code}', [ClientCouponController::class, 'getCouponDetail']); // Kiểm tra thông tin một mã giảm giá
// Route::middleware('auth:sanctum')->group(function () {
//     Route::prefix('product/reviews')->name('product.reviews.')->group(function(){
//         Route::get('', [ClientCouponController::class, 'getListCoupon']); // Lấy danh sách mã giảm giá khả dụng
//         Route::post('product/reviews', [ClienProductReviewController::class, 'sendRating'])->name('product-reviews.index');
//         Route::put('/{id}', [ClienProductReviewController::class, 'update'])->name('product-reviews.update');
//         Route::delete('/{id}', [ClienProductReviewController::class, 'destroy'])->name('product-reviews.destroy');
//     });
// });


    Route::post('/reviews', [ClienProductReviewController::class, 'createReview']);
    Route::get('/products/{productId}/reviews', [ClienProductReviewController::class, 'getReviews']);

    Route::put('/reviews/{id}', [ClienProductReviewController::class, 'updateReview']);
    Route::delete('/reviews/{id}', [ClienProductReviewController::class, 'deleteReview']);

