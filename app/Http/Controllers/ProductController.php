<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        // Smart search — splits words and searches each
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $words = array_filter(explode(' ', $searchTerm));

            $query->where(function($q) use ($words, $searchTerm) {
                // Full phrase match first
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');

                // Each individual word match
                foreach ($words as $word) {
                    if (strlen($word) >= 2) {
                        $q->orWhere('name', 'like', '%' . $word . '%')
                          ->orWhere('description', 'like', '%' . $word . '%');
                    }
                }
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->get();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $path = $request->file('image')->store('products', 'public');
        $product->update(['image' => $path]);

        return redirect()->route('products.index')
            ->with('success', 'Image uploaded successfully!');
    }
}