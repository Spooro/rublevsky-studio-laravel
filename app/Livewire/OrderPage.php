<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\Title;

#[Title('Order Details')]
class OrderPage extends Component
{
    public $order_id;
    public $isLoading = true;
    public $attempts = 0;
    public $maxAttempts = 50;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function checkOrder()
    {
        $this->attempts++;

        $order = Order::find($this->order_id);

        if ($order) {
            $this->isLoading = false;
        } elseif ($this->attempts >= $this->maxAttempts) {
            abort(404, 'Order not found');
        }
    }

    public function render()
    {
        if ($this->isLoading) {
            return view('livewire.order-page-loading');
        }

        $order = Order::findOrFail($this->order_id);
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        $address = Address::where('order_id', $this->order_id)->first();

        return view('livewire.order-page', [
            'order' => $order,
            'order_items' => $order_items,
            'address' => $address
        ]);
    }
}
