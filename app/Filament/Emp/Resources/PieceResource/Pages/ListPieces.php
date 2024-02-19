<?php

namespace App\Filament\Emp\Resources\PieceResource\Pages;

use App\Filament\Emp\Resources\PieceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPieces extends ListRecords
{
    protected static string $resource = PieceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
