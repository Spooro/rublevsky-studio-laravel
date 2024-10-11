<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    public function render()
    {
        $my_orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(12);
        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}
