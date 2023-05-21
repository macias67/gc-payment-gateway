<?php

namespace App\Services;

use App\DTO\PaymentDTO;

class StripeService implements PaymentServiceInterface
{
    public function createCustomer(PaymentDTO $paymentDTO) : void
    {
        // Lógica para crear el cliente de Stripe
    }

    public function createPayment(PaymentDTO $paymentDTO) : void
    {
        // Lógica para crear el pago con Stripe
    }

    public function getCustomer(string $clientId)
    {
        // TODO: Implement getCustomer() method.
    }

    public function createCard(string $customerId, PaymentDTO $paymentDTO) : void
    {
        // TODO: Implement createCard() method.
    }
}
