<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the wishlist items for the authenticated user.
     */
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->get();

        return view('customer.wishlist', compact('wishlistItems'));
    }

    /**
     * Add or remove a product from the wishlist.
     */
    public function toggle($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please login to save favorites.');
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'Removed from wishlist.';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
            $message = 'Added to wishlist.';
        }

        return back()->with('status', $message);
    }
    public function moveToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Please login to manage your basket.');
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if (!$wishlist) {
            return back()->with('error', 'Item not found in favorites.');
        }

        $product = Product::with('vendor')->findOrFail($productId);
        $cart = session()->get('cart', []);

        // Add to cart logic (simpler version for wishlist move)
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "id" => $product->id,
                "cart_key" => $productId,
                "name" => $product->name,
                "slug" => $product->slug,
                "quantity" => 1,
                "price" => $product->discount_price > 0 ? $product->discount_price : $product->price,
                "image" => $product->image_url,
                "vendor_id" => $product->vendor_id,
                "vendor_name" => $product->vendor->name ?? 'Artisan Partner',
                "category_name" => $product->category->name ?? 'Premium Item',
                "attributes" => [], // No attributes selected from wishlist move
                "shipping_charge" => 0
            ];
        }

        session()->put('cart', $cart);
        $wishlist->delete();

        return back()->with('status', 'Moved to basket successfully.');
    }
}
