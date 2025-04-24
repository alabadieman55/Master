<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class WishlistController extends Controller
{
    /**
     * Display a listing of wishlist items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    /**
     * Toggle product in wishlist (add or remove).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $userId = Auth::id();

        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlistItem) {
            // Item exists in wishlist, remove it
            $wishlistItem->delete();

            return response()->json([
                'status' => 'removed',
                'message' => 'Product removed from wishlist'
            ]);
        } else {
            // Item does not exist in wishlist, add it
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);

            return response()->json([
                'status' => 'added',
                'message' => 'Product added to wishlist'
            ]);
        }
    }

    /**
     * Check if a product is in the user's wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $userId = Auth::id();

        $inWishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        return response()->json([
            'in_wishlist' => $inWishlist
        ]);
    }

    /**
     * Get the count of items in the wishlist.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        $count = Wishlist::where('user_id', Auth::id())->count();

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Remove an item from the wishlist.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function remove($productId)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist');
    }

    /**
     * Move an item from wishlist to cart.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function moveToCart(Request $request, $productId)
    {
        // Get the product
        $product = Product::findOrFail($productId);

        // Add to cart logic here
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::findOrFail($request->product_id);
            $userId = Auth::check() ? Auth::id() : null;

            // Ensure session is started
            if (!Session::isStarted()) {
                Session::start();
            }
            $sessionId = Session::getId();

            // Check if product already in cart
            $cartItem = Cart::where('session_id', $sessionId)
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                // Update quantity
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // Add new to cart
                $cartItem = Cart::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->regular_price, // Changed from price to regular_price
                    'quantity' => $request->quantity,
                    'image' => $product->image,
                ]);
            }

            $cartCount = Cart::where('session_id', $sessionId)->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'cartCount' => $cartCount,
                'cartItem' => $cartItem
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding to cart: ' . $e->getMessage()
            ], 500);
        }

        // For demonstration purposes:
        // CartController::addToCart($product);

        // Remove from wishlist
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Product moved to cart');
    }
}
