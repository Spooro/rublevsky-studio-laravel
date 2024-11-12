<div class="w-full px-4 pt-4 pb-36 no-scrollbar">
    <div class="">
        <h2 class=" mb-8" heading-reveal>Shopping Cart</h2>
        <div class="flex flex-col md:flex-row gap-14">
            <div class="md:w-2/3">
                <div class="bg-white overflow-x-auto rounded-lg mb-4">
                    @forelse ($cart_items as $item)
                        <div wire:key="{{ $item['product_id'] . '-' . ($item['variation_id'] ?? '') }}"
                            class="flex items-start justify-between py-4 border-b">
                            <div class="flex items-start flex-grow pr-4">
                                <img class="w-24 h-auto object-cover mr-4 rounded-md"
                                    src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}">
                                <div>
                                    <span class="font-normal text-gray-800">{{ $item['name'] }}</span>
                                    @if (isset($item['coming_soon']) && $item['coming_soon'])
                                        <span
                                            class="ml-2 inline-block px-2 py-1 text-xs bg-gray-100 text-black rounded">Pre-order</span>
                                    @endif
                                    @if (isset($item['attributes']))
                                        <div class="text-sm text-gray-400 mt-1">
                                            @foreach ($item['attributes'] as $attribute => $value)
                                                <span class="inline-block mr-3">{{ $value }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="text-sm text-gray-400 mt-1">
                                        {{ Number::currency($item['unit_amount'], 'CAD') }}
                                    </div>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <button
                                            wire:click="decreaseQty({{ $item['product_id'] }}, {{ isset($item['variation_id']) ? $item['variation_id'] : 'null' }})"
                                            class="w-8 h-8 flex items-center justify-center text-lg hover:bg-gray-100 rounded-full transition duration-300 ease-in-out">-</button>
                                        <span class="text-lg">{{ $item['quantity'] }}</span>
                                        <button
                                            wire:click="increaseQty({{ $item['product_id'] }}, {{ isset($item['variation_id']) ? $item['variation_id'] : 'null' }})"
                                            class="w-8 h-8 flex items-center justify-center text-lg hover:bg-gray-100 rounded-full transition duration-300 ease-in-out">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <button
                                    wire:click="removeItem({{ $item['product_id'] }}, {{ isset($item['variation_id']) ? $item['variation_id'] : 'null' }})"
                                    class="group inline-flex items-center justify-center p-1 rounded-xl hover:bg-black transition-colors duration-200 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.8rem" height="1.8rem"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round" class="group-hover:stroke-white">
                                        <path d="M18 6L6 18M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <span
                                    class="font-semibold text-black text-lg">{{ Number::currency($item['total_amount'], 'CAD') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-2xl font-normal text-gray-500">No items in cart</div>
                    @endforelse
                </div>
            </div>
            <div class="md:w-1/3 sm:w-full">
                <div class="bg-white rounded-lg sticky top-4">
                    <h2 class="text-xl font-normal mb-4">Summary</h2>
                    <div class="flex justify-between mb-2 text-gray-500">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($grand_total, 'CAD') }}</span>
                    </div>
                    {{-- <div class="flex justify-between mb-2 text-gray-500">
                        <span>Taxes</span>
                        <span>{{ Number::currency($grand_total * 0.13, 'CAD') }}</span>
                    </div> --}}
                    <div class="flex justify-between mb-2 text-gray-500">
                        <span>Shipping</span>
                        <span class="ml-4 text-right">To be discussed after order</span>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between mb-4">
                        <span class="font-normal">Total</span>
                        <span class="font-normal">{{ Number::currency($grand_total, 'CAD') }}</span>
                    </div>
                    @if ($cart_items)
                        <a href="/checkout" class="main-button w-full">
                            Checkout
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
