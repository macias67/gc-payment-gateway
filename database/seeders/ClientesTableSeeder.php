<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    public function run()
    {
        // Crear registros de prueba para la tabla 'clientes'
        Cliente::create([
            'cliente' => 'Juan Perez',
            'identificacion' => '123456789',
            'zona' => 'Zona 1',
            'detalles' => 'Detalles del cliente 1',
            'extras' => 'Extras del cliente 1',
            'email' => 'juan@example.com',
            'telefono' => '1234567890',
            'domicilio' => 'Calle 123',
            'numero' => 'A1',
            'colonia' => 'Colonia 1',
            'tecnico' => 'Juan Perez',
            'ipseg' => 1,
            'ip' => 1,
            'ap' => 'AP1',
            'tipocone' => 'Tipo 1',
            'fechinsta' => '2023-05-27',
            'fecha' => '2023-05-27',
            'corte' => 1,
            'contrato' => 'Contrato 1',
            'mensual' => '400',
            'serie' => 'Serie 1',
            'cable' => 'Cable 1',
            'mbps' => '10 Mbps',
            'dbi' => 'DBI 1',
            'status' => 'Activo',
            'deudor' => 0,
            'clave' => 'Clave 1',
            'reporte' => 0,
            'prepago' => 0,
            'coordenadas' => '12345,67890',
            'ultimocut' => '2023-05-27',
            'adeudo' => 'Adeudo del cliente 1',
            'comment' => 'Comentario del cliente 1',
            'actualizado' => '2023-05-27',
            'asignado' => 1,
        ]);

        Cliente::create([
            'cliente' => 'Maria Sanchez',
            'identificacion' => '987654321',
            'zona' => 'Zona 2',
            'detalles' => 'Detalles del cliente 2',
            'extras' => 'Extras del cliente 2',
            'email' => 'maria@example.com',
            'telefono' => '9876543210',
            'domicilio' => 'Calle 456',
            'numero' => 'B2',
            'colonia' => 'Colonia 2',
            'tecnico' => 'Maria Sanchez',
            'ipseg' => 2,
            'ip' => 2,
            'ap' => 'AP2',
            'tipocone' => 'Tipo 2',
            'fechinsta' => '2023-05-26',
            'fecha' => '2023-05-26',
            'corte' => 2,
            'contrato' => 'Contrato 2',
            'mensual' => '300',
            'serie' => 'Serie 2',
            'cable' => 'Cable 2',
            'mbps' => '20 Mbps',
            'dbi' => 'DBI 2',
            'status' => 'Activo',
            'deudor' => 0,
            'clave' => 'Clave 2',
            'reporte' => 0,
            'prepago' => 0,
            'coordenadas' => '54321,09876',
            'ultimocut' => '2023-05-26',
            'adeudo' => 'Adeudo del cliente 2',
            'comment' => 'Comentario del cliente 2',
            'actualizado' => '2023-05-26',
            'asignado' => 2,
        ]);

        // Agregar más registros de prueba si es necesario
    }
}
