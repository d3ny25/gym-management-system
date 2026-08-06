<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
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