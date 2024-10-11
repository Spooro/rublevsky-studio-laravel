<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-normal mb-8">Shopping Cart</h1>
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-2/3">
                <div class="bg-white overflow-x-auto rounded-lg p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left font-normal text-gray-400 pb-4">Product</th>
                                <th class="text-left font-normal text-gray-400 pb-4">Price</th>
                                <th class="text-left font-normal text-gray-400 pb-4">Quantity</th>
                                <th class="text-left font-normal text-gray-400 pb-4">Total</th>
                                <th class="text-left font-normal text-gray-400 pb-4">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart_items as $item)
                                <tr wire:key="{{ $item['product_id'] }}" class="border-b">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 mr-4 rounded-md"
                                                src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                            <span class="font-normal text-gray-500">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-gray-500">{{ Number::currency($item['unit_amount'], 'CAD') }}
                                    </td>
                                    <td class="py-4 text-gray-500">{{ $item['quantity'] }}</td>
                                    <td class="py-4 text-gray-500">{{ Number::currency($item['total_amount'], 'CAD') }}
                                    </td>
                                    <td class="py-4">
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="bg-white border border-gray-300 rounded-md px-4 py-2 hover:bg-gray-100 text-gray-500">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-2xl font-normal text-gray-500">No
                                        items in cart</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/3">
                <div class="bg-white rounded-lg p-6">
                    <h2 class="text-xl font-normal mb-4">Summary</h2>
                    <div class="flex justify-between mb-2 text-gray-500">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($grand_total, 'CAD') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-500">
                        <span>Taxes</span>
                        <span>{{ Number::currency($grand_total * 0.13, 'CAD') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-500">
                        <span>Shipping</span>
                        <span>{{ Number::currency(0, 'CAD') }}</span>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between mb-4">
                        <span class="font-normal">Total</span>
                        <span class="font-normal">{{ Number::currency($grand_total * 1.13, 'CAD') }}</span>
                    </div>
                    @if ($cart_items)
                        <a href="/checkout"
                            class="bg-black text-white py-3 px-4 rounded-lg w-full hover:bg-gray-800 transition duration-300 inline-block text-center">
                            Checkout
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
