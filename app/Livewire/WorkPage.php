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

    public function mount()
    {
        $this->posters = $this->getFiles('posters');
        $this->photos = $this->getFiles('photos');
        $this->things = $this->getFiles('things');
        $this->brandingProjects = $this->getBrandingProjects();
    }

    public function render()
    {
        return view('livewire.work-page');
    }

    private function getFiles($directory)
    {
        return array_filter(Storage::disk('public')->files($directory), function ($file) {
            return !str_starts_with(basename($file), '.');
        });
    }

    private function getBrandingProjects()
    {
        $projects = Storage::disk('public')->directories('branding');
        $projectData = [];

        foreach ($projects as $project) {
            $files = $this->getFiles($project);
            if (!empty($files)) {
                $previewImage = $this->findPreviewImage($files);
                if ($previewImage !== null) {
                    $projectData[] = [
                        'name' => basename($project),
                        'previewImage' => $previewImage,
                        'images' => array_map(function ($file) use ($project) {
                            return $project . '/' . basename($file);
                        }, $files),
                    ];
                }
            }
        }

        return $projectData;
    }

    private function findPreviewImage($files)
    {
        if (empty($files)) {
            return null;
        }

        foreach ($files as $file) {
            if (basename($file) === '1.jpg') {
                return $file;
            }
        }

        // If '1.jpg' is not found, return the first file or null if the array is empty
        return $files[0] ?? null;
    }
}
