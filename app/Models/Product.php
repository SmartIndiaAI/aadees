<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\VendorScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([VendorScope::class])]
class Product extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'slug',
        'description',
        'specifications',
        'price',
        'discount_price',
        'sku',
        'stock',
        'thumbnail',
        'gallery',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'status' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * Get the product image url.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->thumbnail) {
            return asset('placeholder.png');
        }

        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return asset($this->thumbnail);
    }
}
