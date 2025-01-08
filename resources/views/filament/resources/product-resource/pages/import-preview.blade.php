@if ($this->showPreview)
    <div class="mt-8 space-y-6">
        <!-- Debug Information -->
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-4 dark:border-blue-700 dark:bg-blue-900">
            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">CSV Processing Results</h3>
            <div class="space-y-4">
                <div class="mt-2 text-sm">
                    <p><strong>Headers Found:</strong>
                        {{ implode(', ', $this->previewData['debug_info']['headers'] ?? []) }}</p>
                    <p><strong>Total Rows:</strong>
                        {{ count($this->previewData['debug_info']['processed_rows'] ?? []) }}</p>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-700 dark:bg-green-900">
                <h4 class="text-sm font-medium text-green-900 dark:text-green-100">Valid Updates</h4>
                <p class="mt-2 text-2xl font-bold text-green-900 dark:text-green-100">
                    {{ count($this->previewData['to_update']) }}</p>
            </div>
            <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-700 dark:bg-yellow-900">
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
                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Empty Volume</h4>
                <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                    {{ count($this->previewData['empty']) }}</p>
            </div>
        </div>

        <!-- All Entries Table -->
        <div class="rounded-xl border border-gray-200 p-4 dark:border-gray-700">
            <h3 class="text-lg font-medium mb-4">All Entries</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Line</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Slug</th>
                            <th class="px-4 py-2 text-right">Current Volume</th>
                            <th class="px-4 py-2 text-right">New Volume</th>
                            <th class="px-4 py-2 text-left">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->previewData['to_update'] as $item)
                            <tr class="border-b bg-green-50">
                                <td class="px-4 py-2">{{ $item['line'] }}</td>
                                <td class="px-4 py-2"><span
                                        class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Valid</span>
                                </td>
                                <td class="px-4 py-2">{{ $item['name'] }}</td>
                                <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                <td class="px-4 py-2 text-right">{{ $item['current_volume'] }}g</td>
                                <td class="px-4 py-2 text-right">{{ $item['new_volume'] }}g</td>
                                <td class="px-4 py-2 text-green-700">Will be updated</td>
                            </tr>
                        @endforeach

                        @foreach ($this->previewData['not_found'] as $item)
                            <tr class="border-b bg-yellow-50">
                                <td class="px-4 py-2">{{ $item['line'] }}</td>
                                <td class="px-4 py-2"><span
                                        class="inline-flex items-center rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-700">Not
                                        Found</span></td>
                                <td class="px-4 py-2">-</td>
                                <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                <td class="px-4 py-2 text-right">-</td>
                                <td class="px-4 py-2 text-right">{{ $item['volume'] }}g</td>
                                <td class="px-4 py-2 text-yellow-700">Product not found in database</td>
                            </tr>
                        @endforeach

                        @foreach ($this->previewData['invalid'] as $item)
                            <tr class="border-b bg-red-50">
                                <td class="px-4 py-2">{{ $item['line'] }}</td>
                                <td class="px-4 py-2"><span
                                        class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">Invalid</span>
                                </td>
                                <td class="px-4 py-2">-</td>
                                <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                <td class="px-4 py-2 text-right">-</td>
                                <td class="px-4 py-2 text-right">{{ $item['volume'] }}</td>
                                <td class="px-4 py-2 text-red-700">{{ $item['reason'] }}</td>
                            </tr>
                        @endforeach

                        @foreach ($this->previewData['empty'] as $item)
                            <tr class="border-b bg-gray-50">
                                <td class="px-4 py-2">{{ $item['line'] }}</td>
                                <td class="px-4 py-2"><span
                                        class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-700">Empty</span>
                                </td>
                                <td class="px-4 py-2">-</td>
                                <td class="px-4 py-2 font-mono text-xs">{{ $item['slug'] }}</td>
                                <td class="px-4 py-2 text-right">-</td>
                                <td class="px-4 py-2 text-right">-</td>
                                <td class="px-4 py-2 text-gray-700">{{ $item['reason'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <x-filament::button color="gray" wire:click="cancelImport">
                Cancel
            </x-filament::button>

            <x-filament::button type="submit" wire:click="import" @class([
                'opacity-50 cursor-not-allowed' => empty($this->previewData['to_update']),
            ])
                @disabled(empty($this->previewData['to_update']))>
                Confirm Import ({{ count($this->previewData['to_update']) }} items)
            </x-filament::button>
        </div>
    </div>
@endif
