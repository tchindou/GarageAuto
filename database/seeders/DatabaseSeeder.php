<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use App\Models\Gerant;
use App\Models\Employe;
use App\Models\Garage;
use App\Models\Tache;
use App\Models\Rdv;
use App\Models\Intervention;
use App\Models\Vehicule;
use App\Models\Facture;
use App\Models\Admin;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->count(2)->create()->each(
            function ($client) {
                // Créer un utilisateur associé pour chaque gerant
                User::create([
                    'name' => $client->name,
                    'email' => $client->email, // ajustez l'email en fonction de votre logique
                    'password' => $client->password, // ajustez le mot de passe en fonction de votre logique
                    'user_type' => Admin::class,
                    'user_id' => $client->id,
                ]);
            }
        );

        Client::factory()->count(20)->create()->each(function ($client) {
            // Créer un utilisateur associé pour chaque gerant
            User::create([
                'name' => $client->name,
                'email' => $client->email, // ajustez l'email en fonction de votre logique
                'password' => $client->password, // ajustez le mot de passe en fonction de votre logique
                'user_type' => Client::class,
                'user_id' => $client->id,
            ]);
        });

        Gerant::factory()->count(20)->create()->each(function ($gerant) {
            // Créer un utilisateur associé pour chaque gerant
            User::create([
                'name' => $gerant->name,
                'email' => $gerant->email, // ajustez l'email en fonction de votre logique
                'password' => $gerant->password, // ajustez le mot de passe en fonction de votre logique
                'user_type' => Gerant::class,
                'user_id' => $gerant->id,
            ]);
        });

        Garage::factory()->count(20)->create();

        Employe::factory()->count(20)->create()->each(function ($emp) {
            // Créer un utilisateur associé pour chaque gerant
            User::create([
                'name' => $emp->name,
                'email' => $emp->email, // ajustez l'email en fonction de votre logique
                'password' => $emp->password, // ajustez le mot de passe en fonction de votre logique
                'user_type' => Employe::class,
                'user_id' => $emp->id,
            ]);
        });

        Vehicule::factory()->count(20)->create();

        Rdv::factory()->count(20)->create();

        Tache::factory()->count(20)->create();
    }
}
