<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Periodo>
 */
class PeriodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->year($max = 'now'),
            'descripcion' => $this->faker->word(20),
            'fecha_entrega_plan' => $this->faker->date(),
            'primer_parcial_desde' => $this->faker->date(),
            'primer_parcial_hasta' => $this->faker->date(),
            'segundo_parcial_desde' => $this->faker->date(),
            'segundo_parcial_hasta' => $this->faker->date(),
            'examen_final_desde' => $this->faker->date(),
            'examen_final_hasta' => $this->faker->date(),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date()
        ];
    }
}
