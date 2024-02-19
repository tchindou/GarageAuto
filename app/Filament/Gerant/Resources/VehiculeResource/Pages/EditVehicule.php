<?php

namespace App\Filament\Gerant\Resources\VehiculeResource\Pages;

use App\Filament\Gerant\Resources\VehiculeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicule extends EditRecord
{
    protected static string $resource = VehiculeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
