<x-filament::page>
    <form wire:submit="import">
        {{ $this->form }}
    </form>

    <div class="mt-4">
        <div class="prose dark:prose-invert">
            <h3>Instructions</h3>
            <ul>
                <li>Export your stock spreadsheet as a CSV file</li>
                <li>The system expects:
                    <ul>
                        <li>A column with header "slug" for product identification</li>
                        <li>A column with header "volume in stock" for the volume values</li>
                    </ul>
                </li>
                <li>The system will:
                    <ul>
                        <li>Skip empty rows automatically</li>
                        <li>Only update products that have volume enabled</li>
                        <li>Show a preview of changes before applying them</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    @if ($this->showPreview)
        <div class="mt-8 space-y-6">
            <!-- Headers Found -->
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">CSV Headers</h3>
                <div class="text-sm">
                    {{ implode(', ', $this->previewData['headers']) }}
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-700 dark:bg-green-900">
                    <h4 class="text-sm font-medium text-green-900 dark:text-green-100">To Update</h4>
                    <p class="mt-2 text-2xl font-bold text-green-900 dark:text-green-100">
                        {{ count($this->previewData['to_update']) }}</p>
                </div>
                <div
                    class="rounded-xl border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-700 dark:bg-yellow-900">
                    <h4 class="text-sm font-medium text-yellow-900 dark:text-yellow-100">Not Found</h4>
                    <p class="mt-2 text-2xl font-bold text-yellow-900 dark:text-yellow-100">
                        {{ count($this->previewData['not_found']) }}</p>
                </div>
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-700 dark:bg-red-900">
                    <h4 class="text-sm font-medium text-red-900 dark:text-red-100">Invalid</h4>
                    <p class="mt-2 text-2xl font-bold text-red-900 dark:text-red-100">
                        {{ count($this->previewData['invalid']) }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Empty</h4>
                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ count($this->previewData['empty']) }}</p>
                </div>
            </div>

            <!-- Products to Update -->
            @if (count($this->previewData['to_update']) > 0)
                <div class="rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-700 dark:bg-green-900">
                    <h3 class="text-lg font-medium text-green-900 dark:text-green-100 mb-4">Products to Update</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-green-200">
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Slug</th>
                                    <th class="px-4 py-2 text-left">Volume</th>
                                    <th class="px-4 py-2 text-left">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->previewData['to_update'] as $item)
                                    <tr class="border-b border-green-200">
                                        <td class="px-4 py-2">{{ $item['name'] }}</td>
                                        <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                        <td class="px-4 py-2 text-left">
                                            @if (isset($item['new_volume']))
                                                <div style="{{ $item['current_volume'] != $item['new_volume'] ? 'border: 2px solid #fbbf24; background-color: rgba(254, 243, 199, 0.2); border-radius: 0.25rem;' : '' }}"
                                                    class="px-2 py-1 inline-block">
                                                    {{ $item['current_volume'] ?? '-' }}g →
                                                    {{ $item['new_volume'] ?? '-' }}g
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            @if (!empty($item['price_updates']))
                                                <div class="space-y-1.5">
                                                    @foreach ($item['price_updates'] as $update)
                                                        @php
                                                            $currentPrice = (float) $update['current_price'];
                                                            $newPrice = (float) $update['new_price'];
                                                            $priceChanged = abs($currentPrice - $newPrice) >= 0.01;
                                                        @endphp
                                                        <div style="{{ $priceChanged ? 'border: 2px solid #fbbf24; background-color: rgba(254, 243, 199, 0.2); border-radius: 0.25rem;' : '' }}"
                                                            class="text-sm px-2 py-1">
                                                            {{ $update['volume'] }}g:
                                                            ${{ number_format($currentPrice, 2) }}
                                                            →
                                                            ${{ number_format($newPrice, 2) }}
                                                            <span class="text-xs text-gray-500">
                                                                ({{ $update['price_tier'] }} tier at
                                                                ${{ number_format($update['per_gram_price'], 2) }}/g)
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Not Found Products -->
            @if (count($this->previewData['not_found']) > 0)
                <div
                    class="rounded-xl border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-700 dark:bg-yellow-900">
                    <h3 class="text-lg font-medium text-yellow-900 dark:text-yellow-100 mb-4">Products Not Found</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-yellow-200">
                                    <th class="px-4 py-2 text-left">Row</th>
                                    <th class="px-4 py-2 text-left">Slug</th>
                                    <th class="px-4 py-2 text-right">Volume</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->previewData['not_found'] as $item)
                                    <tr class="border-b border-yellow-200">
                                        <td class="px-4 py-2">{{ $item['row'] }}</td>
                                        <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                        <td class="px-4 py-2 text-right">{{ $item['volume'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Invalid Entries -->
            @if (count($this->previewData['invalid']) > 0)
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-700 dark:bg-red-900">
                    <h3 class="text-lg font-medium text-red-900 dark:text-red-100 mb-4">Invalid Entries</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-red-200">
                                    <th class="px-4 py-2 text-left">Row</th>
                                    <th class="px-4 py-2 text-left">Slug</th>
                                    <th class="px-4 py-2 text-right">Value</th>
                                    <th class="px-4 py-2 text-left">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->previewData['invalid'] as $item)
                                    <tr class="border-b border-red-200">
                                        <td class="px-4 py-2">{{ $item['row'] }}</td>
                                        <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                        <td class="px-4 py-2 text-right">
                                            @if (isset($item['volume']))
                                                {{ $item['volume'] }}g
                                            @else
                                                {{ $item['price'] ?? '-' }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">{{ $item['reason'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Empty Entries -->
            @if (count($this->previewData['empty']) > 0)
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Empty Entries</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-2 text-left">Row</th>
                                    <th class="px-4 py-2 text-left">Slug</th>
                                    <th class="px-4 py-2 text-left">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->previewData['empty'] as $item)
                                    <tr class="border-b border-gray-200">
                                        <td class="px-4 py-2">{{ $item['row'] }}</td>
                                        <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                        <td class="px-4 py-2">{{ $item['reason'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="flex justify-end space-x-4">
                <x-filament::button wire:click="$set('showPreview', false)" color="gray">
                    Cancel
                </x-filament::button>

                <x-filament::button wire:click="import" color="success" :disabled="empty($this->previewData['to_update'])">
                    Import {{ count($this->previewData['to_update']) }} Products
                </x-filament::button>
            </div>
        </div>
    @endif
</x-filament::page>
