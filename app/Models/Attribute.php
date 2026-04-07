<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = [
        'name',
        'display_type',
    ];

    public function productAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
