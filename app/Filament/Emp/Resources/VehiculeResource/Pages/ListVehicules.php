<?php

namespace App\Filament\Emp\Resources\VehiculeResource\Pages;

use App\Filament\Emp\Resources\VehiculeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicules extends ListRecords
{
    protected static string $resource = VehiculeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
