<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('products')->count();
        $pendingOrders = auth()->user()->orders()->where('payment_status', 'pending')->count();
        $wishlists = auth()->user()->wishlists()->with('products')->count();
        $ordersData = auth()->user()->orders()->with(['items.product'])->get();
        $wishlistsData = auth()->user()->wishlists()->get();
        return view('users.index', compact('orders', 'pendingOrders', 'wishlists', 'ordersData', 'wishlistsData'));
    }
}
