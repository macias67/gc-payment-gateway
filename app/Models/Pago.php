<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public $timestamps = false;
    protected $table = 'pagos';
    protected $fillable = [
        'cliente',
        'fecha',
        'monto',
        'ticket',
        'referencia',
        'banco',
        'corresponde',
        'tecnico',
        'motivo',
    ];
}
