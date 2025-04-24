<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the order
     */
    public function edit(Order $order)
    {
        $statuses = [
            'ordered' => 'Ordered',
            'delivered' => 'Delivered',
            'canceled' => 'Canceled'
        ];

        $paymentStatuses = [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'failed' => 'Failed'
        ];

        return view('orders.edit', compact('order', 'statuses', 'paymentStatuses'));
    }

    /**
     * Update the specified order
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:ordered,delivered,canceled',
            'payment_status' => 'required|in:pending,paid,failed',
            'delivered_date' => 'nullable|date',
            'canceled_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ]);

        // Update dates based on status
        if ($validated['status'] === 'delivered' && $order->status !== 'delivered') {
            $validated['delivered_date'] = now();
        }

        if ($validated['status'] === 'canceled' && $order->status !== 'canceled') {
            $validated['canceled_date'] = now();
        }

        $order->update($validated);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified order
     */
    public function destroy(Order $order)
    {
        // Delete order items first
        $order->items()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully');
    }
}
