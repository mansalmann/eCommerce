<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Order Information')
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                ->label('Customer')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->native(false),
                                Forms\Components\Select::make('payment_method')
                                ->options([
                                    'COD' => 'Cash on Delivery',
                                    'transfer_bank' => 'Transfer Bank'
                                    ])
                                ->required()
                                ->native(false),
                                Forms\Components\Select::make('payment_status')
                                ->options([
                                    'pending' => 'pending',
                                    'paid' => 'paid',
                                    'failed' => 'failed'
                                ])
                                ->required()
                                ->native(false)
                                ->default('pending'),
                            ])                    
                        ])->columnSpanFull(),
                Forms\Components\TextInput::make('grand_total')
                    ->numeric()
                    ->default(0),
                
                Forms\Components\ToggleButtons::make('status')
                    ->inline()
                    ->default('new')
                    ->required()
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled'
                    ])
                    ->colors([
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'canceled' => 'danger'
                    ]),
                Forms\Components\TextArea::make('notes')
                    ->maxLength(255),
                Forms\Components\Section::make('Order Items')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('product_id')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->reactive()
                                ->native(false)
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(4)
                                ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0 ))
                                ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0 )),
                            Forms\Components\TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->columnSpan(2)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set ('total_amount', $state * $get('unit_amount'))), 
                            Forms\Components\TextInput::make('unit_amount')
                                    ->numeric()
                                    ->required()
                                    ->readOnly()
                                    ->minValue(1)
                                    ->dehydrated()
                                    ->columnSpan(3),
                            Forms\Components\TextInput::make('total_amount')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0)
                                    ->dehydrated()
                                    ->readOnly()
                                    ->columnSpan(3)
                        ])->columns(12),

                            Forms\Components\Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total')
                            ->content(function (Get $get, Set $set){
                                $total = 0;
                                if(!$repeaters = $get('items')){
                                    return $total;
                                }

                                foreach ($repeaters as $key => $repeater) {
                                    $total += $get("items.{$key}.total_amount");
                                }
                                    $set('grand_total', $total);
                                    return "Rp. " . number_format($total, '0', ',', '.');
                            }),

                            Forms\Components\Hidden::make('grand_total')
                                ->default(0)

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grand_total')
                    ->numeric()
                    ->sortable()
                    ->money('IDR', locale: 'id'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled'
                    ])
                    ->searchable()
                    ->sortable(),
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
                    Tables\Actions\DeleteAction::make(),
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
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger'; // Warna badge
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
