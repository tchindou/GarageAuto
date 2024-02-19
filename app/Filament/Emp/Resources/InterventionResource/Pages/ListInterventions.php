<?php

namespace App\Filament\Emp\Resources\InterventionResource\Pages;

use App\Filament\Emp\Resources\InterventionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterventions extends ListRecords
{
    protected static string $resource = InterventionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
