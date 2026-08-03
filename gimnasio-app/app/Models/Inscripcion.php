<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $primaryKey = 'id_inscripcion';

    protected $fillable = [
        'id_cliente',
        'id_membresia',
        'id_usuario',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    public $timestamps = false;

    // Relaciones

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'id_cliente',
            'id_cliente'
        );
    }

    public function membresia()
    {
        return $this->belongsTo(
            Membresia::class,
            'id_membresia',
            'id_membresia'
        );
    }

    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',
            'id_usuario'
        );
    }

    public function pagos()
    {
        return $this->hasMany(
            Pago::class,
            'id_inscripcion',
            'id_inscripcion'
        );
    }
}