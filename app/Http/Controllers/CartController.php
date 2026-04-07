<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the premium basket view.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        
        return view('customer.cart.index', compact('cart', 'total'));
    }

    /**
     * Masterfully add an item to the basket with selected attributes.
     */
    public function add(Request $request, $productId)
    {
        $product = Product::with(['vendor', 'category'])->findOrFail($productId);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);
        $attributes = $request->input('attribute', []);

        // Unique key for different variants of the same product
        $cartKey = $productId;
        if (!empty($attributes)) {
            $cartKey .= '_' . md5(json_encode($attributes));
        }

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                "id" => $product->id,
                "cart_key" => $cartKey,
                "name" => $product->name,
                "slug" => $product->slug,
                "quantity" => $quantity,
                "price" => $product->discount_price > 0 ? $product->discount_price : $product->price,
                "image" => $product->image_url,
                "vendor_id" => $product->vendor_id,
                "vendor_name" => $product->vendor->name ?? 'Artisan Partner',
                "category_name" => $product->category->name ?? 'Premium Item',
                "attributes" => $attributes,
                "shipping_charge" => 0
            ];
        }

        session()->put('cart', $cart);
        
        if ($request->input('buy_now') == 1) {
            return redirect()->route('checkout');
        }

        return back()->with('status', 'Masterfully added to your basket.');
    }

    /**
     * Effortlessly adjust basket quantities.
     */
    public function updateQuantity(Request $request, $cartKey)
    {
        $cart = session()->get('cart', []);
        $action = $request->input('action');

        if (isset($cart[$cartKey])) {
            if ($action === 'increment') {
                $cart[$cartKey]['quantity']++;
            } elseif ($action === 'decrement' && $cart[$cartKey]['quantity'] > 1) {
                $cart[$cartKey]['quantity']--;
            }
            session()->put('cart', $cart);
        }

        return back()->with('status', 'Basket successfully adjusted.');
    }

    /**
     * Gracefully remove an item.
     */
    public function remove($cartKey)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
            session()->put('cart', $cart);
        }
        return back()->with('status', 'Item gracefully removed.');
    }
}
