<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ResepResource\Pages;
use App\Filament\Admin\Resources\ResepResource\RelationManagers;
use App\Models\Resep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResepResource extends Resource
{
    protected static ?string $model = Resep::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_resep')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kunjungan_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('dokter_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('pasien_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('obat_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\Textarea::make('aturan_pakai')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('harga_satuan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal_resep')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_resep')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kunjungan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dokter_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pasien_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('obat_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_satuan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_resep')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListReseps::route('/'),
            'create' => Pages\CreateResep::route('/create'),
            'edit' => Pages\EditResep::route('/{record}/edit'),
        ];
    }
}
