<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_inscripcion',
        'fecha_pago',
        'monto',
        'metodo_pago',
        'estado'
    ];

    public $timestamps = false;

    // Relaciones

    public function inscripcion()
    {
        return $this->belongsTo(
            Inscripcion::class,
            'id_inscripcion',
            'id_inscripcion'
        );
    }
}