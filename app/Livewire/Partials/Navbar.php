<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $total_count = 0;
    public $isStorePage = false;
    public $currentRoute;

    public function mount()
    {
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
        $this->isStorePage = $this->checkIsStorePage();
        $this->currentRoute = request()->route()->getName();
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    #[On('navigation.updated')]
    public function updateCurrentRoute($route)
    {
        $this->currentRoute = $route;
        $this->isStorePage = $this->checkIsStorePage();
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }

    private function checkIsStorePage()
    {
        $routeName = request()->route()->getName();
        return in_array($routeName, ['store', 'store.product', 'cart', 'checkout', 'success', 'cancel']);
    }
}
