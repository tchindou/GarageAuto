<?php

namespace Database\Factories;

use App\Models\Vehicule;
use App\Models\Client;
use App\Models\Garage;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculeFactory extends Factory
{
    protected $model = Vehicule::class;

    public function definition()
    {
        return [
            'garage_id' => Garage::inRandomOrder()->first()->id,
            'client_id' => Client::inRandomOrder()->first()->id,
            'marque' => $this->faker->company(),
            'modele' => $this->faker->word(),
            'plaque' => $this->faker->bothify('??###??'),
        ];
    }
}
