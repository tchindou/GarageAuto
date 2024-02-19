<?php

namespace App\Filament\Emp\Resources\VehiculeResource\Pages;

use App\Filament\Emp\Resources\VehiculeResource;
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
