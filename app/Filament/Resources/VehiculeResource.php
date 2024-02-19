<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehiculeResource\Pages;
use App\Filament\Resources\VehiculeResource\RelationManagers;
use App\Models\Vehicule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehiculeResource extends Resource
{
    protected static ?string $model = Vehicule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('garage_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('client_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('marque')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('modele')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('plaque')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('garage_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('marque')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modele')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plaque')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListVehicules::route('/'),
            'create' => Pages\CreateVehicule::route('/create'),
            'edit' => Pages\EditVehicule::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
