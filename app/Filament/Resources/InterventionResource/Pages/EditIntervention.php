<?php

namespace App\Filament\Resources\InterventionResource\Pages;

use App\Filament\Resources\InterventionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIntervention extends EditRecord
{
    protected static string $resource = InterventionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
