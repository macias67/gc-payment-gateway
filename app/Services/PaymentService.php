<?php

namespace App\Services;

use App\DTO\PaymentDTO;
use MercadoPago\Payment;

class PaymentService
{
    protected PaymentServiceInterface $paymentProvider;

    /**
     * @param PaymentServiceInterface $paymentProvider
     */
    public function __construct(PaymentServiceInterface $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    /**
     * @param int $paymentId
     * @return Payment|null
     */
    public function getPayment(int $paymentId): ?Payment
    {
        return $this->paymentProvider->getPayment($paymentId);
    }

    /**
     * @param PaymentDTO $paymentData
     * @return Payment
     */
    public function processPayment(PaymentDTO $paymentData): Payment
    {
        // Validate if customer exist
        $customer = $this->paymentProvider->getCustomer($paymentData->getEmail());
        // Create customer
        if ($customer === null) {
            $customer = $this->paymentProvider->createCustomer($paymentData);
        }
        // Create card's customer
        $card = $this->paymentProvider->createCard($customer->id, $paymentData);
        // Create payment
        return $this->paymentProvider->createPayment($customer->id, $paymentData);
    }
}
