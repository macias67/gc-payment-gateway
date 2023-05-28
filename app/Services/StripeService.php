<?php

namespace App\Services;

use App\DTO\PaymentDTO;

class StripeService implements PaymentServiceInterface
{
    public function createCustomer(PaymentDTO $paymentDTO) : void
    {
        // Lógica para crear el cliente de Stripe
    }

    public function createPayment(string $customerId, PaymentDTO $paymentDTO): void
    {
        // Lógica para crear el pago con Stripe
    }

    public function getCustomer(string $email): void
    {
        // TODO: Implement getCustomer() method.
    }

    public function createCard(string $customerId, PaymentDTO $paymentDTO): void
    {
        // TODO: Implement createCard() method.
    }

    public function getPayment(int $paymentId): void
    {
        // TODO: Implement getPayment() method.
    }
}
