<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;

class CartController extends Controller
{


    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::findOrFail($request->product_id);
            $userId = Auth::check() ? Auth::id() : null;

            // Ensure session is started
            if (!Session::isStarted()) {
                Session::start();
            }
            $sessionId = Session::getId();

            // Check if product already in cart
            $cartItem = Cart::where('session_id', $sessionId)
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                // Update quantity
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // Add new to cart
                $cartItem = Cart::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->regular_price, // Changed from price to regular_price
                    'quantity' => $request->quantity,
                    'image' => $product->image,
                ]);
            }

            $cartCount = Cart::where('session_id', $sessionId)->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'cartCount' => $cartCount,
                'cartItem' => $cartItem
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding to cart: ' . $e->getMessage()
            ], 500);
        }
    }



    public function showCart()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::where('session_id', $sessionId)->get();

        $cartTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'cartTotal'));
    }



    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $sessionId = Session::getId();
        $cartCount = Cart::where('session_id', $sessionId)->sum('quantity');

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
        ]);
    }


    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        $sessionId = Session::getId();
        $cartCount = Cart::where('session_id', $sessionId)->sum('quantity');

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
        ]);
    }

    public function clearCart()
    {
        // Get the current session ID
        $sessionId = Session::getId();

        // Delete all cart items associated with this session
        Cart::where('session_id', $sessionId)->delete();

        // Redirect back with a success message
        return redirect()->route('cart.index')->with('success', 'Your cart has been cleared successfully.');
    }



    public function checkout()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::where('session_id', $sessionId)->get();
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        return view('checkout', compact('cartItems', 'cartTotal'));
    }


    public function createStripeSession(Request $request)
    {

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
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->name,
                        'images' => [$item->image],

                    ],
                    'unit_amount' => intval($item->price * 100), // Stripe expects price in cents

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




    public function checkoutSuccess(Request $request)
    {
        // Verify stripe session here if needed

        // Clear the cart
        $sessionId = Session::getId();
        Cart::where('session_id', $sessionId)->delete();

        return view('checkout.success', compact('sessionId'));
    }




    public function checkoutCancel()
    {
        return view('cart.cancel');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
