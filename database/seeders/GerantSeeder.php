<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gerant;
use App\Models\User;

class GerantSeeder extends Seeder
{
    public function run()
    {
        Gerant::factory()->count(10)->create()->each(function ($gerant) {
            // Créer un utilisateur associé pour chaque gerant
            User::create([
                'name' => $gerant->name,
                'email' => $gerant->email, // ajustez l'email en fonction de votre logique
                'password' => $gerant->password, // ajustez le mot de passe en fonction de votre logique
                'user_type' => Gerant::class,
                'user_id' => $gerant->id,
            ]);
        });
    }
}
