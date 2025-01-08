<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Filament\Forms\Components\View;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Log;

class ImportStock extends Page
{
    use WithFileUploads;

    protected static string $resource = ProductResource::class;

    protected static string $view = 'filament.resources.product-resource.pages.import-stock';


    public $csv_file;
    public array $previewData = [];
    public bool $showPreview = false;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Import Stock')
                    ->description('Upload a CSV file containing product stock data. The first row should contain the headers, including "slug" and "volume in stock" columns.')
                    ->schema([
                        FileUpload::make('csv_file')
                            ->label('CSV File')
                            ->required()
                            ->acceptedFileTypes(['text/csv'])
                            ->maxSize(5120)
                            ->live()
                            ->afterStateUpdated(function ($state) {
                                if (!empty($state)) {
                                    $this->processPreview();
                                }
                            }),
                    ]),
            ]);
    }

    protected function processPreview(): void
    {
        try {
            // Reset preview data
            $this->previewData = [
                'headers' => [],
                'to_update' => [],
                'not_found' => [],
                'invalid' => [],
                'empty' => [],
            ];

            if (empty($this->csv_file)) {
                throw new \Exception('No file uploaded');
            }

            // Get the temporary file
            $file = is_array($this->csv_file) ? reset($this->csv_file) : $this->csv_file;

            // Ensure we have a TemporaryUploadedFile
            if (!$file instanceof TemporaryUploadedFile) {
                throw new \Exception('Invalid file upload');
            }

            // Open the file using the correct storage path
            $filePath = storage_path('app/livewire-tmp/' . $file->getFilename());
            if (!file_exists($filePath)) {
                throw new \Exception('File not found at: ' . $filePath);
            }

            $handle = fopen($filePath, 'r');
            if ($handle === false) {
                throw new \Exception('Unable to open file for reading');
            }

            // Read headers from the first row
            $headers = fgetcsv($handle);
            if (!$headers) {
                fclose($handle);
                throw new \Exception('Empty CSV file');
            }

            // Clean and normalize headers
            $headers = array_map(function ($header) {
                return trim(strtolower($header));
            }, $headers);

            // Store headers for display
            $this->previewData['headers'] = $headers;

            // Find column indices
            $slugIndex = array_search('slug', $headers);
            $volumeIndex = array_search('volume in stock', $headers);

            // Find price columns (they should end with 'g+')
            $priceColumns = [];
            foreach ($headers as $index => $header) {
                if (preg_match('/^(\d+)g\+$/', $header, $matches)) {
                    $priceColumns[$matches[1]] = $index;
                }
            }

            if ($slugIndex === false) {
                fclose($handle);
                throw new \Exception('Required column "slug" not found in the first row');
            }

            // Process data rows
            $rowNumber = 1;
            while (($row = fgetcsv($handle)) !== false) {
                $rowNumber++;

                // Skip if we don't have enough columns
                if (count($row) <= $slugIndex) {
                    continue;
                }

                $slug = trim($row[$slugIndex] ?? '');
                $volume = $volumeIndex !== false ? trim($row[$volumeIndex] ?? '') : null;

                if (empty($slug)) continue;

                $product = Product::where('slug', $slug)->first();

                if (!$product) {
                    $this->previewData['not_found'][] = [
                        'slug' => $slug,
                        'volume' => $volume,
                        'row' => $rowNumber
                    ];
                    continue;
                }

                $updateData = [
                    'slug' => $slug,
                    'name' => $product->name,
                    'row' => $rowNumber,
                    'price_updates' => [],
                ];

                // Handle volume update if column exists
                if ($volumeIndex !== false) {
                    if (empty($volume)) {
                        $this->previewData['empty'][] = [
                            'slug' => $slug,
                            'reason' => 'No volume value',
                            'row' => $rowNumber
                        ];
                        continue;
                    }

                    if (!is_numeric($volume) || $volume < 0) {
                        $this->previewData['invalid'][] = [
                            'slug' => $slug,
                            'volume' => $volume,
                            'reason' => 'Invalid volume value',
                            'row' => $rowNumber
                        ];
                        continue;
                    }

                    if (!$product->has_volume) {
                        $this->previewData['invalid'][] = [
                            'slug' => $slug,
                            'volume' => $volume,
                            'reason' => 'Volume not enabled for this product',
                            'row' => $rowNumber
                        ];
                        continue;
                    }

                    $updateData['current_volume'] = $product->volume;
                    $updateData['new_volume'] = (float) $volume;
                }

                // Handle price updates
                if (!empty($priceColumns)) {
                    $variations = $product->variations()
                        ->with(['attributes' => function ($query) {
                            $query->where('name', 'volume');
                        }])
                        ->get();

                    foreach ($variations as $variation) {
                        $variationVolume = $variation->attributes->first()?->value;
                        if (!$variationVolume) continue;

                        // Find the applicable price tier
                        $applicableTier = null;
                        $applicablePrice = null;

                        // Sort price columns by volume in ascending order
                        ksort($priceColumns);

                        // Find the appropriate price tier for this variation
                        foreach ($priceColumns as $tierVolume => $columnIndex) {
                            $price = trim($row[$columnIndex] ?? '');
                            if (empty($price)) continue;

                            if ((int)$variationVolume >= (int)$tierVolume) {
                                $applicableTier = $tierVolume;
                                $applicablePrice = $price;
                            }
                        }

                        if ($applicablePrice) {
                            // Clean the price value
                            $cleanPrice = preg_replace('/[^0-9.]/', '', $applicablePrice);

                            if (!is_numeric($cleanPrice) || $cleanPrice < 0) {
                                $this->previewData['invalid'][] = [
                                    'slug' => $slug,
                                    'reason' => "Invalid price value for {$applicableTier}g+ tier",
                                    'row' => $rowNumber,
                                    'price' => $applicablePrice
                                ];
                                continue;
                            }

                            // Calculate the final price by multiplying per-gram price by variation volume
                            $perGramPrice = (float) $cleanPrice;
                            $finalPrice = $perGramPrice * (float) $variationVolume;

                            $updateData['price_updates'][] = [
                                'volume' => $variationVolume,
                                'current_price' => (float) $variation->price,
                                'new_price' => round($finalPrice, 2),
                                'variation_id' => $variation->id,
                                'price_tier' => "{$applicableTier}g+",
                                'per_gram_price' => $perGramPrice
                            ];
                        }
                    }
                }

                if (!empty($updateData['new_volume']) || !empty($updateData['price_updates'])) {
                    $this->previewData['to_update'][] = $updateData;
                }
            }

            fclose($handle);

            if (
                empty($this->previewData['to_update']) &&
                empty($this->previewData['not_found']) &&
                empty($this->previewData['invalid']) &&
                empty($this->previewData['empty'])
            ) {
                throw new \Exception('No valid data found in the CSV file');
            }

            $this->showPreview = true;

            Notification::make()
                ->title('Preview Ready')
                ->body(sprintf(
                    "Found:\n%d products to update\n%d products not found\n%d invalid entries\n%d empty entries",
                    count($this->previewData['to_update']),
                    count($this->previewData['not_found']),
                    count($this->previewData['invalid']),
                    count($this->previewData['empty'])
                ))
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error Processing File')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function import()
    {
        try {
            if (empty($this->previewData['to_update'])) {
                Notification::make()
                    ->title('No Valid Updates')
                    ->warning()
                    ->send();
                return;
            }

            $updated = 0;
            $priceUpdates = 0;

            foreach ($this->previewData['to_update'] as $item) {
                $product = Product::where('slug', $item['slug'])->first();
                if ($product) {
                    // Update volume if present
                    if (isset($item['new_volume'])) {
                        $product->volume = $item['new_volume'];
                        $product->save();
                        $updated++;
                    }

                    // Update prices if present
                    if (!empty($item['price_updates'])) {
                        foreach ($item['price_updates'] as $priceUpdate) {
                            $variation = $product->variations()->find($priceUpdate['variation_id']);
                            if ($variation) {
                                $variation->price = $priceUpdate['new_price'];
                                $variation->save();
                                $priceUpdates++;
                            }
                        }
                    }
                }
            }

            Notification::make()
                ->title('Import Complete')
                ->body("Successfully updated {$updated} volumes and {$priceUpdates} prices")
                ->success()
                ->send();

            $this->reset(['csv_file', 'previewData', 'showPreview']);
        } catch (\Exception $e) {
            Notification::make()
                ->title('Import Failed')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function getTitle(): string
    {
        return 'Import Stock';
    }
}
