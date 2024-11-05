<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariation;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'stock',
        'on_sale',
        'has_variations',
        'unlimited_stock',
        'has_volume',
        'volume',
    ];

    protected $casts = [
        'images' => 'array',
        'has_variations' => 'boolean',
        'has_volume' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Add this method
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('sort');
    }
}
