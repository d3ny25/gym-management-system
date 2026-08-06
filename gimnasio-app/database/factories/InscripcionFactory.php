<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Inscripcion;
use App\Models\Membresia;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InscripcionFactory extends Factory
{
    protected $model = Inscripcion::class;

    public function definition(): array
    {
        $cliente = Cliente::inRandomOrder()->first();
        $membresia = Membresia::inRandomOrder()->first();
        $usuario = Usuario::inRandomOrder()->first();

        $fechaInicio = fake()->dateTimeBetween('-2 years', 'now');
        $fechaFin = (clone $fechaInicio)->modify('+' . ($membresia->duracion_meses ?? 1) . ' months');

        return [
            'id_cliente' => $cliente ? $cliente->id_cliente : 1,
            'id_membresia' => $membresia ? $membresia->id_membresia : 1,
            'id_usuario' => $usuario ? $usuario->id_usuario : 1,
            'fecha_inicio' => $fechaInicio->format('Y-m-d'),
            'fecha_fin' => $fechaFin->format('Y-m-d'),
            'estado' => fake()->randomElement(['Activa', 'Finalizada', 'Cancelada']),
        ];
    }
}
