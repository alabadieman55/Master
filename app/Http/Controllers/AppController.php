<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {

        $categories = Category::all();
        $productsDiscount = Product::where('discount', '>', 0)->get();
        return view('index', compact('categories', 'productsDiscount'));
    }
}
