<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Transfer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'admin_commission' => OrderItem::whereHas('order', function($q) {
                $q->where('payment_status', 'paid');
            })->sum('admin_share'),
            'vendor_payouts' => Transfer::whereIn('status', ['success', 'processed'])->sum('amount'),
            'pending_payouts' => Transfer::whereIn('status', ['pending', 'pending_kyc', 'failed'])->sum('amount'),
            'active_vendors' => Vendor::where('razorpay_account_status', 'active')->count(),
            'pending_vendors' => Vendor::where('razorpay_account_status', '!=', 'active')->count(),
        ];

        $recentTransfers = Transfer::with(['order', 'vendor'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentTransfers'));
    }

    public function transfers()
    {
        $transfers = Transfer::with(['order', 'vendor'])->latest()->paginate(25);
        return view('admin.transfers', compact('transfers'));
    }

    public function settings()
    {
        $settings = \App\Models\Setting::all()->groupBy(function($item) {
            if (str_starts_with($item->key, 'theme_')) return 'Theme';
            if (str_starts_with($item->key, 'site_')) return 'Branding';
            if (str_starts_with($item->key, 'contact_')) return 'Contact';
            if (str_starts_with($item->key, 'social_')) return 'Social';
            if (str_ends_with($item->key, '_content')) return 'Legal & Pages';
            return 'Others';
        });
        
        return view('admin.settings', compact('settings'));
    }

    public function updateSetting(Request $request)
    {
        $request->validate([
            'key' => 'required|string|exists:settings,key',
            'value' => 'nullable',
        ]);

        $setting = \App\Models\Setting::where('key', $request->key)->first();

        if ($request->key === 'site_logo' && $request->hasFile('value')) {
            $path = $request->file('value')->store('settings', 'public');
            $setting->update(['value' => $path]);
        } else {
            $setting->update(['value' => $request->value]);
        }

        return back()->with('status', 'Platform variable synchronized successfully.');
    }
}
