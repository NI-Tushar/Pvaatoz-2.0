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
        'tag',
        'hot_or_popular',
        'product_logo',
        'bg_color',
        'product_color',
        'product_name',
        'product_desc',
        'feature_list',
        'status',
    ];

    // Cast feature_list to array
    protected $casts = [
        'feature_list' => 'array',
    ];
}
