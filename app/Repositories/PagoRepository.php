<?php

namespace App\Repositories;

use App\Models\Pago;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PagoRepository implements RepositoryInterface
{

    public function create(array $data): Pago
    {
        return Pago::create($data);
    }

    public function update($id, array $data): ?Pago
    {
        $pago = $this->findById($id);
        if ($pago) {
            $pago->update($data);
            return $pago;
        }
        return null;
    }

    public function findById(int $id): ?Pago
    {
        return Pago::find($id);
    }

    public function delete($id): bool
    {
        $pago = $this->findById($id);
        if ($pago) {
            return $pago->delete();
        }
        return false;
    }

    public function findByPaymentId(int $paymentId): ?Pago
    {
        return Pago::where('id_pago', $paymentId)->first();
    }

    public function getAll(): Collection
    {
        return Pago::all();
    }

    public function findCorrespondeByClientId(int $clientId): ?Pago
    {
        return Pago::where('cliente', $clientId)
            ->orderBy('id', 'desc')
            ->first();
    }
}
