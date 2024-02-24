<?php

namespace App\Filament\Emp\Resources;

use App\Filament\Emp\Resources\InterventionResource\Pages;
use App\Filament\Emp\Resources\InterventionResource\RelationManagers;
use App\Models\Employe;
use App\Models\Intervention;
use App\Models\Garage;
use App\Models\Tache;
use App\Models\Vehicule;
use App\Models\Facture;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
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

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

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

            return (string) parent::getEloquentQuery()
                ->where('garage_id', $garageId)
                ->count();
        }

        return '0';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('vehicule_id')
                    ->numeric()
                    ->label('Vehicule')
                    ->options(Vehicule::where('garage_id', Employe::find(auth()->user()->user_id)->garage_id)->pluck('plaque', 'id'))
                    ->searchable(),
                Hidden::make('garage_id')
                    ->numeric()
                    ->default(Garage::where('garage_id', Employe::find(auth()->user()->user_id)->garage_id)->pluck('name', 'id'))
                    ->searchable(),
                Select::make('tache_id')
                    ->numeric()
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
            'index' => Pages\ListInterventions::route('/'),
            'create' => Pages\CreateIntervention::route('/create'),
            'edit' => Pages\EditIntervention::route('/{record}/edit'),
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

        // Si aucun employé n'a été trouvé, retournez une requête vide
        return Intervention::whereNull('id');
    }
}
