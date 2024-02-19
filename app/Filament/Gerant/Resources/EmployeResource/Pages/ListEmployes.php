<?php

namespace App\Filament\Gerant\Resources\EmployeResource\Pages;

use App\Filament\Gerant\Resources\EmployeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\EmployeExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;

class ListEmployes extends ListRecords
{
    protected static string $resource = EmployeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Ajouter'),
            ExportAction::make()
                ->label('Exporter')
                ->exporter(EmployeExporter::class),

        ];
    }
}
