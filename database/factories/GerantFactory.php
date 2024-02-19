<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Garage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gerant>
 */
class GerantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'ger_tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // You might want to change this
        ];
    }
}
