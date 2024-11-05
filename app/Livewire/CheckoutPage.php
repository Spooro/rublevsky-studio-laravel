<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use App\Mail\OrderPlaced;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Mail\NewOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $country;

    protected $rules = [
        'email' => 'required|email',
        'first_name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z\s\'-]+$/',
        'last_name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z\s\'-]+$/',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
        'street_address' => 'required|string|min:5|max:255',
        'city' => 'required|string|min:2|max:100|regex:/^[a-zA-Z\s\'-]+$/',
        'state' => 'required|string|min:2|max:100|regex:/^[a-zA-Z\s\'-]+$/',
        'country' => 'required|string|min:2|max:100',
        'zip_code' => 'required|string|min:5|max:10',
    ];

    protected $messages = [
        'first_name.regex' => 'The first name may only contain letters, spaces, hyphens and apostrophes.',
        'last_name.regex' => 'The last name may only contain letters, spaces, hyphens and apostrophes.',
        'phone.regex' => 'Please enter a valid phone number.',
        'city.regex' => 'The city name may only contain letters, spaces, hyphens and apostrophes.',
        'state.regex' => 'The state name may only contain letters, spaces, hyphens and apostrophes.',
    ];

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) == 0) {
            return redirect('/store');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function placeOrder()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $cart_items = CartManagement::getCartItemsFromCookie();

            $order = new Order();
            $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
            $order->payment_method = 'pending';
            $order->payment_status = 'pending';
            $order->status = 'new';
            $order->currency = 'cad';
            $order->shipping_amount = 0;
            $order->shipping_method = 'none';
            $order->notes = 'Order placed by ' . $this->first_name . ' ' . $this->last_name;

            $order->save();

            $address = new Address();
            $address->first_name = $this->first_name;
            $address->last_name = $this->last_name;
            $address->email = $this->email;
            $address->phone = $this->phone;
            $address->street_address = $this->street_address;
            $address->city = $this->city;
            $address->state = $this->state;
            $address->zip_code = $this->zip_code;
            $address->country = $this->country;

            $address->order_id = $order->id;
            $address->save();

            $order->items()->createMany($cart_items);

            // Queue the emails
            Mail::to($this->email)->queue(new OrderPlaced($order));
            Mail::to(config('mail.admin_email'))->queue(new NewOrderNotification($order));

            DB::commit();

            CartManagement::clearCartItems();

            // Only redirect after successful transaction
            return redirect()->route('success', ['order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());

            $this->alert('error', 'Failed to place order. Please try again.');
            return;
        }
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
