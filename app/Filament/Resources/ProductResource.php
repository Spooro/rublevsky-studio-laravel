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
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Storage;

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
                                $set('slug', Str::slug($state));
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
                            ->hidden(fn(Get $get): bool => (bool) $get('has_variations') || (bool) $get('unlimited_stock')),

                    ])->columns(2),
                    Section::make("Images")->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->maxFiles(8)
                            ->reorderable()
                            ->disk('r2')
                            ->preserveFilenames()
                            ->required()
                            ->deleteUploadedFileUsing(function ($file) {
                                // Delete file from R2 when removed through the form
                                Storage::disk('r2')->delete($file);
                            }),
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->required(fn(Get $get): bool => !$get('has_variations')) // Only required if no variations
                            ->prefix('CAD')
                            ->hidden(fn(Get $get): bool => $get('has_variations')),

                        TextInput::make('volume')
                            ->required(fn(Get $get): bool => $get('has_volume'))
                            ->hidden(fn(Get $get): bool => !$get('has_volume') || $get('has_variations')),

                        Placeholder::make('price_instruction')
                            ->content('For products with variations, please set prices in the Variations section below.')
                            ->visible(fn(Get $get): bool => $get('has_variations'))
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

                        Toggle::make('has_volume')
                            ->label('Has Volume')
                            ->default(false)
                            ->reactive(),

                        Toggle::make('is_active')
                            ->required()
                            ->default(true),

                        Toggle::make('is_featured')
                            ->required(),

                        Toggle::make('on_sale')
                            ->required(),

                        Toggle::make('unlimited_stock')
                            ->label('Unlimited Stock')
                            ->default(false)
                            ->reactive(),

                        Toggle::make('coming_soon')
                            ->label('Coming Soon')
                            ->default(false),
                    ])
                ])->columnSpan(1),
                Section::make('Variations')
                    ->schema([
                        Repeater::make('variations')
                            ->relationship()
                            ->reorderable()
                            ->reorderableWithButtons()
                            ->orderColumn('sort')
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
                                    ->default(0)
                                    ->hidden(function (Get $get): bool {
                                        return (bool) $get('../../unlimited_stock');
                                    }),
                                Repeater::make('attributes')
                                    ->relationship()
                                    ->schema([
                                        Select::make('name')
                                            ->options([
                                                'apparel_type' => 'Apparel Type',
                                                'size' => 'Size cm',
                                                'apparel_size' => 'Size',
                                                'color' => 'Color',
                                                'volume' => 'Volume g',
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

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'description'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
