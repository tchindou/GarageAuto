<?php

namespace App\Filament\Gerant\Widgets;

use App\Filament\Resources\ReservationResource;
use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Intervention;
use App\Models\Garage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class XlatestRsvts extends BaseWidget
{

    protected static ?string $heading = 'Dernieres interventions';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function getUserNameAttribute()
    {
        return $this->user->nom;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Intervention::with(['garage', 'vehicule', 'tache'])->latest())
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at')
            ->columns([
                Tables\Columns\TextColumn::make('vehicule.marque')
                    ->label('Véhicule')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicule.modele')
                    ->label('Modèle')
                    ->sortable(),
                Tables\Columns\TextColumn::make('garage.name')
                    ->label('Garage')
                    ->sortable(),
                Tables\Columns\TextColumn::make('garage.gerant.name')
                    ->label('Gérant')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tache.status')
                    ->label('Tâche')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tache.description')
                    ->label('Description de la tâche')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date('j M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('j M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('j M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime('j M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [];
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
        return Intervention::whereNull('id');
    }
}
