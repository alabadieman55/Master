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
use Stripe\Checkout\Session as StripeCheckoutSession;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return redirect()->route('cart.index')
                    ->with('error', "{$item->product->name} is out of stock!");
            }
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $taxRate = 0.16;
        $tax = $subtotal * $taxRate;
        $total = $subtotal + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'total'));
    }
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
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
            'payment_method' => 'required|in:stripe,cod'
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

            // For COD, process immediately
            if ($validated['payment_method'] === 'cod') {
                $order = $this->createOrder($validated, $cartItems, 'cod', 'pending');
                $this->clearCart($sessionId);

                return redirect()->route('checkout.success')
                    ->with('success', 'Order placed successfully!')
                    ->with('order_id', $order->id);
            }

            // For Stripe, create checkout session
            return $this->createStripeCheckoutSession($validated, $cartItems);
        } catch (\Exception $e) {
            Log::error('Order Error: ' . $e->getMessage());
            return redirect()->route('checkout')
                ->with('error', 'Order failed: ' . $e->getMessage());
        }
    }



    protected function createStripeCheckoutSession($customerData, $cartItems)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $tax = $subtotal * 0.16;
        $total = $subtotal + $tax;

        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->price * 100, // Convert to cents
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Add tax as separate line item
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Tax',
                ],
                'unit_amount' => $tax * 100,
            ],
            'quantity' => 1,
        ];

        // Store order data in session for after payment completion
        Session::put('pending_order', [
            'customer_data' => $customerData,
            'cart_items' => $cartItems,
            'order_data' => [
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]
        ]);

        $checkoutSession = StripeCheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/checkout/stripe/success') . '?session_id={CHECKOUT_SESSION_ID}', // Changed to absolute URL
            'cancel_url' => route('checkout.cancel'),
            'customer_email' => $customerData['email'],
            'metadata' => [
                'customer_name' => $customerData['name'],
                'customer_phone' => $customerData['phone'],
            ],
        ]);

        return redirect($checkoutSession->url);
    }
    protected function buildLineItems($cartItems, $tax)
    {
        $lineItems = [];

        // Add products
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $item->product->name],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Add tax
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => 'Tax'],
                'unit_amount' => $tax * 100,
            ],
            'quantity' => 1,
        ];

        return $lineItems;
    }

    public function handleStripeSuccess(Request $request)
    {

        try {
            $sessionId = $request->query('session_id');
            $pendingOrder = Session::get('pending_order');

            if (!$sessionId || !$pendingOrder) {
                return redirect()->route('checkout')
                    ->with('error', 'Invalid session. Please try again.');
            }

            // Verify payment with Stripe
            Stripe::setApiKey(config('services.stripe.secret'));
            $stripeSession = \Stripe\Checkout\Session::retrieve($sessionId);

            // Double check payment status
            if ($stripeSession->payment_status !== 'paid') {
                throw new \Exception('Payment not completed');
            }

            // Debug: Log pending order data
            Log::info('Pending Order Data:', $pendingOrder);

            // Create the order
            $order = $this->createOrder(
                $pendingOrder['customer_data'],
                $pendingOrder['cart_items'],
                'stripe',
                'paid',
                $sessionId
            );

            // Create order items
            foreach ($pendingOrder['cart_items'] as $item) {
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

            // Clear cart and session
            Cart::where('session_id', Session::getId())->delete();
            Session::forget('pending_order');

            return redirect()->route('checkout.success')
                ->with('success', 'Payment successful!')
                ->with('order_id', $order->id);
        } catch (\Exception $e) {
            Log::error('Stripe Success Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return redirect()->route('checkout')
                ->with('error', 'Order processing failed: ' . $e->getMessage());
        }
    }

    protected function createOrder($customerData, $cartItems, $paymentMethod, $paymentStatus, $transactionId = null)
    {
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
            'name' => $customerData['name'],
            'email' => $customerData['email'],
            'phone' => $customerData['phone'],
            'address' => $customerData['address'],
            'city' => $customerData['city'],
            'state' => $customerData['state'],
            'country' => $customerData['country'],
            'landmark' => $customerData['landmark'] ?? null,
            'zip' => $customerData['zip'],
            'type' => $customerData['type'] ?? 'home',
            'status' => 'ordered',
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'transaction_id' => $transactionId,
        ]);

        foreach ($cartItems as $item) {
            // Decrease product stock
            $product = Product::find($item->product_id);
            if ($product) {
                $product->decrement('quantity', $item->quantity); // Decrease stock
                // Alternatively, you can manually update:
                // $product->stock -= $item->quantity;
                // $product->save();
            }

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

        return $order;
    }

    protected function clearCart($sessionId)
    {
        Cart::where('session_id', $sessionId)->delete();
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
