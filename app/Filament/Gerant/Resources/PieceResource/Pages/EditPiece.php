<?php

namespace App\Filament\Gerant\Resources\PieceResource\Pages;

use App\Filament\Gerant\Resources\PieceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPiece extends EditRecord
{
    protected static string $resource = PieceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}