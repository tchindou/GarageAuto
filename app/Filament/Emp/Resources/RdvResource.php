<?php

namespace App\Filament\Emp\Resources;

use App\Filament\Emp\Resources\RdvResource\Pages;
use App\Filament\Emp\Resources\RdvResource\RelationManagers;
use App\Models\Employe;
use App\Models\Rdv;
use App\Models\Garage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Toggle;

class RdvResource extends Resource
{
    protected static ?string $model = Rdv::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

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
        return Rdv::whereNull('id')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('client_id')
                    ->required()
                    ->numeric(),
                Hidden::make('garage_id')
                    ->default(Garage::where('id', Employe::find(auth()->user()->user_id)->garage_id)->first()->id),
                Forms\Components\DatePicker::make('date')
                    ->label('Date du rdv')
                    ->required()
                    ->format('d/m/Y')
                    ->minDate(now())
                    ->maxDate(now()->addYears('1')),
                Forms\Components\TimePicker::make('heure')
                    ->label('Heure du rdv')
                    ->required()
                    ->format('G:i'),
                Toggle::make('valide')
                    ->onColor('success')
                    ->offColor('danger'),
                FileUpload::make('images')
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
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->size(40),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('garage.name')
                    ->label('Garage')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('time')
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                ToggleColumn::make('valide'),
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
            'index' => Pages\ListRdvs::route('/'),
            'create' => Pages\CreateRdv::route('/create'),
            'edit' => Pages\EditRdv::route('/{record}/edit'),
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
        return Rdv::whereNull('id');
    }
}
