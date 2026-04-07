<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\Vendor;
use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $keyId = Setting::where('key', 'razorpay_key')->first()?->value;
        $keySecret = Setting::where('key', 'razorpay_secret')->first()?->value;

        if ($keyId && $keySecret) {
            $this->api = new Api($keyId, $keySecret);
        }
    }

    /**
     * Create a Razorpay Linked Account (Route) for a vendor.
     */
    public function createLinkedAccount(Vendor $vendor)
    {
        if (!$this->api) return null;

        try {
            $account = $this->api->account->create([
                'email' => $vendor->email,
                'name'  => $vendor->name,
                'type'  => 'route',
                'reference_id' => 'VEND_'.str_pad($vendor->id, 6, '0', STR_PAD_LEFT),
                'business_name' => $vendor->business_name ?? $vendor->name,
            ]);

            $vendor->update([
                'razorpay_account_id' => $account->id,
                'razorpay_onboarding_link' => $account->onboarding_url ?? null,
            ]);

            return $account;
        } catch (Exception $e) {
            Log::error('Razorpay Linked Account Creation Failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Transfer split funds to one or more vendors.
     */
    public function transferFunds($paymentId, $transfers)
    {
        if (!$this->api) return null;

        try {
            return $this->api->transfer->create([
                'account' => $transfers['account'], // Vendor razorpay_account_id
                'amount'  => $transfers['amount'],  // In Paise
                'currency' => 'INR',
                'notes'   => $transfers['notes'] ?? [],
                'source'  => $paymentId,
            ]);
        } catch (Exception $e) {
            Log::error('Razorpay Transfer Failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Check KYC status of a linked account.
     */
    public function checkKycStatus($accountId)
    {
        if (!$this->api) return 'pending';

        try {
            $account = $this->api->account->fetch($accountId);
            // Razorpay account status handling logic
            return $account->status ?? 'pending';
        } catch (Exception $e) {
            Log::error('Razorpay KYC Check Failed: ' . $e->getMessage());
            return 'pending';
        }
    }
}
