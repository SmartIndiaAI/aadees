<?php

namespace App\Jobs;

use App\Models\Transfer;
use App\Services\RazorpayService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessFailedTransfers implements ShouldQueue
{
    use Queueable;

    public function handle(RazorpayService $razorpay): void
    {
        // Fetch all non-successful transfers
        $pendingTransfers = Transfer::whereIn('status', ['failed', 'pending_kyc', 'pending'])
            ->with(['order', 'vendor'])
            ->get();

        foreach ($pendingTransfers as $transfer) {
            // Only retry for active vendors
            if ($transfer->vendor->razorpay_account_status !== 'active') {
                // Check if KYC status has changed on Razorpay
                $newStatus = $razorpay->checkKycStatus($transfer->vendor->razorpay_account_id);
                if ($newStatus === 'active') {
                    $transfer->vendor->update(['razorpay_account_status' => 'active']);
                } else {
                    continue; // Still pending KYC
                }
            }

            try {
                // IDEMPOTENCY: Razorpay Route handles the reference_id on their side too
                $rpTransfer = $razorpay->transferFunds($transfer->order->razorpay_payment_id, [
                    'account' => $transfer->vendor->razorpay_account_id,
                    'amount'  => $transfer->amount * 100, // To Paise
                    'notes'   => ['order_number' => $transfer->order->order_number],
                ]);

                $transfer->update([
                    'status' => 'success',
                    'transfer_id' => $rpTransfer->id,
                    'failure_reason' => null,
                ]);

                // Update related order items
                $transfer->order->orderItems()
                    ->where('vendor_id', $transfer->vendor_id)
                    ->update(['is_transfer_processed' => true]);

            } catch (\Exception $e) {
                $transfer->update([
                    'status' => 'failed',
                    'failure_reason' => 'Retry failed: ' . $e->getMessage(),
                ]);
            }
        }
    }
}
