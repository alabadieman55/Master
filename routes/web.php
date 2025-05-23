<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use App\Http\Controllers\AnalyticsController;


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

Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->middleware('auth');
Route::put('/cart/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/move-to-cart', [CartController::class, 'moveToCart'])->name('moveToCart');
Route::get('/checkout/success', [CartController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout/cancel', [CartController::class, 'checkoutCancel'])->name('checkout.cancel');
// Stripe routes
Route::post('/checkout/stripe', [StripeController::class, 'createStripeSession'])->name('checkout.stripe');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::get('/checkout/stripe/success', [CheckoutController::class, 'handleStripeSuccess'])
    ->name('checkout.stripe.success');
Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name('stripe.checkout');
Route::post('/checkout/create-payment-intent', [StripeController::class, 'createPaymentIntent'])->name('checkout.create-payment-intent');
// wrong function call



// // Existing routes
// Route::get('/stripe/{id}', [StripeController::class, 'stripe'])->name('stripe');
// Route::post('/stripe/post', [StripeController::class, 'stripePost'])->name('stripe.post');


// If you want it to be auth-only

// Wishlist routes
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add')->middleware('auth');
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.index');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::post('/wishlist/move-to-cart/{id}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
Route::get('/wishlist/clear', [WishlistController::class, 'clearWishlist'])->name('wishlist.clear');

// Checkout Routes
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/stripe', [CartController::class, 'createStripeSession'])->name('checkout.stripe');
Route::get('/checkout/success', [CartController::class, 'checkoutSuccess'])->name('checkout.success');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
Route::get('/order/confirmation/{order_id}', [App\Http\Controllers\OrderController::class, 'confirmation'])->name('order.confirmation');


Route::get('/conf', function () {

    return view('confirmation');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);

    // Delete product image
    Route::delete('products/{product}/images', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    Route::resource('categories', CategoryController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
});


//rating
Route::post('/product/rating', [RatingController::class, 'store'])->name('product.rating.store')->middleware('auth');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/aboutus', function () {
    return view('aboutus');
});
Route::get('/contactus', [ContactusController::class, 'showForm'])->name('contact');
Route::post('/contactus', [ContactusController::class, 'submitForm'])->name('contact.submit');

Route::get('/admin/contacts/{contact}', [ContactUsController::class, 'show'])
    ->name('admin.contact.show');

//LiveSearch
Route::get('/search/live', function (Request $request) {
    $query = $request->input('q');

    $results = \App\Models\Product::where('name', 'like', '%' . $query . '%')
        ->orWhere('description', 'like', '%' . $query . '%')
        ->take(8)
        ->get()
        ->map(function ($product) {
            return [
                'name' => $product->name,
                'url' => route('shop.product.details', $product->id),
                'image' => $product->image_url, // Make sure you have this accessor
                'price' => '$' . number_format($product->price, 2)
            ];
        });

    return response()->json($results);
})->name('search.live');

//analytics
// routes/web.php (or api.php if you prefer API routes)
Route::middleware(['auth'])->group(function () {
    Route::get('/analytics/revenue', [AnalyticsController::class, 'revenueAnalytics']);
});
