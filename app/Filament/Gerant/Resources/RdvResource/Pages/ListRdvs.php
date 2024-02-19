<?php

namespace App\Filament\Gerant\Resources\RdvResource\Pages;

use App\Filament\Gerant\Resources\RdvResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRdvs extends ListRecords
{
    protected static string $resource = RdvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
