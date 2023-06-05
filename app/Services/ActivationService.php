<?php

namespace App\Services;

use App\Repositories\PagoRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MercadoPago\Payment;

class ActivationService
{
    /**
     * @var string
     */
    private $url;
    private PagoRepository $pagoRepository;

    public function __construct(PagoRepository $pagoRepository)
    {
        $this->url = (string)env('ACTIVATION_URL');
        $this->pagoRepository = $pagoRepository;
    }

    public function sendActivationRequest(int $userId, Payment $payment): void
    {
        $pagoRecord = $this->pagoRepository->findCorrespondeByClientId($userId);

        $data = [
            'idp' => $userId,
            'paymentId' => $payment->id,
            'amount' => $payment->transaction_amount,
            'corresponde' => $pagoRecord->corresponde ?? null
        ];

        $response = Http::post($this->url, $data);

        if ($response->failed()) {
            $error = $response->body();
            Log::error('activation error', ['error' => $error]);
        } else {
            // $responseBody = $response->body();
            Log::info('activation requested', $data);
        }
    }
}
