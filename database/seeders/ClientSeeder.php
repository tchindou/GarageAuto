<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->count(10)->create()->each(function ($client) {
            // Créer un utilisateur associé pour chaque gerant
            User::create([
                'name' => $client->name,
                'email' => $client->email, // ajustez l'email en fonction de votre logique
                'password' => $client->password, // ajustez le mot de passe en fonction de votre logique
                'user_type' => Client::class,
                'user_id' => $client->id,
            ]);
        });
    }
}
