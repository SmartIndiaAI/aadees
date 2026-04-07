<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $vendorId = Auth::guard('vendor')->id();

        $orders = OrderItem::where('vendor_id', $vendorId)
            ->with(['order', 'product'])
            ->latest()
            ->paginate(10);

        return view('vendor.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $vendorId = Auth::guard('vendor')->id();
        
        $item = OrderItem::where('vendor_id', $vendorId)
            ->with(['order.user', 'product'])
            ->findOrFail($id);

        return view('vendor.orders.show', compact('item'));
    }

    public function updateStatus(Request $request, $id)
    {
        $vendorId = Auth::guard('vendor')->id();
        $item = OrderItem::where('vendor_id', $vendorId)->findOrFail($id);

        $item->update(['status' => $request->status]);

        return back()->with('success', 'Acquisition status updated successfully.');
    }
}
