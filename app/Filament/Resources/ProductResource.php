<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Get;
use Filament\Forms\Components\Hidden;

/**
 * Product Variations Implementation Plan:
 *
 * 1. Database Schema:
 *    - [x] Modify the `products` table to include a `has_variations` boolean field.
 *    - [x] Create a new `product_variations` table to store variation details.
 *    - [x] Create a `variation_attributes` table to store attributes like color, size, etc.
 *
 * 2. Models:
 *    - [x] Update the `Product` model to include a relationship with `ProductVariation`.
 *    - [x] Create a `ProductVariation` model with relationships to `Product` and `VariationAttribute`.
 *    - [x] Create a `VariationAttribute` model.
 *
 * 3. Filament Resource:
 *    - [x] Update the `ProductResource` to include a new tab or section for managing variations.
 *    - [x] Create a repeater field for adding multiple variations with their respective attributes and stock.
 *    - [x] Implement logic to toggle the visibility of the variations section based on the `has_variations` field.
 *
 * 4. Product Details Page:
 *    - [ ] Modify the Livewire component to fetch and display product variations.
 *    - [ ] Create a set of buttons or dropdowns for selecting variation attributes.
 *    - [ ] Update the stock display and add-to-cart functionality to work with variations.
 *
 * 5. Stock Management:
 *    - [ ] Implement stock tracking at the variation level for products with variations.
 *    - [ ] For products without variations, continue using the existing stock field.
 *
 * 6. Cart and Checkout:
 *    - [ ] Update the cart management system to handle product variations.
 */

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                if ($operation !== 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),

                        TextInput::make('stock')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->hidden(fn(Get $get): bool => $get('has_variations')),

                        Hidden::make('stock')
                            ->default(0)
                            ->visible(fn(Get $get): bool => $get('has_variations')),

                    ])->columns(2),
                    Section::make("Images")->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->maxFiles(8)
                            ->reorderable()
                            ->disk('r2')
                            ->preserveFilenames()
                            ->required(),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('CAD')
                            ->hidden(fn(Get $get): bool => $get('has_variations')),

                        Hidden::make('price')
                            ->default(0)
                            ->visible(fn(Get $get): bool => $get('has_variations')),
                    ]),
                    Section::make('Associations')->schema([
                        Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                        Select::make('brand_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name')
                    ]),
                    Section::make("Status")->schema([
                        Toggle::make('has_variations')
                            ->label('Has Variations')
                            ->default(false)
                            ->reactive(),

                        Toggle::make('is_active')
                            ->required()
                            ->default(true),

                        Toggle::make('is_featured')
                            ->required(),

                        Toggle::make('on_sale')
                            ->required()
                    ])
                ])->columnSpan(1),
                Section::make('Variations')
                    ->schema([
                        Repeater::make('variations')
                            ->relationship()
                            ->schema([
                                TextInput::make('sku')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('CAD'),
                                TextInput::make('stock')
                                    ->numeric()
                                    ->required(),
                                Repeater::make('attributes')
                                    ->relationship()
                                    ->schema([
                                        Select::make('name')
                                            ->options([
                                                'apparel_type' => 'Apparel Type',
                                                'size' => 'Size',
                                            ])
                                            ->required(),
                                        TextInput::make('value')
                                            ->required(),
                                    ])
                                    ->columns(2)
                            ])
                    ])
                    ->visible(fn(Get $get): bool => $get('has_variations'))
                    ->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.0')
                    ->circular()
                    ->square()
                    ->extraImgAttributes(['class' => 'rounded-lg']),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->sortable(),

                TextColumn::make('price')
                    ->money('CAD')
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->boolean(),

                IconColumn::make('on_sale')
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),

                SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
            ])
            ->actions([
                ActionGroup::make(
                    [
                        ViewAction::make(),
                        EditAction::make(),
                        DeleteAction::make()
                    ]
                )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
