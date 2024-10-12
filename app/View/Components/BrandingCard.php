<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BrandingCard extends Component
{
    public $name;
    public $images;
    public $description;

    public function __construct($name, $images, $description)
    {
        $this->name = $name;
        $this->images = $images;
        $this->description = $description;
    }

    public function render()
    {
        return view('components.branding-card');
    }
}
