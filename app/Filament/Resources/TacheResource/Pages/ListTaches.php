<?php

namespace App\Filament\Resources\TacheResource\Pages;

use App\Filament\Resources\TacheResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaches extends ListRecords
{
    protected static string $resource = TacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
