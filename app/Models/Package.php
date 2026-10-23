<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        'product_id',
        'package_name',
        'package_heading',
        'features',
        'price',
        'is_highlight',
        'is_enabled',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_highlight' => 'boolean',
        'is_enabled' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Associated product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Helper to get features as formatted array safely.
     */
    public function getFeaturesArrayAttribute(): array
    {
        if (is_array($this->features)) {
            return $this->features;
        }

        if (is_string($this->features) && !empty($this->features)) {
            $decoded = json_decode($this->features, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            return array_values(array_filter(array_map('trim', preg_split('/[\r\n]+/', $this->features))));
        }

        return [];
    }

    /**
     * Helper to get features as newline separated string for textarea.
     */
    public function getFeaturesTextAttribute(): string
    {
        return implode("\n", $this->features_array);
    }
}
