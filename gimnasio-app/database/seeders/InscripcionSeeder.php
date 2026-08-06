<?php

namespace Database\Seeders;

use App\Models\Inscripcion;
use Illuminate\Database\Seeder;

class InscripcionSeeder extends Seeder
{
    public function run(): void
    {
        Inscripcion::factory()->count(25)->create();
    }
}
