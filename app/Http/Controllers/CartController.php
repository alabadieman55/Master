<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Stripe\Stripe;




class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart', ['cartItems' => $cartItems]);
    }


    public function indexCheckout()
    {

        $cartItems = Cart::instance('cart')->content();
        return view('checkout', ['cartItems' => $cartItems]);
    }



    public function addToCart(Request $request)
    {
        $Product = Product::find($request->id);
        $price = $Product->sale_price ? $Product->sale_price : $Product->regular_price;
        Cart::instance('cart')->add($Product->id, $Product->name, $request->quantity, $price)->associate('App\Models\Product');

        return redirect()->back()->with('message', 'Success! Item has been added successfully!');
    }


    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId, $request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }

    public function moveToCart(Request $request)
{
    $productId = $request->product_id;
    $rowId = $request->rowId;

    // Find the item in wishlist
    $item = Cart::instance('wishlist')->get($rowId);
    
    if ($item && $item->id == $productId) {
        // Remove from wishlist
        Cart::instance('wishlist')->remove($rowId);
        
        // Add to cart
        $product = Product::find($productId);
        if ($product) {
            $price = $product->sale_price ? $product->sale_price : $product->regular_price;
            Cart::instance('cart')->add($product->id, $product->name, 1, $price)
                                 ->associate('App\Models\Product');
        }
    }

    return redirect()->route('wishlist.list')->with('message', 'Item moved to cart successfully!');
}
public function createStripeSession(Request $request)
{
    dd("asd");
    $sessionId = Session::getId();
    $cartItems = Cart::where('session_id', $sessionId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.show')->with('error', 'Your cart is empty');
    }


    Stripe::setApiKey(config('services.stripe.secret'));

    $lineItems = [];


    foreach ($cartItems as $item) {
        $imageUrl = $item->image ? asset('storage/products/' . $item->image) : asset('images/default-product.png');



        $lineItems[] = [
            'price_data' => [
                'currency' => 'jod',
                'product_data' => [
                    'name' => $item->name,
                    'images' => [$item->image],

                ],
                'unit_amount' => intval($item->price * 1000), // Stripe expects price in cents

            ],
            'quantity' => $item->quantity,

        ];
    }

    // Create Stripe Checkout Session
    $stripeSession = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('checkout.cancel'),
    ]);

    Session::put('stripe_session_id', $stripeSession->id);

    return redirect($stripeSession->url);
}
    

}
