<div class=" mx-auto pt-4 pb-36 px-4">
    <h2 class="mb-8" heading-reveal>Checkout</h2>

    <form wire:submit.prevent="placeOrder">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <!--
                    <h2 class="text-2xl font-semibold mb-4">Select Payment Method</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" wireclick="$set('payment_method', 'cod')"
                            class="border rounded-lg p-4 flex items-center justify-center cursor-pointer  $payment_method === 'cod' ? 'bg-gray-200' : 'bg-white' ">
                            Cash on Delivery
                        </button>
                        <button type="button" wireclick="$set('payment_method', 'stripe')"
                        class="border rounded-lg p-4 flex items-center justify-center cursor-pointer $payment_method === 'stripe' ? 'bg-gray-200' : 'bg-white' ">
                            Stripe
                        </button>
                    </div>
                    error('payment_method')
                        <span class="text-red-500 text-sm mt-1"> $message </span>
                    enderror
                    -->

                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold mb-4">Payment Information</h2>
                        <p>You will be contacted regarding payment options after placing your
                            order.</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mb-4">Delivery details</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">First Name</label>
                            <input wire:model.defer="first_name" type="text"
                                class="w-full border rounded-lg p-2 @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Last Name</label>
                            <input wire:model.defer="last_name" type="text"
                                class="w-full border rounded-lg p-2 @error('last_name') border-red-500 @enderror">
                            @error('last_name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block mb-1">Email</label>
                            <input wire:model.defer="email" type="email"
                                class="w-full border rounded-lg p-2 @error('email') border-red-500 @enderror">
                            @error('email')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1">Phone</label>
                            <input wire:model.defer="phone" type="text"
                                class="w-full border rounded-lg p-2 @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="block mb-1">Address</label>
                            <input wire:model.defer="street_address" type="text"
                                class="w-full border rounded-lg p-2 @error('street_address') border-red-500 @enderror">
                            @error('street_address')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1">State</label>
                            <input wire:model.defer="state" type="text"
                                class="w-full border rounded-lg p-2 @error('state') border-red-500 @enderror">
                            @error('state')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1">City</label>
                            <input wire:model.defer="city" type="text"
                                class="w-full border rounded-lg p-2 @error('city') border-red-500 @enderror">
                            @error('city')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Country</label>
                            <input wire:model.defer="country" type="text"
                                class="w-full border rounded-lg p-2 @error('country') border-red-500 @enderror">
                            @error('country')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1">ZIP code</label>
                            <input wire:model.defer="zip_code" type="text"
                                class="w-full border rounded-lg p-2 @error('zip_code') border-red-500 @enderror">
                            @error('zip_code')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-gray-100 rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Summary</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>{{ Number::currency($grand_total, 'CAD') }}</span>
                        </div>
                        {{-- <div class="flex justify-between">
                            <span>Taxes</span>
                            <span>{{ Number::currency(0, 'CAD') }}</span>
                        </div> --}}
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>To be discussed after order</span>
                        </div>
                        <div class="flex justify-between text-2xl font-bold mt-4 pt-4 border-t">
                            <span>Total</span>
                            <span>{{ Number::currency($grand_total, 'CAD') }}</span>
                        </div>
                    </div>
                    <button type="submit" class="w-full main-button mt-6">
                        Place Order
                    </button>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                    <ul class="space-y-4">
                        @foreach ($cart_items as $ci)
                            <li class="flex items-center">
                                <img src="{{ Storage::url($ci['image']) }}" alt="{{ $ci['name'] }}"
                                    class="w-16 h-auto rounded-lg mr-4 object-cover">
                                <div class="flex-grow">
                                    <h6 class="font-semibold">{{ $ci['name'] }}</h6>
                                    @if (isset($ci['attributes']))
                                        <div class="text-sm text-gray-600 mt-1">
                                            @foreach ($ci['attributes'] as $attribute => $value)
                                                <span class="inline-block mr-3">{{ $value }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <p class="text-gray-600">Quantity: {{ $ci['quantity'] }}</p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span>{{ Number::currency($ci['total_amount'], 'CAD') }}</span>
                                    @if (isset($ci['coming_soon']) && $ci['coming_soon'])
                                        <span
                                            class="mt-2 inline-block px-2 py-1 text-xs bg-gray-100 text-black rounded">Pre-order</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
