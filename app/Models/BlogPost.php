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
        'featured_image',
        'published_at',
        'last_edited_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'last_edited_at' => 'datetime',
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
            if ($post->isDirty(['title', 'body', 'featured_image'])) {
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
}
