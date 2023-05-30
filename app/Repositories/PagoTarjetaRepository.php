<?php

namespace App\Repositories;

use App\Models\PagoTarjeta;
use App\Repositories\Contracts\RepositoryInterface;

class PagoTarjetaRepository implements RepositoryInterface
{

    public function create(array $data): PagoTarjeta
    {
        return PagoTarjeta::create($data);
    }

    public function update($id, array $data): PagoTarjeta
    {
        $pagoTarjeta = PagoTarjeta::findOrFail($id);
        $pagoTarjeta->update($data);
        return $pagoTarjeta;
    }

    public function delete($id): void
    {
        $pagoTarjeta = PagoTarjeta::findOrFail($id);
        $pagoTarjeta->delete();
    }

    public function findById($id): PagoTarjeta
    {
        return PagoTarjeta::findOrFail($id);
    }

    public function findByPaymentId(int $paymentId): PagoTarjeta
    {
        return PagoTarjeta::where('id_pago', $paymentId)->firstOrFail();
    }

    public function getAll()
    {
        return PagoTarjeta::all();
    }
}
