<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'contrasena',
        'rol',
        'estado'
    ];

    public $timestamps = false;

    // Relaciones

    public function inscripciones()
    {
        return $this->hasMany(
            Inscripcion::class,
            'id_usuario',
            'id_usuario'
        );
    }
}