<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Show wishlist page.
     */
    public function index()
    {
        $wishlistItems = Wishlist::with('product.category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Toggle wishlist — add if not exists, remove if exists.
     */
    public function toggle(Product $product)
    {
        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = '"' . $product->name . '" removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
            ]);
            $message = '"' . $product->name . '" added to wishlist!';
        }

        // Go back to where user was (product detail or products page)
        return back()->with('success', $message);
    }

    /**
     * Remove from wishlist.
     */
    public function remove(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return redirect()->route('wishlist.index')
            ->with('success', 'Item removed from wishlist.');
    }
}