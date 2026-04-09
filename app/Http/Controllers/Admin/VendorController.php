<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::latest()->paginate(15);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendors.show', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        return back()->with('success', 'Marketplace Partner intelligence updated.');
    }

    public function createRazorpayAccount($id, \App\Services\RazorpayService $razorpay)
    {
        $vendor = Vendor::findOrFail($id);
        
        if ($vendor->razorpay_account_id) {
            return back()->with('error', 'Linked Partner Node already indexed on Razorpay Route.');
        }

        $account = $razorpay->createLinkedAccount($vendor);

        if ($account) {
            return back()->with('success', 'Neural Link established with Razorpay Route. Account ID and Onboarding Link synchronized.');
        }

        return back()->with('error', 'Critical System Failure: Failed to establish link with Razorpay Route. Check API credentials or connection logs.');
    }
}
