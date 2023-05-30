<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function findById(int $id);

    public function findByPaymentId(int $paymentId);

    public function getAll();
}
