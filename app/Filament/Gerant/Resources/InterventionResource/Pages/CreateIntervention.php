<?php

namespace App\Filament\Gerant\Resources\InterventionResource\Pages;

use App\Filament\Gerant\Resources\InterventionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Intervention;
use App\Models\Facture;
use Illuminate\Support\Arr;

class CreateIntervention extends CreateRecord
{
    protected static string $resource = InterventionResource::class;
}
