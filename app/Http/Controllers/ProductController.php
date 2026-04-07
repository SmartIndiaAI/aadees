<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 1);

        // Filter by Category
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by Attributes (Color/Size)
        if ($request->has('color') && $request->color != '') {
            $query->whereHas('attributeValues', function($q) use ($request) {
                $q->where('value', $request->color);
            });
        }

        if ($request->has('size') && $request->size != '') {
            $query->whereHas('attributeValues', function($q) use ($request) {
                $q->where('value', $request->size);
            });
        }

        // Filter by Price Range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(12);
        
        // Data for filters
        $categories = \App\Models\Category::whereNull('parent_id')->get();
        $colors = \App\Models\ProductAttributeValue::whereHas('attribute', function($q){
            $q->where('name', 'Color');
        })->distinct()->pluck('value');
        $sizes = \App\Models\ProductAttributeValue::whereHas('attribute', function($q){
            $q->where('name', 'Size');
        })->distinct()->pluck('value');

        return view('customer.product.index', compact('products', 'categories', 'colors', 'sizes'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', true)
            ->with(['category', 'vendor', 'attributeValues.attribute'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->take(4)
            ->get();

        return view('customer.product.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('status', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(12);

        return view('customer.product.search', compact('products', 'query'));
    }
}
