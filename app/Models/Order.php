<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'total_amount',
        'discount_amount',
        'shipping_amount',
        'payment_status',
        'payment_method',
        'razorpay_payment_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
