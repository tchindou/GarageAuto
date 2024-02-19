<?php

namespace App\Filament\Resources\EmployeResource\Pages;

use App\Filament\Resources\EmployeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployes extends ListRecords
{
    protected static string $resource = EmployeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
