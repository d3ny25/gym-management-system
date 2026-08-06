<?php

namespace Database\Factories;

use App\Models\Inscripcion;
use App\Models\Pago;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    protected $model = Pago::class;

    public function definition(): array
    {
        $inscripcion = Inscripcion::inRandomOrder()->first();

        return [
            'id_inscripcion' => $inscripcion ? $inscripcion->id_inscripcion : 1,
            'fecha_pago' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'monto' => fake()->randomFloat(2, 100, 2500),
            'metodo_pago' => fake()->randomElement(['Efectivo', 'Tarjeta', 'Transferencia']),
            'estado' => fake()->randomElement(['Pagado', 'Pendiente', 'Cancelado']),
        ];
    }
}
