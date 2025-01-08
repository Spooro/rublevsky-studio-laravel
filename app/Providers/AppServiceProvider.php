<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Livewire\Partials\Navbar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('partials.navbar', Navbar::class);

        // Ensure Livewire temporary upload directory exists
        $tmpPath = storage_path('app/livewire-tmp');
        if (!file_exists($tmpPath)) {
            mkdir($tmpPath, 0755, true);
        }
    }
}
