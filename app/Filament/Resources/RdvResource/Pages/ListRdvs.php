<?php

namespace App\Filament\Resources\RdvResource\Pages;

use App\Filament\Resources\RdvResource;
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
