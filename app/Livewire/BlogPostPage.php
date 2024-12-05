<?php

namespace App\Livewire;

use App\Models\BlogPost;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Support\Str;

class BlogPostPage extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = BlogPost::where('slug', $slug)->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.blog-post-page', [
            'title' => $this->post->title . " | Rublevsky Studio",
            'metaDescription' => Str::limit(strip_tags($this->post->body), 155)
        ]);
    }
}
