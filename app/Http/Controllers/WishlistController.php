<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            $product = Product::findOrFail($request->product_id);
            $userId = Auth::check() ? Auth::id() : null;

            // Ensure session is started
            if (!Session::isStarted()) {
                Session::start();
            }
            $sessionId = Session::getId();

            // Check if product already in wishlist
            $wishlistItem = Wishlist::where('session_id', $sessionId)
                ->where('product_id', $product->id)
                ->first();

            if ($wishlistItem) {
                // Item already exists in wishlist, you could either return a message or remove it (toggle functionality)
                // For now, let's just return that it's already in wishlist
                return response()->json([
                    'success' => true,
                    'message' => 'Product already in wishlist',
                    'wishlistCount' => Wishlist::where('session_id', $sessionId)->count(),
                    'exists' => true
                ]);
            } else {
                // Add new to wishlist
                $wishlistItem = Wishlist::create([
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->regular_price,
                    'image' => $product->image,
                ]);
            }

            $wishlistCount = Wishlist::where('session_id', $sessionId)->count();

            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist successfully',
                'wishlistCount' => $wishlistCount,
                'wishlistItem' => $wishlistItem
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding to wishlist: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showWishlist()
    {
        $sessionId = Session::getId();
        $wishlistItems = Wishlist::where('session_id', $sessionId)->get();

        return view('wishlist', compact('wishlistItems'));
    }

    public function removeFromWishlist($id)
    {
        $wishlistItem = Wishlist::findOrFail($id);
        $wishlistItem->delete();

        $sessionId = Session::getId();
        $wishlistCount = Wishlist::where('session_id', $sessionId)->count();

        return response()->json([
            'success' => true,
            'wishlistCount' => $wishlistCount,
        ]);
    }

    public function moveToCart($id)
    {
        $wishlistItem = Wishlist::findOrFail($id);

        // Add to cart using CartController's addToCart logic
        $cartController = new CartController();
        $request = new Request([
            'product_id' => $wishlistItem->product_id,
            'quantity' => 1,
        ]);

        $response = $cartController->addToCart($request);

        // Remove from wishlist
        $wishlistItem->delete();

        $sessionId = Session::getId();
        $wishlistCount = Wishlist::where('session_id', $sessionId)->count();

        return response()->json([
            'success' => true,
            'wishlistCount' => $wishlistCount,
            'cartData' => json_decode($response->getContent()),
        ]);
    }

    public function clearWishlist()
    {
        // Get the current session ID
        $sessionId = Session::getId();

        // Delete all wishlist items associated with this session
        Wishlist::where('session_id', $sessionId)->delete();

        // Redirect back with a success message
        return redirect()->route('wishlist.index')->with('success', 'Your wishlist has been cleared successfully.');
    }
}
