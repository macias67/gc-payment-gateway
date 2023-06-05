<?php

namespace App\Services;

use App\DTO\MPWebhookDTO;
use App\DTO\PaymentDTO;
use App\Exceptions\CustomerException;
use App\Repositories\ClienteRepository;
use App\Repositories\PagoTarjetaRepository;
use Illuminate\Support\Facades\Log;
use MercadoPago\Payment;

class PaymentService
{
    private PaymentServiceInterface $paymentProvider;
    private PagoTarjetaRepository $pagoTarjetaRepository;
    private ClienteRepository $clienteRepository;

    /**
     * @param PaymentServiceInterface $paymentProvider
     * @param PagoTarjetaRepository $pagoTarjetaRepository
     * @param ClienteRepository $clienteRepository
     */
    public function __construct(PaymentServiceInterface $paymentProvider,
                                PagoTarjetaRepository   $pagoTarjetaRepository,
                                ClienteRepository       $clienteRepository)
    {
        $this->paymentProvider = $paymentProvider;
        $this->pagoTarjetaRepository = $pagoTarjetaRepository;
        $this->clienteRepository = $clienteRepository;
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
     * @throws CustomerException
     */
    public function processPayment(PaymentDTO $paymentData): Payment
    {
        // Get client db info
        $cliente = $this->clienteRepository->findById($paymentData->getIdp());

        if ($cliente === null) {
            Log::error('cliente repository not found', ['id' => $paymentData->getIdp()]);

            throw new CustomerException();
        }

        //Set amount by DB
        $paymentData->setAmount($cliente->mensual ?? 10);

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

        $paymentDB = $this->pagoTarjetaRepository->create([
            'cliente' => $paymentData->getIdp(),
            'email' => $paymentData->getEmail(),
            'procesador_pago' => 'mercado_pago',
            'id_pago' => (string)$payment->id,
            'monto' => $payment->transaction_amount,
            'estatus' => $payment->status,
            'metadata' => [
                'customer' => $customer->id,
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'payment_type_id' => $payment->payment_type_id
            ]
        ]);

        Log::debug('payment DB', $paymentDB->toArray());

        return $payment;
    }

    /**
     * @param MPWebhookDTO $webhookData
     * @return void
     */
    public function processWebhook(MPWebhookDTO $webhookData): void
    {
        $payment = $this->paymentProvider->getPayment($webhookData->getPaymentId());

        $paymentDB = $this->pagoTarjetaRepository->findByPaymentId((string)$payment->id);
        $paymentDB->respuesta_webhook = true;
        $paymentDB->save();

        Log::debug("payment webhook", $payment->toArray());
        Log::debug("payment webhook db", $paymentDB->toArray());
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
