<?php

namespace App\Services;

use App\DTO\PaymentDTO;

interface PaymentServiceInterface
{
    public function createCustomer(PaymentDTO $paymentDTO);

    public function createCard(string $customerId, PaymentDTO $paymentDTO);

    public function getCustomer(string $email);

    public function createPayment(string $customerId, PaymentDTO $paymentDTO);
}

