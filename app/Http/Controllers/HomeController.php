<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->where('status', true)
            ->with('children')
            ->get();

        $featuredProducts = Product::where('status', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $latestProducts = Product::where('status', true)
            ->latest()
            ->take(12)
            ->get();

        return view('welcome', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
