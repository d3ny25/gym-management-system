<?php

namespace Database\Seeders;

use App\Models\Membresia;
use Illuminate\Database\Seeder;

class MembresiaSeeder extends Seeder
{
    public function run(): void
    {
        Membresia::factory()->count(10)->create();
    }
}
