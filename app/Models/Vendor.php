<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    /** @use HasFactory */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'business_name',
        'email',
        'password',
        'razorpay_account_id',
        'razorpay_account_status',
        'razorpay_onboarding_link',
        'commission_percentage',
        'cod_enabled',
        'help_instructions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'cod_enabled' => 'boolean',
            'commission_percentage' => 'decimal:2',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
