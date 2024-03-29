<?php

namespace App\Filament\Emp\Resources;

use App\Filament\Emp\Resources\VehiculeResource\Pages;
use App\Filament\Emp\Resources\VehiculeResource\RelationManagers;
use App\Models\Client;
use App\Models\Employe;
use App\Models\Vehicule;
use App\Models\Garage;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehiculeResource extends Resource
{
    protected static ?string $model = Vehicule::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getNavigationBadge(): ?string
    {
        // Obtenez l'ID de l'employé authentifié
        $employeId = auth()->user()->user_id;

        // Utilisez l'ID de l'employé pour trouver le garage correspondant
        $employe = Employe::find($employeId);

        // Vérifiez si un employé a été trouvé
        if ($employe) {
            // Obtenez l'ID du garage
            $garageId = $employe->garage_id;

            return parent::getEloquentQuery()
                ->where('garage_id', $garageId)
                ->count();
        }

        return '0';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('garage_id')
                    ->default(Garage::where('id', Employe::find(auth()->user()->user_id)->garage_id)->first()->id),
                Select::make('client_id')
                    ->label('Client')
                    ->options(Client::all()->pluck('tel', 'id'))
                    ->preload()
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable(isIndividual: true)
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
        // Obtenez l'ID de l'employé authentifié
        $employeId = auth()->user()->user_id;

        // Utilisez l'ID de l'employé pour trouver le garage correspondant
        $employe = Employe::find($employeId);

        // Vérifiez si un employé a été trouvé
        if ($employe) {
            // Obtenez l'ID du garage
            $garageId = $employe->garage_id;

            return parent::getEloquentQuery()
                ->where('garage_id', $garageId)
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }

        // Si aucun garage n'a été trouvé, retournez une requête vide
        return Vehicule::whereNull('id');
    }
}
