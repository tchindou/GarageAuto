<?php

namespace App\Filament\Gerant\Resources;

use App\Filament\Gerant\Resources\PieceResource\Pages;
use App\Filament\Gerant\Resources\PieceResource\RelationManagers;
use App\Models\Piece;
use App\Models\Garage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PieceResource extends Resource
{
    protected static ?string $model = Piece::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('garage_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('prix')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('garage_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('prix')
                    ->numeric()
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
            'index' => Pages\ListPieces::route('/'),
            'create' => Pages\CreatePiece::route('/create'),
            'edit' => Pages\EditPiece::route('/{record}/edit'),
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
        return Piece::whereNull('id');
    }
}
