<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;
    protected $table = 'clientes';
    protected $fillable = [
        'cliente',
        'identificacion',
        'zona',
        'detalles',
        'extras',
        'email',
        'telefono',
        'domicilio',
        'numero',
        'colonia',
        'tecnico',
        'ipseg',
        'ip',
        'ap',
        'tipocone',
        'fechinsta',
        'fecha',
        'corte',
        'contrato',
        'mensual',
        'serie',
        'cable',
        'mbps',
        'dbi',
        'status',
        'deudor',
        'clave',
        'reporte',
        'prepago',
        'coordenadas',
        'ultimocut',
        'adeudo',
        'comment',
        'actualizado',
        'asignado',
    ];

    protected $casts = ['mensual' => 'integer'];

    /**
     * @var array
     */
    protected $visible = ['cliente', 'domicilio', 'numero', 'colonia', 'mensual'];

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->only($this->getVisible());
    }
}

