<?php

namespace App\Repositories;

use App\Models\PagoTarjeta;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PagoTarjetaRepository implements RepositoryInterface
{

    public function create(array $data): PagoTarjeta
    {
        return PagoTarjeta::create($data);
    }

    public function update($id, array $data): ?PagoTarjeta
    {
        $pagoTarjeta = $this->findById($id);
        if ($pagoTarjeta) {
            $pagoTarjeta->update($data);
            return $pagoTarjeta;
        }
        return null;
    }

    public function delete($id): bool
    {
        $pagoTarjeta = $this->findById($id);
        if ($pagoTarjeta) {
            return $pagoTarjeta->delete();
        }
        return false;
    }

    public function findById($id): ?PagoTarjeta
    {
        return PagoTarjeta::find($id);
    }

    public function findByPaymentId(int $paymentId): ?PagoTarjeta
    {
        return PagoTarjeta::where('id_pago', $paymentId)->first();
    }

    public function getAll(): Collection
    {
        return PagoTarjeta::all();
    }
}
