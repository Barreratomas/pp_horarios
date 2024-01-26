<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comision>
 */
class ComisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anio' => $this->faker->numberBetween(1, 3),
            'division' => $this->faker->numberBetween(1, 3),
            'id_carrera' => Carrera::inRandomOrder()->first()->id_carrera,
            'capacidad' => $this->faker->numberBetween(20, 50),
        ];
    }
}
