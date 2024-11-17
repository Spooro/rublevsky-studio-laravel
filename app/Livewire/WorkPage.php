<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WorkPage extends Component
{
    public $title = "Work | Rublevsky Studio";
    public $metaDescription = "Explore our portfolio of web design, branding, and photography projects. From innovative website designs to creative branding solutions, discover how we help businesses make their mark.";

    public function mount()
    {
        // Force a full page reload when navigating to work page if coming from cache
        if (request()->header('Purpose') === 'prefetch') {
            header("Cache-Control: no-cache, must-revalidate");
        }
    }

    public function render(): View
    {
        return view('livewire.work-page', [
            'title' => $this->title,
            'metaDescription' => $this->metaDescription
        ]);
    }
}
