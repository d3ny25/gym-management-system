<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;
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