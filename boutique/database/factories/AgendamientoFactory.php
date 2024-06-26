<?php

namespace Database\Factories;
use App\Models\Agendamiento;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamiento>
 */
class AgendamientoFactory extends Factory
{
    protected $model = Agendamiento::class;

    public function definition()
    {
        return [
            'cliente_id' => Cliente::factory(),
            'empleado_id' => Empleado::factory(),
            'fecha_hora' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}