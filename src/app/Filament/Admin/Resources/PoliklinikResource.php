<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PoliklinikResource\Pages;
use App\Filament\Admin\Resources\PoliklinikResource\RelationManagers;
use App\Models\Poliklinik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PoliklinikResource extends Resource
{
    protected static ?string $model = Poliklinik::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('rumah_sakit_id')
                    ->relationship('rumahSakit', 'id')
                    ->required(),
                Forms\Components\TextInput::make('kode_poliklinik')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama_poliklinik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lantai')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('gedung')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rumahSakit.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_poliklinik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_poliklinik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lantai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gedung')
                    ->searchable(),
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
            'index' => Pages\ListPolikliniks::route('/'),
            'create' => Pages\CreatePoliklinik::route('/create'),
            'edit' => Pages\EditPoliklinik::route('/{record}/edit'),
        ];
    }
}
