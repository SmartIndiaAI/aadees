<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', true)
            ->with(['children', 'parent'])
            ->firstOrFail();

        // Helper for recursive category IDs
        $getCategoryIds = function($cat) use (&$getCategoryIds) {
            $ids = [$cat->id];
            foreach ($cat->children as $child) {
                $ids = array_merge($ids, $getCategoryIds($child));
            }
            return $ids;
        };
        
        $categoryIds = $getCategoryIds($category);

        $products_all = Product::whereIn('category_id', $categoryIds)
            ->where('status', true)
            ->with(['attributeValues.attribute'])
            ->get();

        $availableColors = [];
        $availableSizes = [];

        foreach($products_all as $p) {
            foreach($p->attributeValues as $av) {
                if ($av->attribute) {
                    $attrName = strtolower($av->attribute->name);
                    if (str_contains($attrName, 'color')) {
                        $availableColors[] = $av->value;
                    }
                    if (str_contains($attrName, 'size')) {
                        $availableSizes[] = $av->value;
                    }
                }
            }
        }

        $availableColors = array_unique($availableColors);
        $availableSizes = array_unique($availableSizes);

        $productsQuery = Product::whereIn('category_id', $categoryIds)
            ->where('status', true);

        // Filter by Colors
        if ($colors = request('colors')) {
            $productsQuery->whereHas('attributeValues', function($q) use ($colors) {
                $q->whereIn('value', $colors);
            });
        }

        // Filter by Sizes
        if ($sizes = request('sizes')) {
            $productsQuery->whereHas('attributeValues', function($q) use ($sizes) {
                $q->whereIn('value', $sizes);
            });
        }

        // Filter by Price
        if (request()->filled('min_price')) {
            $productsQuery->where('price', '>=', request('min_price'));
        }
        if (request()->filled('max_price')) {
            $productsQuery->where('price', '<=', request('max_price'));
        }

        // Sort Logic
        $sort = request('sort', 'latest');
        if ($sort == 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($sort == 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        } else {
            $productsQuery->latest();
        }

        $products = $productsQuery->paginate(12);

        return view('customer.category.show', compact('category', 'products', 'availableColors', 'availableSizes'));
    }
}
