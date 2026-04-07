<?php

namespace App\Observers;

use App\Models\Order;
use App\Mail\OrderStatusChanged;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->isDirty('status')) {
            // Notify Customer
            Mail::to($order->user->email)->send(new OrderStatusChanged($order, "Your order status has been changed to " . strtoupper($order->status)));

            // Notify all involved Vendors
            $vendors = $order->orderItems->pluck('vendor')->unique();
            foreach ($vendors as $vendor) {
                Mail::to($vendor->email)->send(new OrderStatusChanged($order, "Order #{$order->order_number} has been updated to " . strtoupper($order->status)));
            }
        }
    }
}
