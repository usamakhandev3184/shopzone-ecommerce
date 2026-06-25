<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if already reviewed
        $existing = Review::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            // Update existing review
            $existing->update([
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = 'Your review has been updated!';
        } else {
            Review::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'rating'     => $request->rating,
                'comment'    => $request->comment,
            ]);
            $message = 'Review submitted successfully!';
        }

        return back()->with('success', $message);
    }

    /**
     * Delete a review.
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}