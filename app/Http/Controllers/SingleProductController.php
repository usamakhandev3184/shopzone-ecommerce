<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Wishlist;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class SingleProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->latest()
            ->get();

        $inCart     = false;
        $inWishlist = false;
        $userReview = null;

        if (Auth::check()) {
            $inCart = CartItem::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();

            $inWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();

            $userReview = Review::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();
        }

        return view('products.show', compact(
            'product', 'relatedProducts', 'reviews',
            'inCart', 'inWishlist', 'userReview'
        ));
    }
}