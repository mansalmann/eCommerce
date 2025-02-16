<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Product Infomation')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->afterStateUpdated(function(Set $set, $state)
                                    {
                                        $set('slug', Product::generateUniqueSlug($state));
                                    })
                                ->live(onBlur: true),
                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->maxLength(255)
                                ->readOnly(),
                            Forms\Components\MarkdownEditor::make('description')
                                ->columnSpanFull()
                                 ->disableToolbarButtons([
                                    'attachFiles',
                                ]),
                        ])->columns(2),

                        Forms\Components\Section::make('Product Image')
                        ->schema([
                            Forms\Components\FileUpload::make('images')
                                ->multiple()
                                ->maxFiles(5)
                                ->reorderable()
                                ->required()
                                ->acceptedFileTypes(['image/png','image/jpg','image/jpeg'])
                                ->rules(['mimes:png,jpeg,jpg'])
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    null,
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->imageEditorMode(2)
                                ->previewable(true)
                                
                                ->minSize(10)
                                ->maxSize(2048)
                                ->disk('public')
                                ->directory('product-images')
                                ->visibility('public'),
                        ]),

                    ])->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                    Forms\Components\Section::make('Product Price and Stock')
                        ->schema([
                            Forms\Components\TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->minValue(0)
                                ->prefix('Rp.'),
                            Forms\Components\TextInput::make('stock')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                            ]),
                    Forms\Components\Section::make('Product Associations')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name')
                            ->native(false),

                    Forms\Components\Section::make('Product Status')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')
                                ->required()
                                ->default(true),
                            Forms\Components\Toggle::make('is_featured')
                                ->required(),
                        ])
                    ])->columnSpan(1),
                        ])
                    ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                    ->before(function (Product $product) {
                        $product = Product::where('id', $product->id)->first(['id', 'images']);
                        foreach($product->images as $image){
                            if(Storage::disk('public')->exists($image)){
                                Storage::disk('public')->delete($image);
                            }
                        }
                    }),
                ]),
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
