<?php

namespace App\Filament\Gerant\Resources;

use App\Filament\Gerant\Resources\InterventionResource\Pages;
use App\Filament\Gerant\Resources\InterventionResource\RelationManagers;
use App\Models\Intervention;
use App\Models\Garage;
use App\Models\Tache;
use App\Models\Vehicule;
use App\Models\Facture;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class InterventionResource extends Resource
{
    protected static ?string $model = Intervention::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

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
                ->count();
        }

        return '0';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('vehicule_id')
                    ->label('Vehicule')
                    ->options(Vehicule::where('garage_id', Garage::where('gerant_id', auth()->user()->user_id)->first())->pluck('plaque', 'id'))
                    ->searchable(),
                Select::make('garage_id')
                    ->label('Garage')
                    ->options(Garage::where('gerant_id', auth()->user()->user_id)->pluck('name', 'id'))
                    ->searchable(),
                Select::make('tache_id')
                    ->label('Tache')
                    ->options(Tache::where('garage_id', Garage::where('gerant_id', auth()->user()->user_id)->first())->pluck('plaque', 'id'))
                    ->searchable(),
                Forms\Components\DatePicker::make('date')
                    ->label('Date du rdv')
                    ->required()
                    ->format('d/m/Y')
                    ->minDate(now())
                    ->maxDate(now()->addYears('1'))
                    ->default(now()),
                Forms\Components\Section::make('Factures')
                    ->schema([
                        Forms\Components\Repeater::make('factures')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('piece')
                                    ->label('Piece ou Service')
                                    ->required(),
                                Forms\Components\TextInput::make('quantite')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('prix_unitaire')
                                    ->label('Unit Price')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(3)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vehicule_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('garage_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tache_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListInterventions::route('/'),
            'create' => Pages\CreateIntervention::route('/create'),
            'edit' => Pages\EditIntervention::route('/{record}/edit'),
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
        return Intervention::whereNull('id');
    }
}
