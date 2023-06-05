<?php

namespace Database\Seeders;

use App\Models\Pago;
use Illuminate\Database\Seeder;

class PagosTableSeeder extends Seeder
{
    public function run()
    {
        // Crear registros de prueba para la tabla 'pagos'
        Pago::create([
            'cliente' => 1,
            'fecha' => '2023-05-27',
            'monto' => 1000,
            'ticket' => 'ABC123',
            'referencia' => 'REF-001',
            'banco' => 1,
            'corresponde' => 'Pagado',
            'tecnico' => 'Juan Perez',
            'motivo' => 'Pago mensualidad',
        ]);

        Pago::create([
            'cliente' => 2,
            'fecha' => '2023-05-26',
            'monto' => 1500,
            'ticket' => 'DEF456',
            'referencia' => 'REF-002',
            'banco' => 2,
            'corresponde' => 'Pagado',
            'tecnico' => 'Maria Sanchez',
            'motivo' => 'Pago deuda pendiente',
        ]);

        // Agregar más registros de prueba si es necesario
    }
}

