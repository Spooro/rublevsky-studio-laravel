<x-mail::message>
    # Order placed successfully!

    {!! __('Thank you for your order! Your order number is :orderNumber.', ['orderNumber' => $order->id]) !!}

    <x-mail::button :url="$url">
        View Order
    </x-mail::button>

    Thanks,<br>
    Rublevsky Store
</x-mail::message>
