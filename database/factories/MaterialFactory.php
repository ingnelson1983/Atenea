<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Cod_Empresa' => $this->faker->numberBetween(1,3),
            'Nombre_Empresa' => $this->$faker->randomElement(['CFC', 'DULF', 'LA LIBIA']),
           
        ];
    }
}
