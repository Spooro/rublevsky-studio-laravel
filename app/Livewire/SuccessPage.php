<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Success')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        $latestOrder = Order::with('address')->where('user_id', Auth::user()->id)->latest()->first();

        if ($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);

            if ($session_info->payment_status == 'paid') {
                $latestOrder->payment_status = 'paid';
                $latestOrder->save();
            } else {
                // TODO:  failed payment is not being set?
                $latestOrder->payment_status = 'failed';
                $latestOrder->save();
                return redirect()->route('cancel');
            }
        }

        return view(
            'livewire.success-page',
            ['order' => $latestOrder]
        );
    }
}
