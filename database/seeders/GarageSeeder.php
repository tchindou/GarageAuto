<?php

namespace Database\Seeders;

use App\Models\Garage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GarageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Garage::factory()->count(10)->create();
    }
}
