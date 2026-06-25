<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('products')->get();

        $productCount  = Product::count();
        $categoryCount = Category::count();

        return view('home', compact(
            'featuredProducts', 'categories',
            'productCount', 'categoryCount'
        ));
    }
}