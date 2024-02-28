<?php

namespace App\Filament\Emp\Resources;

use App\Filament\Emp\Resources\TacheResource\Pages;
use App\Filament\Emp\Resources\TacheResource\RelationManagers;
use App\Models\Tache;
use App\Models\Garage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use App\Enums\TaskStatus;
use App\Models\Employe;
use App\Models\Vehicule;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;

class TacheResource extends Resource
{
    protected static ?string $model = Tache::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-document';

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

        // Si aucun garage n'a été trouvé, retournez une requête vide
        return '0';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('garage_id')
                    ->default(Garage::where('id', Employe::find(auth()->user()->user_id)->garage_id)->first()->id),
                Forms\Components\TextInput::make('name')
                    ->label('Nom du tâche')
                    ->unique()
                    ->required(),
                Select::make('vehicule_id')
                    ->label('Vehicule')
                    ->preload()
                    ->options(Vehicule::where('garage_id', Employe::find(auth()->user()->user_id)->garage_id)->pluck('plaque', 'id'))
                    ->searchable(),
                Forms\Components\DatePicker::make('date_fin')
                    ->label('Date de fin du tâche')
                    ->required()
                    ->format('d/m/Y')
                    ->minDate(now())
                    ->maxDate(now()->addYears('1')),
                Forms\Components\TimePicker::make('time')
                    ->Label('Heure de fin du tâche')
                    ->required()
                    ->format('G:i'),
                Forms\Components\ToggleButtons::make('status')
                    ->inline()
                    ->options(TaskStatus::class)
                    ->default(TaskStatus::ENCOURS)
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ])
                    ->required(),
                MarkdownEditor::make('description')
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 3,
                        '2xl' => 4,
                    ])
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'table',
                        'undo',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom de tâche')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('garage.name')
                    ->numeric()
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicule.modele')
                    ->label('Vehicule')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin')
                    ->label('Date de Fin')
                    ->date()
                    ->sortable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('time')
                    ->label('Heure de Fin')
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
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
            'index' => Pages\ListTaches::route('/'),
            'create' => Pages\CreateTache::route('/create'),
            'edit' => Pages\EditTache::route('/{record}/edit'),
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
        return Tache::whereNull('id');
    }
}
