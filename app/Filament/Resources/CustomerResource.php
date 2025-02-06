<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Customer';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('customer_name')
                    ->required()
                    ->label('Nama Customer')
                    ->placeholder('Input Nama Customer'),
                TextInput::make('customer_email')
                    ->required()
                    ->label('Email Customer')
                    ->placeholder('Input Email Customer'),
                TextInput::make('customer_phone')
                    ->required()
                    ->label('Nomor Telepon Customer')
                    ->placeholder('Input Nomor Telepon Customer'),
                TextInput::make('customer_address')
                    ->required()
                    ->label('Alamat Customer')
                    ->placeholder('Input Alamat Customer'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->searchable()
                    ->label('Nama Customer'),
                TextColumn::make('customer_email')
                    ->searchable()
                    ->label('Email Customer'),
                TextColumn::make('customer_phone')
                    ->searchable()
                    ->label('Nomor Telepon Customer'),
                TextColumn::make('customer_address')
                    ->searchable()
                    ->label('Alamat Customer'),
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
            'index' => Pages\ManageCustomers::route('/'),
        ];
    }
}
