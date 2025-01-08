<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Get;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Post Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $state, Forms\Set $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Toggle to show/hide this post on the blog'),
                        Forms\Components\Toggle::make('show_title')
                            ->label('Show Title')
                            ->default(true)
                            ->helperText('Toggle to show/hide the title on the blog post'),
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publication Date')
                                    ->default(now())
                                    ->required(),
                                Forms\Components\DateTimePicker::make('last_edited_at')
                                    ->label('Last Edited')
                                    ->helperText('Optional - will be set automatically on update')
                                    ->nullable(),
                            ])->columns(2),
                        Forms\Components\Select::make('blog_category_id')
                            ->relationship('category', 'name')
                            ->label('Category')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->label('Related Product')
                            ->searchable()
                            ->preload()
                            ->helperText('Optional - Select a product this post is about. If selected, product images will be used instead of blog images.')
                            ->live()
                            ->nullable(),
                    ])->columns(2),
                Forms\Components\FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->directory('blog-images')
                    ->imageResizeMode('contain')
                    ->preserveFilenames()
                    ->hidden(fn(Get $get): bool => filled($get('product_id'))),
                Forms\Components\RichEditor::make('body')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('blog-content')
                    ->fileAttachmentsVisibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),
                Tables\Columns\ToggleColumn::make('show_title')
                    ->label('Show Title'),
                Tables\Columns\ImageColumn::make('images')
                    ->circular(false)
                    ->stacked()
                    ->limit(3)
                    ->getStateUsing(function ($record): array {
                        if ($record->product_id) {
                            return $record->product?->images ?? [];
                        }
                        return $record->images ?? [];
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_edited_at')
                    ->dateTime()
                    ->label('Last Edited')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('blog_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
