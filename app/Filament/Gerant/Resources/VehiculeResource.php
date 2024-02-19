<?php

namespace App\Filament\Gerant\Resources;

use App\Filament\Gerant\Resources\VehiculeResource\Pages;
use App\Filament\Gerant\Resources\VehiculeResource\RelationManagers;
use App\Models\Vehicule;
use App\Models\Garage;
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

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getNavigationBadge(): ?string
    {
        // Obtenez l'ID du gérant authentifié
        $gerantId = auth()->user()->user_id;

        // Utilisez l'ID du gérant pour trouver le garage correspondant
        $garages = Garage::where('gerant_id', $gerantId)->get();

        // Vérifiez si un garage a été trouvé
        if ($garages->isNotEmpty()) {
            // Obtenez l'ID du garage
            $garageIds = $garages->pluck('id')->toArray();

            return (string) parent::getEloquentQuery()
                ->whereIn('garage_id', $garageIds)
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ])->count();
        }

        return '0';
    }

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
        // Obtenez l'ID du gérant authentifié
        $gerantId = auth()->user()->user_id;

        // Utilisez l'ID du gérant pour trouver le garage correspondant
        $garages = Garage::where('gerant_id', $gerantId)->get();

        // Vérifiez si un garage a été trouvé
        if ($garages->isNotEmpty()) {
            // Obtenez l'ID du garage
            $garageIds = $garages->pluck('id')->toArray();

            return parent::getEloquentQuery()
                ->whereIn('garage_id', $garageIds)
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }

        // Si aucun garage n'a été trouvé, retournez une requête vide
        return Vehicule::whereNull('id');
    }
}
