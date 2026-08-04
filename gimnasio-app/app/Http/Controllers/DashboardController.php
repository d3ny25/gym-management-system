<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Membresia;
use App\Models\Inscripcion;
use App\Models\Pago;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Throwable;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'clientesCount' => $this->safeCount(Cliente::class),
            'membresiasCount' => $this->safeCount(Membresia::class),
            'inscripcionesCount' => $this->safeCount(Inscripcion::class),
            'pagosCount' => $this->safeCount(Pago::class),
            'usuariosCount' => $this->safeCount(Usuario::class),
        ]);
    }

    private function safeCount(string $modelClass): int
    {
        try {
            $model = new $modelClass();
            if (!DB::getSchemaBuilder()->hasTable($model->getTable())) {
                return 0;
            }

            return $modelClass::count();
        } catch (Throwable) {
            return 0;
        }
    }
}
