<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Garage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'garage_id' => Garage::inRandomOrder()->first()->id,
            'name' => $this->faker->name(),
            'tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'status' => $this->faker->randomElement(['nouveau', 'ex', 'mute']),
        ];
    }
}
