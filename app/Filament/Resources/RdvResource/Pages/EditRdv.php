<?php

namespace App\Filament\Resources\RdvResource\Pages;

use App\Filament\Resources\RdvResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRdv extends EditRecord
{
    protected static string $resource = RdvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
