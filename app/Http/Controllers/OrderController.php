<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function confirmation($order_id)
    {
        $order = Order::with('items.product')->findOrFail($order_id);
        
        // Check if the order belongs to the current user if user is logged in
        if (auth()->check() && $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('order.confirmation', [
            'order' => $order
        ]);
    }
}