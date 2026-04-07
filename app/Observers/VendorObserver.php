<?php

namespace App\Observers;

use App\Models\Vendor;
use App\Services\RazorpayService;

class VendorObserver
{
    protected $razorpay;

    public function __construct(RazorpayService $razorpay)
    {
        $this->razorpay = $razorpay;
    }

    /**
     * Handle the Vendor "created" event.
     */
    public function created(Vendor $vendor): void
    {
        // Automatically create Razorpay Linked Account via API
        $this->razorpay->createLinkedAccount($vendor);
    }

    /**
     * Handle the Vendor "updated" event.
     */
    public function updated(Vendor $vendor): void
    {
        //
    }
}
