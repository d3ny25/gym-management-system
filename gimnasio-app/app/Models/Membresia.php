<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membresia extends Model
{
    use HasFactory;
    protected $table = 'membresias';

    protected $primaryKey = 'id_membresia';

    protected $fillable = [
        'nombre',
        'duracion_meses',
        'precio',
        'descripcion',
        'estado'
    ];

    public $timestamps = false;

    // Relaciones

    public function inscripciones()
    {
        return $this->hasMany(
            Inscripcion::class,
            'id_membresia',
            'id_membresia'
        );
    }
}