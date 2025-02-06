<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('transaction_code')
                    ->required()
                    ->label('Kode Transaksi')
                    ->placeholder('Input Kode Transaksi'),
                Select::make('customer_id')
                    ->relationship('customer', 'customer_name')
                    ->required()
                    ->label('Customer')
                    ->native(false),
                Select::make('product_id')
                    ->relationship('product', 'product_name')
                    ->required()
                    ->label('Produk')
                    ->native(false),
                TextInput::make('quantity')
                    ->required()
                    ->label('Quantity')
                    ->placeholder('Input Quantity')
                    ->numeric(),
                TextInput::make('total_price')
                    ->required()
                    ->label('Total Harga')
                    ->placeholder('Input Total Harga')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_code')
                    ->searchable()
                    ->label('Kode Transaksi'),
                TextColumn::make('customer.customer_name')
                    ->searchable()
                    ->label('Customer'),
                TextColumn::make('product.product_name')
                    ->searchable()
                    ->label('Produk'),
                TextColumn::make('quantity')
                    ->searchable()
                    ->label('Quantity'),
                TextColumn::make('total_price')
                    ->searchable()
                    ->label('Total Harga')
                    ->money('IDR', locale: 'id-ID'),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTransactions::route('/'),
        ];
    }
}
