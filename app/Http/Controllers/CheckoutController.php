<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $taxRate = 0.16;
        $tax = $subtotal * $taxRate;
        $total = $subtotal + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    public function createPaymentIntent(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
        ]);

        try {
            $sessionId = Session::getId();
            $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();

            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $taxRate = 0.16;
            $tax = $subtotal * $taxRate;
            $total = $subtotal + $tax;
            $amountInCents = round($total * 100);

            Stripe::setApiKey(config('services.stripe.secret'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $amountInCents,
                'currency' => 'jod',
                'metadata' => [
                    'customer_name' => $request->name,
                    'customer_email' => $request->email,
                    'customer_phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'country' => $request->country,
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'total' => $total,
                'order_data' => $request->all()
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Payment Intent Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function processStripePayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'landmark' => 'nullable|string',
            'type' => 'nullable|string|in:home,office',
        ]);

        try {
            $sessionId = Session::getId();
            $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $tax = $subtotal * 0.16;
            $total = $subtotal + $tax;

            Stripe::setApiKey(config('services.stripe.secret'));
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);

            if ($paymentIntent->status !== 'succeeded') {
                throw new \Exception('Payment not completed');
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'landmark' => $request->landmark,
                'zip' => $request->zip,
                'type' => $request->type ?? 'home',
                'status' => 'ordered',
                'payment_method' => 'stripe',
                'payment_status' => 'paid',
                'transaction_id' => $paymentIntent->id,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'options' => [
                        'name' => $item->name,
                        'image' => $item->image
                    ]
                ]);
            }

            Cart::where('session_id', $sessionId)->delete();

            return redirect()->route('checkout.success')
                ->with('success', 'Payment successful!')
                ->with('order_id', $order->id);
        } catch (\Exception $e) {
            Log::error('Stripe Payment Processing Error: ' . $e->getMessage());
            return redirect()->route('checkout.index')
                ->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'landmark' => 'nullable|string',
            'type' => 'nullable|string|in:home,office',
        ]);

        try {
            $sessionId = Session::getId();
            $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty');
            }

            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $tax = $subtotal * 0.16;
            $total = $subtotal + $tax;

            $order = Order::create([
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'landmark' => $request->landmark,
                'zip' => $request->zip,
                'type' => $request->type ?? 'home',
                'status' => 'ordered',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'options' => [
                        'name' => $item->name,
                        'image' => $item->image
                    ]
                ]);
            }

            Cart::where('session_id', $sessionId)->delete();

            return redirect()->route('checkout.success')
                ->with('success', 'Order placed successfully!')
                ->with('order_id', $order->id);
        } catch (\Exception $e) {
            Log::error('COD Order Error: ' . $e->getMessage());
            return redirect()->route('checkout')
                ->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        if (!session()->has('success')) {
            return redirect()->route('home');
        }

        $orderId = session('order_id');
        $order = Order::with('items.product')->find($orderId);

        return view('checkout.success', compact('order'));
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
