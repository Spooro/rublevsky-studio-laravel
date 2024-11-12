<div class="w-full px-4 pt-4 pb-36 no-scrollbar">
    <h1 class="text-4xl font-normal mb-8">Thank you! Your order has been received.</h1>

    <!-- Change to mobile layout at 1024px instead of 768px for better content display -->
    <div class="flex flex-col lg:flex-row gap-16">
        <div class="lg:w-2/3">
            <!-- Shipping Address -->
            <div class="bg-white overflow-x-auto rounded-lg">
                <h2 class="text-xl font-normal mb-4">Shipping Address</h2>
                <div>
                    <p>{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }},
                        {{ $address->zip_code }}, {{ $address->country }}</p>
                    <p class="mt-2">{{ $address->phone }}</p>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="overflow-x-auto rounded-lg mb-4 mt-6">
                <table class="w-full">
                    <tbody>
                        @foreach ($order_items as $item)
                            <tr class="{{ !$loop->last ? 'border-b' : '' }}">
                                <td class="py-4 w-24 shrink-0">
                                    <img class="w-24 h-auto object-cover rounded-md"
                                        src="{{ Storage::url($item->product->images[0]) }}"
                                        alt="{{ $item->product->name }}">
                                </td>
                                <td class="pl-4 w-fit">
                                    <div class="flex items-center">
                                        <span class="font-normal text-gray-800">{{ $item->product->name }}</span>
                                        @if ($item->product->coming_soon)
                                            <span
                                                class="ml-2 inline-block px-2 py-1 text-xs bg-gray-100 text-black rounded">Pre-order</span>
                                        @endif
                                    </div>
                                    @if ($item->attributes)
                                        <div class="text-sm text-gray-400 mt-1">
                                            @foreach (json_decode($item->attributes, true) as $attribute => $value)
                                                <span class="inline-block mr-3">{{ $value }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="pl-4 whitespace-nowrap">
                                    {{ Number::currency($item->unit_amount, 'CAD') }}
                                </td>
                                <td class="pl-4 whitespace-nowrap">
                                    {{ $item->quantity }}
                                </td>
                                <td class="text-right whitespace-nowrap pl-4">
                                    {{ Number::currency($item->total_amount, 'CAD') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-lg">
                <h2 class="text-xl font-normal mb-4">Summary</h2>

                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <span>Order Number</span>
                        <span class="font-normal">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Date</span>
                        <span class="font-normal">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="pt-4 border-t">
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($order->grand_total, 'CAD') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="mr-4">Shipping</span>
                        <span class="whitespace-nowrap">To be discussed</span>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between mb-4">
                        <span class="font-normal">Total</span>
                        <span class="font-normal">{{ Number::currency($order->grand_total, 'CAD') }}</span>
                    </div>
                </div>

                <a href="/store" class="main-button w-full whitespace-nowrap">
                    Back to shopping
                </a>
            </div>
        </div>
    </div>
</div>
