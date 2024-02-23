<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Garage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
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
                        'email' => $this->faker->unique()->safeEmail(),
                        'password' => bcrypt('password'), // You might want to change this
                ];
        }
}
