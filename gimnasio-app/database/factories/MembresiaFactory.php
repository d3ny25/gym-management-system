<?php

namespace Database\Factories;

use App\Models\Membresia;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembresiaFactory extends Factory
{
    protected $model = Membresia::class;

    public function definition(): array
    {
        $nombres = ['Básica', 'Premium', 'Mensual', 'Trimestral', 'Anual', 'VIP', 'Estudiante', 'Familiar'];
        $duraciones = [1, 3, 6, 12, 18, 24];

        return [
            'nombre' => fake()->randomElement($nombres) . ' ' . fake()->randomElement(['Gold', 'Silver', 'Bronze', 'Plus', 'Max', 'Pro', '']),
            'duracion_meses' => fake()->randomElement($duraciones),
            'precio' => fake()->randomFloat(2, 100, 2500),
            'descripcion' => fake()->sentence(10),
            'estado' => fake()->randomElement(['activa', 'inactiva']),
        ];
    }
}
