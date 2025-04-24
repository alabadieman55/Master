<?php

namespace App\Http\Controllers;

use App\Models\PricingPackage;
use App\Models\Reservation;
use App\Models\TrainingSession;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripe($id) {}

    public function stripePost(Request $request) {}

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
                    'unit_amount' => intval($item->regular_price * 1000), // Stripe expects price in cents

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
