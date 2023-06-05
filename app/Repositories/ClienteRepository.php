<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClienteRepository implements RepositoryInterface
{
    public function create(array $data): Cliente
    {
        return Cliente::create($data);
    }

    public function update($id, array $data): ?Cliente
    {
        $cliente = $this->findById($id);
        if ($cliente) {
            $cliente->update($data);
            return $cliente;
        }
        return null;
    }

    public function findById(int $id): ?Cliente
    {
        return Cliente::find($id);
    }

    public function delete($id): bool
    {
        $cliente = $this->findById($id);
        if ($cliente) {
            return $cliente->delete();
        }
        return false;
    }

    public function findByPaymentId(int $paymentId)
    {
        return null; // No aplica para la entidad Cliente
    }

    public function getAll(): Collection
    {
        return Cliente::all();
    }
}
