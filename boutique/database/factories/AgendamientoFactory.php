<?php

namespace Database\Factories;

use App\Models\Agendamiento;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendamientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agendamiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => $this->faker->numberBetween(1, 10), // Ejemplo: generando ID de cliente entre 1 y 10
            'empleado_id' => $this->faker->numberBetween(1, 5), // Ejemplo: generando ID de empleado entre 1 y 5
            'fecha_hora' => $this->faker->dateTimeBetween('+1 day', '+1 week'), // Ejemplo: fecha y hora entre mañana y dentro de una semana
        ];
    }
}