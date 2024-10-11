<section class="flex items-center font-poppins bg-white">
    <div class="max-w-5xl px-4 py-8 mx-auto w-full">
        <h2 class="mb-8">
            Thank you! Your order has been received.
        </h2>
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="lg:w-2/3 pr-8">
                <div class="flex flex-col md:flex-row justify-between mb-8">
                    <div class="mb-4 md:mb-0">
                        <p class="font-semibold text-lg">{{ $order->address->full_name }}</p>
                        <p>{{ $order->address->street_address }}</p>
                        <p>{{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->zip_code }}
                        </p>
                        <p>{{ $order->address->phone }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-600 mb-1">Shipping</p>
                        <p class="font-semibold">Delivery</p>
                        <p class="text-sm text-gray-600">Delivery within 24 hours</p>
                    </div>
                </div>

                <div class="mb-8 bg-gray-100 p-4 rounded-lg">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-gray-600 text-sm">Order number</p>
                            <p class="font-semibold">{{ $order->id }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Date</p>
                            <p class="font-semibold">{{ $order->created_at->format('d m Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Total</p>
                            <p class="font-semibold">{{ Number::currency($order->grand_total, 'CAD') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Payment Method</p>
                            <p class="font-semibold">{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Card' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/3 lg:border-l lg:pl-8">
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Summary</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span>{{ Number::currency($order->grand_total, 'CAD') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Taxes</span>
                            <span>{{ Number::currency(0, 'CAD') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span>{{ Number::currency(0, 'CAD') }}</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600 mb-1">Total</p>
                    <p class="text-3xl font-bold">{{ Number::currency($order->grand_total, 'CAD') }}</p>
                </div>

                <div class="flex flex-col gap-4">
                    <a href="/store"
                        class="w-full px-6 py-2 text-center border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">
                        Back to shopping
                    </a>
                    <a href="/my-orders"
                        class="w-full px-6 py-2 text-center text-white bg-black rounded-md hover:bg-gray-800 transition-colors">
                        View my orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
