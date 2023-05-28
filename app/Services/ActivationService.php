<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ActivationService
{
    public function __construct()
    {
        $this->url = env('ACTIVATION_URL');
    }

    public function sendActivationRequest(int $paymentId, int $userId, float $amount): void
    {
        $data = [
            'paymentId' => $paymentId,
            'idp' => $userId,
            'amount' => $amount
        ];

        $response = Http::post($this->url, $data);

        if ($response->failed()) {
            $error = $response->body();
            Log::error('activation error', ['error' => $error]);
        } else {
            // $responseBody = $response->body();
            Log::debug('activation requested', $data);
        }

    }
}
