<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aula>
 */
class AulaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'nombre' => $this->faker->word,
            'capacidad' => $this->faker->numberBetween(10, 100),
            'tipo_aula' =>  $this->faker->randomElement(['laboratorio', 'normal','zoom'])
           
        ];
    }
}
