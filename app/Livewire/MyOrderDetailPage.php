<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Order Details')]
class MyOrderDetailPage extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::with(['items.product', 'address'])->findOrFail($this->order_id);

        return view('livewire.my-order-detail-page', [
            'order' => $order,
            'order_items' => $order->items,
            'address' => $order->address,
        ]);
    }
}
