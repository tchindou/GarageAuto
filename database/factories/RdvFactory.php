<?php

namespace Database\Factories;

use App\Models\Rdv;
use App\Models\Client;
use App\Models\Garage;
use Illuminate\Database\Eloquent\Factories\Factory;

class RdvFactory extends Factory
{
    protected $model = Rdv::class;

    protected $casts = [
        'status' => 'boolean',
    ];

    public function definition()
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'garage_id' => Garage::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'valide' => $this->faker->boolean(),
        ];
    }
}
