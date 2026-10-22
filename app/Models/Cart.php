<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'product_id',
        'quantity',
        'unit_price',
    ];

    /**
     * Relationship with Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Calculate item subtotal
     */
    public function getSubtotalAttribute()
    {
        return round($this->quantity * ($this->unit_price ?: 0.85), 2);
    }

    /**
     * Calculate volume discount based on quantity
     */
    public function getDiscountRateAttribute()
    {
        if ($this->quantity >= 100) return 0.25;
        if ($this->quantity >= 50) return 0.15;
        if ($this->quantity >= 25) return 0.10;
        return 0;
    }

    /**
     * Calculate item total after discount
     */
    public function getTotalPriceAttribute()
    {
        $subtotal = $this->subtotal;
        return round($subtotal * (1 - $this->discountRate), 2);
    }
}
