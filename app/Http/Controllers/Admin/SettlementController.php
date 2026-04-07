<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\Vendor;
use App\Jobs\ProcessFailedTransfers;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::orderBy('name')->get();

        $query = Transfer::with(['order', 'vendor'])->latest();

        if ($request->vendor_id) {
            $query->where('vendor_id', $request->vendor_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $transfers = $query->paginate(20);

        return view('admin.settlements.index', compact('transfers', 'vendors'));
    }

    /**
     * Manual Trigger for Split Retry Queue.
     */
    public function retry()
    {
        ProcessFailedTransfers::dispatch();
        return redirect()->back()->with('success', 'Automated split retry queue has been dispatched.');
    }
}
