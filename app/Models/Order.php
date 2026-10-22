<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'notes',
        'payment_method',
        'payment_status',
        'status',
        'total_quantity',
        'total_price',
        'delivery_credentials',
        'admin_notes',
        'ip_address',
    ];

    protected $casts = [
        'total_quantity' => 'integer',
        'total_price' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Search scope across order number, customer name, email, phone, and items
     */
    public function scopeSearch($query, $term)
    {
        if (empty($term)) {
            return $query;
        }

        $term = trim($term);
        return $query->where(function ($q) use ($term) {
            $q->where('order_number', 'like', "%{$term}%")
              ->orWhere('customer_name', 'like', "%{$term}%")
              ->orWhere('customer_email', 'like', "%{$term}%")
              ->orWhere('customer_phone', 'like', "%{$term}%")
              ->orWhere('payment_method', 'like', "%{$term}%")
              ->orWhereHas('items', function ($iq) use ($term) {
                  $iq->where('product_name', 'like', "%{$term}%")
                     ->orWhere('category', 'like', "%{$term}%");
              });
        });
    }

    /**
     * Get badge color class for order status
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'completed' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40',
            'processing' => 'bg-blue-500/20 text-blue-400 border border-blue-500/40',
            'cancelled' => 'bg-rose-500/20 text-rose-400 border border-rose-500/40',
            default => 'bg-amber-500/20 text-amber-400 border border-amber-500/40', // pending
        };
    }

    /**
     * Get badge color class for payment status
     */
    public function getPaymentBadgeAttribute()
    {
        return match ($this->payment_status) {
            'paid' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40',
            'failed' => 'bg-rose-500/20 text-rose-400 border border-rose-500/40',
            'refunded' => 'bg-purple-500/20 text-purple-400 border border-purple-500/40',
            default => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/40', // pending
        };
    }
}
