<?php

namespace Database\Factories;

use App\Models\Tache;
use App\Models\Vehicule;
use App\Models\Garage;
use Illuminate\Database\Eloquent\Factories\Factory;

class TacheFactory extends Factory
{
    protected $model = Tache::class;

    public function definition()
    {
        return [
            'garage_id' => Garage::inRandomOrder()->first()->id,
            'vehicule_id' => Vehicule::inRandomOrder()->first()->id,
            'name' => $this->faker->name(),
            'date_fin' => $this->faker->date(),
            'time' => $this->faker->time(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['encours', 'fini', 'annule']),
        ];
    }
}
