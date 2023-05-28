<?php

namespace App\Http\Controllers;

use App\DTO\MPWebhookDTO;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handler(Request $request, PaymentService $paymentService): Response
    {
        $data = $request->all();
        $webhookData = new MPWebhookDTO($data);

        Log::info('webhook data', $data);

        $paymentService->processWebhook($webhookData);

        return response()->make('');
    }
}
