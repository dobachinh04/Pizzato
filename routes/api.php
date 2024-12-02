<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\MenuController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\VnpayController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\Auth\AuthenticationController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\Client\NotificationController;
use App\Http\Controllers\Client\ProductReviewController;
use App\Http\Controllers\Client\RefundController;
use App\Http\Controllers\Client\ChatController;
use App\Http\Controllers\Client\CategoryController;

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

// CheckoutController
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/get-delivery-area', [CheckoutController::class, 'getDeliveryArea']);
Route::post('/add-to-address', [CheckoutController::class, 'addToAddress']);
Route::get('/payment-status', [VnpayController::class, 'callback']);

// CouponController
// http://127.0.0.1:8000/api/coupons
Route::get('/coupons', [CouponController::class, 'getListCoupon']);
// http://127.0.0.1:8000/api/show/code (code coupon not id)
Route::get('/coupon/{code}', [CouponController::class, 'getCouponDetail']);

// ProductReviewController
Route::post('/reviews', [ProductReviewController::class, 'createReview']);
Route::get('/products/{productId}/reviews', [ProductReviewController::class, 'getReviews']);

// shttp://127.0.0.1:8000/api/reviews/13
// sửa theo id đánh giá nhưng đánh giá đó phải thuộc về người dùng hiện tại
// controller đang fix cứng id user = 1
Route::put('/reviews/{id}', [ProductReviewController::class, 'updateReview']);

Route::delete('/reviews/{id}', [ProductReviewController::class, 'deleteReview']);

// OrderController
Route::get('/orders', [OrderController::class, 'index']);

// Notification of delay orders
// Route::get('/overdue-orders', [OrderController::class, 'overdueOrders']);
Route::get('/notifications/{id}', [NotificationController::class, 'getNotificationByInvoiceId']);

// refunds
Route::post('/refund-request', [RefundController::class, 'createRefundRequest']);

Route::get('/chat/{adminId}', [ChatController::class, 'getMessages']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);


// category
Route::get('/categories', [CategoryController::class, 'index']);
