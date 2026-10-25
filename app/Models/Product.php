<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel's naming convention)
    protected $table = 'products';

    // Mass assignable fields
    protected $fillable = [
        'category',
        'tag',
        'popularity',
        'product_logo',
        'bg_color_1',
        'bg_color_2',
        'product_color',
        'product_name',
        'product_desc',
        'feature_list',
        'status',
        'show_in_hero',
    ];

    // Cast feature_list to array and show_in_hero to boolean
    protected $casts = [
        'feature_list' => 'array',
        'show_in_hero' => 'boolean',
    ];

    /**
     * All packages associated with this product.
     */
    public function packages()
    {
        return $this->hasMany(Package::class, 'product_id')->orderBy('sort_order', 'asc')->orderBy('price', 'asc');
    }

    /**
     * Active / enabled packages shown on website panel.
     */
    public function activePackages()
    {
        return $this->hasMany(Package::class, 'product_id')
            ->where('is_enabled', true)
            ->orderByDesc('is_highlight')
            ->orderBy('sort_order', 'asc')
            ->orderBy('price', 'asc');
    }
}
