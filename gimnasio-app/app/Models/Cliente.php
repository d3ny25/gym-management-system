<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'correo',
        'direccion'
        
        ];

    public $timestamps = false;

    // Relaciones

    public function inscripciones()
    {
        return $this->hasMany(
            Inscripcion::class,
            'id_cliente',
            'id_cliente'
        );
    }
}