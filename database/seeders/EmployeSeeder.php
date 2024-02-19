<?php


namespace Database\Seeders;

use App\Models\Employe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employe::factory()->count(10)->create()->each(function ($emp) {
            // Créer un utilisateur associé pour chaque gerant
            User::create([
                'name' => $emp->name,
                'email' => $emp->email, // ajustez l'email en fonction de votre logique
                'password' => $emp->password, // ajustez le mot de passe en fonction de votre logique
                'user_type' => Employe::class,
                'user_id' => $emp->id,
            ]);
        });
    }
}
