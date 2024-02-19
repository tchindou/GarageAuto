<?php

namespace App\Filament\Gerant\Resources\TacheResource\Pages;

use App\Filament\Gerant\Resources\TacheResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTache extends EditRecord
{
    protected static string $resource = TacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
