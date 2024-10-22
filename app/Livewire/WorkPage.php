<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class WorkPage extends Component
{
    public $posters = [];
    public $photos = [];
    public $things = [];
    public $brandingProjects = [];

    private function getFiles($directory)
    {
        return array_filter(Storage::disk('public')->files($directory), function ($file) {
            return !str_starts_with(basename($file), '.');
        });
    }

    public function mount()
    {
        $this->posters = $this->getFiles('posters');
        $this->photos = $this->getFiles('photos');
        $this->things = $this->getFiles('things');
        //$this->brandingProjects = $this->getBrandingProjects();
    }

    public function render()
    {
        return view('livewire.work-page');
    }
}
