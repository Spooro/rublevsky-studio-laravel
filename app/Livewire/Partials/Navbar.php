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
    public $anchors = [];

    public function mount()
    {
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
        $this->isStorePage = $this->checkIsStorePage();
        $this->currentRoute = request()->route()->getName();
        $this->setAnchors();
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
        $this->setAnchors();
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }

    private function checkIsStorePage()
    {
        $routeName = request()->route()->getName();
        return in_array($routeName, [
            'store',
            'store.product',
            'cart',
            'checkout',
            'success',
            'cancel',
            'my-orders',
            'my-orders.show',
            'my-account'
        ]);
    }

    private function setAnchors()
    {
        switch ($this->currentRoute) {
            case 'work':
                $this->anchors = [
                    ['label' => 'Web', 'href' => '#web'],
                    ['label' => 'Branding', 'href' => '#branding'],
                    ['label' => 'Photos', 'href' => '#photos'],
                    ['label' => 'Posters', 'href' => '#posters'],
                ];
                break;
            case 'contact':
                $this->anchors = [
                    ['label' => 'Send me a message', 'href' => '#reach-out'],
                    [
                        'label' => 'Book a call',
                        'href' => 'https://cal.com/rublevsky',
                        'isExternal' => true,
                        'isAccent' => true
                    ],
                ];
                break;
            case 'blog':
                $this->anchors = []; // Add any blog-specific anchors here if needed
                break;
            default:
                $this->anchors = [];
        }
    }
}
