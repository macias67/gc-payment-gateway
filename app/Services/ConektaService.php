<?php

namespace App\Services;

use App\DTO\PaymentDTO;

class ConektaService implements PaymentServiceInterface
{
    public function createCustomer(PaymentDTO $paymentDTO) : void
    {
        // Lógica para crear el cliente de MercadoPago
    }

    public function createPayment(PaymentDTO $paymentDTO) : void
    {
        // Lógica para crear el pago con MercadoPago
    }

    public function getCustomer(string $clientId) : void
    {
        // TODO: Implement getCustomer() method.
    }

    public function createCard(string $customerId, PaymentDTO $paymentDTO) : void
    {
        // TODO: Implement createCard() method.
    }
}
