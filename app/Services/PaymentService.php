<?php

namespace App\Services;

use App\DTO\MPWebhookDTO;
use App\DTO\PaymentDTO;
use Illuminate\Support\Facades\Log;
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

    /**
     * @param MPWebhookDTO $webhookData
     * @return void
     */
    public function processWebhook(MPWebhookDTO $webhookData): void
    {
        $payment = $this->paymentProvider->getPayment($webhookData->getPaymentId());

        Log::debug("payment webhook", $payment->toArray());
    }

    /**
     * @param string $paymentStatus
     * @return bool
     */
    public function isApprovedPayment(string $paymentStatus): bool
    {
        return $this->paymentProvider->isApproved($paymentStatus);
    }
}
