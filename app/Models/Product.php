<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Storage;

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
        'coming_soon',
    ];

    protected $casts = [
        'images' => 'array',
        'has_variations' => 'boolean',
        'has_volume' => 'boolean',
        'coming_soon' => 'boolean',
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

    // Add this relationship method
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if (!empty($product->images)) {
                foreach ($product->images as $image) {
                    Storage::disk('r2')->delete($image);
                }
            }
        });
    }
}
