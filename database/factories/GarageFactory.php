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

        $img = "https://picsum.photos/300/200?random={$this->faker->numberBetween(1, 100)}";

        return [
            'gerant_id' => Gerant::inRandomOrder()->first()->id,
            'name' => $this->faker->company(),
            'gar_tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'addresse' => $this->faker->address(),
            'map_url' => $this->faker->url(),
            'description' => $this->faker->sentence(),
            'image' => $img,
            'password' => bcrypt('password'),
            'valide' => $this->faker->boolean,
            'likes' => $this->faker->numberBetween(0, 1000),
            'boost' => $this->faker->numberBetween(0, 9),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
