<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/Product/{slug}', [ShopController::class, 'productDetails'])->name('shop.product.details');
Route::get('/cart-wishlist-count',[ShopController::class,'getCartAndWishlistCount'])->name('shop.cart.wishlist.count');

Route::get('/cart', [CartController::class ,'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class,'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class,'updateCart'])->name('cart.update');
Route::delete('/cart/remove',[CartController::class,'removeItem'])->name('cart.remove');
Route::delete('/cart/clear',[CartController::class,'clearCart'])->name('cart.clear');

Route::post('/wishlist/add',[WishlistController::class,'addproductToWishlist'])->name('wishlist.store'); 
Route::get('/wishlist',[WishlistController::class,'getWishlistedproducts'])->name('wishlist.list');
Route::delete('/wishlist/remove',[WishlistController::class,'removeproductFromWishlist'])->name('wishlist.remove');
Route::delete('/wishlist/clear',[WishlistController::class,'clrarWishlist'])->name('wishlist.clear');
Route::post('/wishlist/move-to-cart',[WishlistController::class,'moveToCart'])->name('wishlist.move.to.cart');

// Checkout Routes
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/create-payment-intent', [App\Http\Controllers\CheckoutController::class, 'createPaymentIntent'])->name('checkout.create-payment-intent');
Route::get('/checkout/success', [App\Http\Controllers\CheckoutController::class, 'processPayment'])->name('checkout.success');
Route::post('/checkout/place-order', [App\Http\Controllers\CheckoutController::class, 'processPayment'])->name('checkout.place-order');
Route::get('/order/confirmation/{order_id}', [App\Http\Controllers\OrderController::class, 'confirmation'])->name('order.confirmation');


Route::get('/conf',function(){

    return view('confirmation');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');