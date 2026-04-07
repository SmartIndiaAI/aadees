<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('vendor_id', Auth::guard('vendor')->id())
            ->with(['category'])
            ->latest()
            ->paginate(10);
        return view('vendor.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('vendor.product.create', compact('categories', 'attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $product = new Product();
        $product->vendor_id = Auth::guard('vendor')->id();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name) . '-' . time();
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->sku = $request->sku;
        $product->stock = $request->stock;
        $product->description = $request->description;

        // Handle Thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $product->thumbnail = 'storage/' . $path;
        }

        // Handle Gallery
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('products/gallery', 'public');
                $galleryPaths[] = 'storage/' . $path;
            }
        }
        $product->gallery = $galleryPaths;
        $product->status = 1;
        $product->save();

        // Handle Attributes
        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $attrId => $values) {
                if (empty($values)) continue;
                $vals = explode(',', $values);
                foreach ($vals as $v) {
                    ProductAttributeValue::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attrId,
                        'value' => trim($v)
                    ]);
                }
            }
        }

        return redirect()->route('vendor.products.index')->with('success', 'Product listed successfully.');
    }

    public function edit(Product $product)
    {
        if ($product->vendor_id !== Auth::guard('vendor')->id()) abort(403);
        
        $categories = Category::all();
        $attributes = Attribute::with(['productAttributeValues' => function($q) use ($product) {
            $q->where('product_id', $product->id);
        }])->get();
        
        return view('vendor.product.edit', compact('product', 'categories', 'attributes'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->vendor_id !== Auth::guard('vendor')->id()) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->sku = $request->sku;
        $product->stock = $request->stock;
        $product->description = $request->description;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $product->thumbnail = 'storage/' . $path;
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = $product->gallery ?? [];
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('products/gallery', 'public');
                $galleryPaths[] = 'storage/' . $path;
            }
            $product->gallery = $galleryPaths;
        }

        $product->save();

        // Update Attributes (Simple override for now)
        if ($request->has('attributes')) {
            $product->attributeValues()->delete();
            foreach ($request->input('attributes') as $attrId => $values) {
                if (empty($values)) continue;
                $vals = explode(',', $values);
                foreach ($vals as $v) {
                    ProductAttributeValue::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attrId,
                        'value' => trim($v)
                    ]);
                }
            }
        }

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->vendor_id !== Auth::guard('vendor')->id()) abort(403);
        $product->delete();
        return back()->with('success', 'Product removed.');
    }
}
