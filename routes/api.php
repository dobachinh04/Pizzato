<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\MenuController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\CheckoutController;

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
// });

// IndexController
Route::get('/menu', [IndexController::class, 'getMenuPizza']);
Route::get('/hot-product', [IndexController::class, 'getHotProduct']);

// MenuController
Route::get('/menus', [MenuController::class, 'getMenuPizza']);

// DetailController
Route::get('/detail/{id}', [DetailController::class, 'getDetailPizza']);
Route::get('/similar-pizza/{id}', [DetailController::class, 'getSimilarPizzas']);

// Payment
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
