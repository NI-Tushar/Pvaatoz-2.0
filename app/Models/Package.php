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

    protected $appends = [
        'features_array',
        'account_count',
        'unit_price_per_account',
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

    /**
     * Determine account/units count for this package.
     */
    public function getAccountCountAttribute(): int
    {
        // 1. Check features list first
        if (!empty($this->features_array)) {
            foreach ($this->features_array as $feat) {
                if (preg_match('/(?:quantity|count|batch)\s*:\s*(\d+)/i', $feat, $m)) {
                    return max(1, (int) $m[1]);
                }
                if (preg_match('/^(\d+)\s*(?:accounts?|inboxes?|slots?|lines?|profiles?|consoles?|channels?|droplets?|pack)/i', trim($feat), $m)) {
                    return max(1, (int) $m[1]);
                }
            }
        }

        // 2. Check package_name (e.g. "— 100 Accounts", "- 50 Accounts", "(25 Accounts)", "100 Accounts")
        if (preg_match('/(?:—|-|\(|\|)?\s*(\d+)\s*(?:accounts?|inboxes?|slots?|lines?|profiles?|consoles?|channels?|droplets?|pack|ea)/i', $this->package_name, $m)) {
            return max(1, (int) $m[1]);
        }

        // 3. Fallback: match any number before accounts/inboxes/lines/slots in name or heading
        if (preg_match('/(\d+)\s*(?:accounts?|inboxes?|slots?|lines?|profiles?|channels?)/i', $this->package_name . ' ' . ($this->package_heading ?? ''), $m)) {
            return max(1, (int) $m[1]);
        }

        return 1;
    }

    /**
     * Calculate effective unit price per account for this package.
     */
    public function getUnitPricePerAccountAttribute(): float
    {
        $count = $this->account_count;
        $price = (float) $this->price;
        if ($count > 0 && $price > 0) {
            return round($price / $count, 4);
        }
        return $price > 0 ? $price : 0.85;
    }
}
