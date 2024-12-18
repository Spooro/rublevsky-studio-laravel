<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'images',
        'published_at',
        'last_edited_at',
        'blog_category_id',
        'is_active',
        'show_title',
        'product_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'last_edited_at' => 'datetime',
        'images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (! $post->slug) {
                $post->slug = Str::slug($post->title);
            }

            $post->published_at = $post->published_at ?? now();
        });

        static::updating(function ($post) {
            if ($post->isDirty(['title', 'body', 'images'])) {
                $post->last_edited_at = now();
            }
        });
    }

    public function getDisplayDateAttribute()
    {
        return $this->published_at->format('F j, Y');
    }

    public function getIsEditedAttribute()
    {
        return $this->last_edited_at && $this->last_edited_at->gt($this->published_at);
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImagesAttribute($value)
    {
        // If this post has a linked product, return product images
        if ($this->product_id && $this->product) {
            return $this->product->images;
        }

        // Otherwise return the post's own images
        return $value ? json_decode($value, true) : [];
    }
}
