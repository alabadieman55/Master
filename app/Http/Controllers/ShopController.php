<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Cart;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Pagination parameters
        $page = $request->query("page", 1);
        $size = $request->query("size", 12);

        // Sorting parameters
        $order = $request->query("order", -1);
        $o_column = "id";
        $o_order = "DESC";
        switch ($order) {
            case 1:
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case 2:
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case 3:
                $o_column = "regular_price";
                $o_order = "ASC";
                break;
            case 4:
                $o_column = "regular_price";
                $o_order = "DESC";
                break;
        }

        // Price range filtering - FIXED SECTION
        $prange = $request->query("prange");
        if (!$prange) {
            $prange = "0,500";
        }

        $priceParts = explode(",", $prange);
        $from = max(0, (float)($priceParts[0] ?? 0));  // Ensure minimum 0
        $to = min(500, (float)($priceParts[1] ?? 500)); // Ensure maximum 500

        // Swap values if from > to
        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }

        // Category filtering - SIMPLIFIED
        $q_categories = $request->query("categories", "");
        $categoryIds = $q_categories ? explode(',', $q_categories) : [];

        // Discount filtering
        $q_discounts = $request->query('discount');

        if ($q_discounts) {
            $discountValues = array_filter(
                explode(',', $q_discounts),
                function ($value) {
                    return is_numeric($value) && (float)$value >= 0;
                }
            );
        } else {
            $discountValues = [];
        }


        // Build query
        $products = Product::query()
            ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->whereBetween('regular_price', [$from, $to])
            ->when(!empty($discountValues), function ($query) use ($discountValues) {
                $query->where(function ($q) use ($discountValues) {
                    foreach ($discountValues as $discount) {
                        $discount = (float)$discount; // Parse as float
                        $q->orWhere(function ($subQuery) use ($discount) {
                            $subQuery->whereRaw('(discount / regular_price) * 100 >= ?', [$discount - 1])
                                ->whereRaw('(discount / regular_price) * 100 <= ?', [$discount + 1]);
                        });
                    }
                });
            })


            ->orderBy($o_column, $o_order)
            ->paginate($size);


        // Get categories for filter display
        $Catogories = Category::orderBy("name", "ASC")->get();

        // Get unique discounts for filter display
        $discounts = Product::where('discount', '>', 0)
            ->get()
            ->map(function ($product) {
                return round(($product->discount / $product->regular_price) * 100);
            })
            ->unique()
            ->sort()
            ->values();


        return view('shop', [
            'products' => $products,
            'page' => $page,
            'size' => $size,
            'order' => $order,
            'categories' => $Catogories,
            'q_categories' => $q_categories,
            'q_discounts' => $q_discounts,
            'from' => $from,
            'prange' => $prange,
            'to' => $to,
            'discounts' => $discounts,
            'initial_min' => $from,
            'initial_max' => $to
        ]);
    }


    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $rproducts = Product::where('slug', '!=', $slug)->inRandomOrder()->take(8)->get();
        return view('details', ['product' => $product, 'rproducts' => $rproducts]);
    }

    public function getCartAndWishlistCount()
    {
        $cartCount = Cart::instance('default')->count(); // هذا لو عندك cart عادي
        $wishlistCount = Cart::instance('wishlist')->count(); // هذا هو المطلوب

        return response()->json([
            'status' => 200,
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount,
        ]);
    }
}
