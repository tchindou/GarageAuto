<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Gerant;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Garage>
 */
class GarageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gerant_id' => Gerant::inRandomOrder()->first()->id,
            'name' => $this->faker->company(),
            'gar_tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'addresse' => $this->faker->address(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'password' => bcrypt('password'), // Vous pouvez ajuster cette logique selon vos besoins
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
