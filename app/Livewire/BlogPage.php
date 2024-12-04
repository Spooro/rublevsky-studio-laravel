<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;

class BlogPage extends Component
{
    public $title = "Blog | Rublevsky Studio";
    public $metaDescription = "Read the latest articles and insights from Rublevsky Studio about design, development, and creative processes.";

    public function mount()
    {
        // Add any initialization logic here
    }

    public function render(): View
    {
        return view('livewire.blog-page', [
            'title' => $this->title,
            'metaDescription' => $this->metaDescription
        ]);
    }
}
