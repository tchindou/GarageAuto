<?php

namespace App\Filament\Gerant\Resources\EmployeResource\Pages;

use App\Filament\Gerant\Resources\EmployeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploye extends EditRecord
{
    protected static string $resource = EmployeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
