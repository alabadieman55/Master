<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000'
        ]);

        $rating = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $request->product_id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        $averageRating = Rating::where('product_id', $request->product_id)
            ->avg('rating');

        return response()->json([
            'success' => true,
            'averageRating' => number_format($averageRating, 1)
        ]);
    }
}
