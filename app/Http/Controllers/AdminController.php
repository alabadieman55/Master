<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::count();
        $categories = Category::count();
        $orders = Order::count();
        $users = User::where('Utype', '!=', 'ADM')->count();
        $revenue = Order::where('payment_status', 'paid')->sum('total');
        $ordersMain = Order::take(5)->orderBy('created_at', 'desc')->get();
        $topSellingProducts = OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
            ->with('product') // eager load the product relationship
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5) // get top 5
            ->get();
        return view('admin.index', compact('products', 'categories', 'orders', 'users', 'revenue', 'ordersMain', 'topSellingProducts'));
    }
}
