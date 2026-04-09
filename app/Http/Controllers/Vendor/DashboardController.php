<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendorId = Auth::guard('vendor')->id();
        $vendor = Auth::guard('vendor')->user();

        $stats = [
            'total_sales' => OrderItem::where('vendor_id', $vendorId)->get()->sum(function($i) { return $i->price * $i->quantity; }),
            'paid_earnings' => Transfer::where('vendor_id', $vendorId)->whereIn('status', ['success', 'processed'])->sum('amount'),
            'pending_earnings' => Transfer::where('vendor_id', $vendorId)
                ->whereIn('status', ['pending', 'pending_kyc'])
                ->sum('amount'),
            'failed_earnings' => Transfer::where('vendor_id', $vendorId)->where('status', 'failed')->sum('amount'),
            'total_orders' => OrderItem::where('vendor_id', $vendorId)->count(),
        ];

        // Isolated recent orders for this vendor
        $recentOrders = OrderItem::where('vendor_id', $vendorId)
            ->with(['order', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', compact('vendor', 'stats', 'recentOrders'));
    }

    public function earnings()
    {
        $vendorId = Auth::guard('vendor')->id();
        $transfers = Transfer::where('vendor_id', $vendorId)
            ->with(['order'])
            ->latest()
            ->paginate(15);
            
        $stats = [
            'paid' => Transfer::where('vendor_id', $vendorId)->whereIn('status', ['success', 'processed'])->sum('amount'),
            'pending' => Transfer::where('vendor_id', $vendorId)->whereIn('status', ['pending', 'pending_kyc'])->sum('amount'),
            'failed' => Transfer::where('vendor_id', $vendorId)->where('status', 'failed')->sum('amount'),
        ];

        return view('vendor.earnings', compact('transfers', 'stats'));
    }

    public function help()
    {
        return view('vendor.help');
    }

    public function settings()
    {
        $vendor = Auth::guard('vendor')->user();
        return view('vendor.settings', compact('vendor'));
    }

    public function updateSettings(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();
        
        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email|max:255',
            'razorpay_account_id' => 'required|string|max:255',
        ]);

        $vendor->update([
            'business_name' => $request->business_name,
            'email' => $request->business_email,
            'razorpay_account_id' => $request->razorpay_account_id,
        ]);

        return back()->with('success', 'Profile and integration details updated successfully.');
    }
}
