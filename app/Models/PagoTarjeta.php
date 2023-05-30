<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoTarjeta extends Model
{
    protected $table = 'pagos_tarjeta';

    protected $fillable = [
        'cliente',
        'email',
        'procesador_pago',
        'id_pago',
        'monto',
        'estatus',
        'respuesta_webhook',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'json',
        'respuesta_webhook' => 'boolean',
    ];
}
