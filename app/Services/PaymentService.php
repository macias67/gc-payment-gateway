<?php

namespace App\Services;

use App\DTO\PaymentDTO;

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
     * @param PaymentDTO $paymentData
     * @return string
     */
    public function processPayment(PaymentDTO $paymentData) : string
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
        $payment = $this->paymentProvider->createPayment($customer->id, $paymentData);

        return $payment->id;
    }
}
