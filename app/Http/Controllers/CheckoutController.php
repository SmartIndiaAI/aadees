<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusChanged;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your portfolio is currently empty of acquisitions.');
        }

        $total = 0;
        $shipping = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
            $shipping += $item['shipping_charge'] ?? 0;
        }

        return view('customer.checkout', compact('cart', 'total', 'shipping'));
    }

    /**
     * Process checkout and trigger Razorpay order.
     */
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your portfolio is currently empty of acquisitions.');
        }

        return DB::transaction(function () use ($request, $cart) {
            $total = 0;
            $shipping = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
                $shipping += $item['shipping_charge'] ?? 0;
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'shipping_name' => $request->name,
                'shipping_phone' => $request->phone,
                'shipping_address' => $request->address,
                'shipping_city' => $request->city,
                'shipping_state' => $request->state,
                'shipping_zip' => $request->zip,
                'total_amount' => $total + $shipping,
                'discount_amount' => 0,
                'shipping_amount' => $shipping,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $item) {
                $actualProductId = $item['id'] ?? $item['product_id'];
                $product = Product::find($actualProductId);
                
                if (!$product) continue;

                // Calculate shares
                $itemTotal = $item['price'] * $item['quantity'];
                $adminCommissionSetting = \App\Models\Setting::where('key', 'admin_commission')->first();
                $adminCommission = $product->category->commission_rate ?? ($adminCommissionSetting ? $adminCommissionSetting->value : 10);
                $adminShare = ($itemTotal * $adminCommission) / 100;
                $vendorShare = ($itemTotal - $adminShare) + ($item['shipping_charge'] ?? 0);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $actualProductId,
                    'vendor_id' => $item['vendor_id'],
                    'variant_id' => $item['variant_id'] ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'admin_share' => $adminShare,
                    'vendor_share' => $vendorShare,
                    'status' => 'pending',
                ]);
            }

            // Handle Payment Status logic
            if ($request->payment_method === 'razorpay' && $request->has('razorpay_payment_id')) {
                $order->update([
                    'payment_status' => 'paid',
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'status' => 'confirmed',
                ]);
                // Cascade status to order items
                $order->orderItems()->update(['status' => 'confirmed']);
            } else {
                $order->update([
                    'payment_status' => 'pending',
                    'status' => 'pending', // Awaiting manual confirmation or delivery for COD
                ]);
            }

            return redirect()->route('checkout.success', $order->id);
        });
    }

    /**
     * Handle payment success and show summary.
     */
    public function handlePaymentSuccess(Request $request, $orderId)
    {
        $order = Order::with('orderItems.vendor')->findOrFail($orderId);

        // Logic for splitting payments into Transfers (Only for paid orders)
        if ($order->payment_status === 'paid') {
            foreach($order->orderItems as $item) {
                if($item->vendor->razorpay_account_id) {
                    // Check if transfer already exists to avoid duplicates on refresh
                    $exists = Transfer::where('reference_id', 'TRF-' . $order->order_number . '-' . $item->vendor_id . '-' . $item->id)->exists();
                    if (!$exists) {
                        Transfer::create([
                            'order_id' => $order->id,
                            'vendor_id' => $item->vendor_id,
                            'amount' => $item->vendor_share,
                            'status' => 'pending_kyc',
                            'transfer_id' => 'trf_simulated_' . Str::random(10),
                            'reference_id' => 'TRF-' . $order->order_number . '-' . $item->vendor_id . '-' . $item->id,
                        ]);
                    }
                }
            }
        }

        // Clear the cart
        session()->forget('cart');

        return view('customer.checkout_success', compact('order'));
    }
}
