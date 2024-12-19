<?php

namespace App\Livewire;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Livewire\Component;
use Livewire\Attributes\Url;

class BlogPage extends Component
{
    #[Url(as: 'categories')]
    public $selected_categories = '';

    public function setCategory($categoryId)
    {
        if ($categoryId === null) {
            $this->selected_categories = '';
            return;
        }

        $categorySlug = $this->getCategorySlugFromId($categoryId);
        $categories = $this->selected_categories ? explode(',', $this->selected_categories) : [];

        if (($key = array_search($categorySlug, $categories)) !== false) {
            unset($categories[$key]);
        } else {
            $categories[] = $categorySlug;
        }

        $this->selected_categories = implode(',', array_filter($categories));
    }

    private function getCategorySlugFromId($id)
    {
        return BlogCategory::where('id', $id)->value('slug');
    }

    public function render()
    {
        $postsQuery = BlogPost::query()
            ->where('is_active', true)
            ->when($this->selected_categories, function ($query) {
                $categoryIds = BlogCategory::whereIn('slug', explode(',', $this->selected_categories))
                    ->pluck('id')
                    ->toArray();
                $query->whereIn('blog_category_id', $categoryIds);
            })
            ->orderBy('published_at', 'desc');

        return view('livewire.blog-page', [
            'posts' => $postsQuery->get(),
            'categories' => BlogCategory::where('is_active', true)->get(),
        ]);
    }
}
