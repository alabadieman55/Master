<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use App\Models\Order; // Assuming you have an Order model
use App\Models\OrderItem; // Assuming you have an OrderItem model
use Illuminate\Support\Facades\Session;
use Cart;


class CheckoutController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::instance('cart')->content();

        // Display the checkout page
        return view('checkout', ['cartItems' => $cartItems]);
    }

    public function createPaymentIntent(Request $request)
    {
        // Validate all required fields
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            // Add more validation as needed
        ]);

        try {
            // Set your Stripe secret key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Get the cart total amount (in cents for Stripe)
            $amount = $this->getCartTotal() * 100; // Assuming getCartTotal() returns amount in dollars

            // Create a PaymentIntent with the order amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'customer_name' => $request->name,
                    'customer_email' => $request->email ?? '',
                    // Add more metadata as needed
                ],
            ]);

            // Store shipping and billing info in session
            $this->storeAddressInfo($request);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function processPayment(Request $request)
    {
        // This method is called after payment is confirmed
        try {
            // Create new order in database
            $order = new Order();
            $order->user_id = auth()->id() ?? null; // If user is logged in
            $order->total_amount = $this->getCartTotal();
            $order->payment_method = 'stripe';
            $order->payment_status = 'paid';

            // Add billing address data
            $order->billing_name = $request->session()->get('billing.name');
            $order->billing_address = $request->session()->get('billing.address');
            $order->billing_city = $request->session()->get('billing.city');
            $order->billing_state = $request->session()->get('billing.state');
            $order->billing_zip = $request->session()->get('billing.zip');
            $order->billing_phone = $request->session()->get('billing.phone');

            // Add shipping address data if different
            if (!$request->session()->get('same_as_billing')) {
                $order->shipping_name = $request->session()->get('shipping.name');
                $order->shipping_address = $request->session()->get('shipping.address');
                $order->shipping_city = $request->session()->get('shipping.city');
                $order->shipping_state = $request->session()->get('shipping.state');
                $order->shipping_zip = $request->session()->get('shipping.zip');
                $order->shipping_phone = $request->session()->get('shipping.phone');
            } else {
                // Copy billing to shipping
                $order->shipping_name = $order->billing_name;
                $order->shipping_address = $order->billing_address;
                $order->shipping_city = $order->billing_city;
                $order->shipping_state = $order->billing_state;
                $order->shipping_zip = $order->billing_zip;
                $order->shipping_phone = $order->billing_phone;
            }

            $order->save();

            // Save order items
            $cartItems = $this->getCartItems(); // Implement this method to get cart items
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->id;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $item->price;
                $orderItem->save();
            }

            // Clear the cart
            $this->clearCart();

            return redirect()->route('order.confirmation', ['order_id' => $order->id])
                ->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing order: ' . $e->getMessage());
        }
    }

    private function getCartTotal()
    {
        // Implement this method based on your cart implementation
        // Example: return Cart::total();
        // For demonstration, let's return a sample amount
        return 100.00; // $100
    }

    private function getCartItems()
    {
        // Implement this method based on your cart implementation
        // Example: return Cart::content();
        return []; // Return empty array for now
    }

    private function clearCart()
    {
        // Implement this method to clear the cart
        // Example: Cart::destroy();
    }

    private function storeAddressInfo(Request $request)
    {
        // Store billing address
        session([
            'billing.name' => $request->name,
            'billing.phone' => $request->phone,
            'billing.address' => $request->address,
            'billing.locality' => $request->locality,
            'billing.landmark' => $request->landmark,
            'billing.city' => $request->city,
            'billing.state' => $request->state,
            'billing.zip' => $request->zip,
            'billing.country' => $request->country,
        ]);

        // Check if shipping is same as billing
        $sameAsBilling = $request->has('sameAsBilling');
        session(['same_as_billing' => $sameAsBilling]);

        // Store shipping address if different
        if (!$sameAsBilling) {
            session([
                'shipping.name' => $request->s_name,
                'shipping.phone' => $request->s_phone,
                'shipping.address' => $request->s_address,
                'shipping.locality' => $request->s_locality,
                'shipping.landmark' => $request->s_landmark,
                'shipping.city' => $request->s_city,
                'shipping.state' => $request->s_state,
                'shipping.zip' => $request->s_zip,
                'shipping.country' => $request->s_country,
            ]);
        }
    }
}
