<?php

namespace App\Filament\Gerant\Resources\EmployeResource\Pages;

use App\Filament\Gerant\Resources\EmployeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Employe;
use App\Models\User;

class CreateEmploye extends CreateRecord
{
    protected static string $resource = EmployeResource::class;

    protected function afterCreate(): void
    {
        $employe = $this->record;

        User::create([
            'name' => $employe->name,
            'email' => $employe->email,
            'password' => bcrypt('password'),  // Remplacez 'password' par le mot de passe que vous voulez
            'user_id' => $employe->id,
            'user_type' => Employe::class,
        ]);
    }
}
