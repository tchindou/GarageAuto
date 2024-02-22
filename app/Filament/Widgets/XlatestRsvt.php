<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ReservationResource;
use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Intervention;
use App\Models\Reservation;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class XlatestRsvt extends BaseWidget
{

    protected static ?string $heading = 'Dernieres reservations';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function getUserNameAttribute()
    {
        return $this->user->nom;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Intervention::latest()->take(10))
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
        $user = Auth::user();
        if ($user->type == 'admin') {
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }

        return Intervention::whereNull('id');
    }
}
