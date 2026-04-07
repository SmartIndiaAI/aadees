<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([VendorScope::class])]
class OrderItem extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'vendor_id',
        'product_id',
        'quantity',
        'price',
        'shipping_charge',
        'admin_share',
        'vendor_share',
        'transfer_reference_id',
        'is_transfer_processed',
        'status',
    ];

    protected $casts = [
        'is_transfer_processed' => 'boolean',
        'price' => 'decimal:2',
        'shipping_charge' => 'decimal:2',
        'admin_share' => 'decimal:2',
        'vendor_share' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
