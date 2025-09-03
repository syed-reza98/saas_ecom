<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CarouselController;
use App\Http\Controllers\Api\CarouselController1;
use App\Http\Controllers\SslCommerzPaymentController;

use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();
    $user->load('customer'); // Eager load the related Customer model

    return $user;
});


Route::get('/products', [ProductController::class, 'index']);
Route::post('/createProduct', [ProductController::class, 'createProduct']);

Route::post('/productByFilter', [ProductController::class, 'productByFilter']);

Route::post('/productByFilter/{id}', [ProductController::class, 'productByFilter']);

Route::get('/featureProducts', [ProductController::class, 'featureProducts']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/Categories', [CategoryController::class, 'index']);

Route::get('/categoryNav/{id}', [CategoryController::class, 'categoryNav']);

Route::get('/categoryNav', [CategoryController::class, 'categoryNav']);

Route::get('/gift', [CarouselController1::class, 'gift']);


Route::get('/ordersall', [OrderController::class, 'index']);

Route::post('/orders', [OrderController::class, 'store']);

Route::get('/carousels', [CarouselController::class, 'index']);

Route::get('/carousels1', [CarouselController1::class, 'index']);

Route::get('/orders/{id}', [OrderController::class, 'showNew'])->name('orders.showNew');

Route::get('/payment', [OrderController::class, 'payment'])->name('orders.payment');


Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
