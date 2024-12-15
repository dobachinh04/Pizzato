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
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\Client\NotificationController;
use App\Http\Controllers\Client\ProductReviewController;
use App\Http\Controllers\Client\RefundController;
use App\Http\Controllers\Client\ChatController;

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
// http://127.0.0.1:8000/api/all-categories
Route::get('/all-categories', [MenuController::class, 'getCategories']);
Route::get('/menus', [MenuController::class, 'getMenuPizza']);
Route::get('/pizza-rating', [MenuController::class, 'getPizzaRating']);
Route::get('/pizza-rating-on-top', [MenuController::class, 'getPizzaRatingOnTop']);

// DetailController
Route::get('/detail/{id}', [DetailController::class, 'getDetailPizza']);
Route::get('/similar-pizza/{id}', [DetailController::class, 'getSimilarPizzas']);
Route::post('/increment-view/{id}', [DetailController::class, 'incrementView']);

// CheckoutController
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/get-delivery-area', [CheckoutController::class, 'getDeliveryArea']);
Route::post('/add-to-address', [CheckoutController::class, 'addToAddress']);
Route::put('/update-addresses/{id}', [CheckoutController::class, 'updateAddresses']);
Route::delete('/delete-address/{id}', [CheckoutController::class, 'deleteAddress']);
Route::get('/payment-status', [VnpayController::class, 'callback']);

// CouponController
Route::get('/coupons', [CouponController::class, 'getListCoupon']);
Route::get('/coupon/{code}', [CouponController::class, 'getCouponDetail']);

// ProductReviewController
Route::post('/reviews', [ProductReviewController::class, 'createReview']);
Route::get('/products/{productId}/reviews', [ProductReviewController::class, 'getReviews']);

// OrderController
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'detailOrder']);
Route::put('/order/{id}', [OrderController::class, 'cancelOrder']);

// Notifications
Route::get('/notifications/{id}', [NotificationController::class, 'getNotificationByInvoiceId']);
Route::put('/notifications/{id}/read', [NotificationController::class, 'readNotification']);
Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification']);

// refunds
Route::post('/refund-request', [RefundController::class, 'createRefundRequest']);

Route::get('/chat/{adminId}', [ChatController::class, 'getMessages']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);

Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart']);
    Route::get('/', [CartController::class, 'viewCart']);
    Route::put('/update/{id}', [CartController::class, 'updateCart']);
    Route::delete('/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::delete('/clear', [CartController::class, 'clearCart']);
});
