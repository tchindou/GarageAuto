<?php

namespace App\Filament\Gerant\Resources\GarageResource\Pages;

use App\Filament\Gerant\Resources\GarageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGarage extends EditRecord
{
    protected static string $resource = GarageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
