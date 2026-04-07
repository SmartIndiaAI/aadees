<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['vendor', 'category']);

        if ($request->has('vendor_id') && $request->vendor_id != '') {
            $query->where('vendor_id', $request->vendor_id);
        }

        $products = $query->latest()->paginate(20);
        $vendors = \App\Models\Vendor::all();

        return view('admin.products.index', compact('products', 'vendors'));
    }

    public function edit($id)
    {
        $product = Product::with(['vendor', 'category'])->findOrFail($id);
        $categories = \App\Models\Category::all();
        $vendors = \App\Models\Vendor::all();
        
        return view('admin.products.edit', compact('product', 'categories', 'vendors'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'vendor_id' => 'required|exists:vendors,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Masterpiece effectively updated.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back()->with('success', 'Masterpiece removed from archive.');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => $product->status === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'Marketplace Masterpiece status toggled.');
    }
}
