<?php
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


#API SELLER
Route::get('seller/show',[SellerController::class,'index']);
Route::post('seller/add',[SellerController::class,'store']);
Route::get('seller/show/{id}',[SellerController::class,'show']);
Route::put('seller/update/{id}',[SellerController::class,'update']);
Route::delete('seller/delete/{id}',[SellerController::class,'destroy']);


#API PRODUCT
Route::get('product/show',[ProductController::class,'index']);
Route::post('product/add',[ProductController::class,'store']);
Route::get('product/show/{id}',[ProductController::class,'show']);
Route::put('product/update/{id}',[ProductController::class,'update']);
Route::delete('product/delete/{id}',[ProductController::class,'destroy']);

#API TRANSACTIONS
Route::get('transaction/show',[TransactionController::class,'index']);
Route::post('transaction/add',[TransactionController::class,'store']);
Route::get('transaction/show/{id}',[TransactionController::class,'show']);
Route::put('transaction/update/{id}',[TransactionController::class,'update']);
Route::delete('transaction/delete/{id}',[TransactionController::class,'destroy']);

#API ORDER
Route::get('order/show',[OrderController::class,'index']);
Route::post('order/add',[OrderController::class,'store']);
Route::get('order/show/{id}',[OrderController::class,'show']);
Route::put('order/update/{id}',[OrderController::class,'update']);
Route::delete('order/delete/{id}',[OrderController::class,'destroy']);

#API DELIVERY
Route::get('delivery/show',[DeliveryController::class,'index']);
Route::post('delivery/add',[DeliveryController::class,'store']);
Route::get('delivery/show/{id}',[DeliveryController::class,'show']);
Route::put('delivery/update/{id}',[DeliveryController::class,'update']);
Route::delete('delivery/delete/{id}',[DeliveryController::class,'destroy']);

#API PAYMENT
Route::get('payment/show',[PaymentController::class,'index']);
Route::post('payment/add',[PaymentController::class,'store']);
Route::get('payment/show/{id}',[PaymentController::class,'show']);
Route::put('payment/update/{id}',[PaymentController::class,'update']);
Route::delete('payment/delete/{id}',[PaymentController::class,'destroy']);


//ROUTING SEDERHANA
// route::resource('/seller', SellerController::class)->except(['create','edit']);
// route::resource('/transactions', TransactionController::class)->except(['create','edit']);
// route::resource('/products', ProductController::class)->except(['create','edit']);
// route::resource('/delivery', DeliveryController::class)->except(['create','edit']);
// route::resource('/payment', PaymentController::class)->except(['create','edit']);
// route::resource('/orders', OrderController::class)->except(['create','edit']);