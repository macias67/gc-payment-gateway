<?php

namespace App\Http\Controllers;

use App\DTO\PaymentDTO;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function store(Request $request, PaymentService $paymentService): JsonResponse
    {
        $data = $request->all();

        $paymentDTO = new PaymentDTO($data);

        $id = $paymentService->processPayment($paymentDTO);

        return response()->json([
            'message' => 'Payment processed successfully',
            'paymentId' => $id
        ]);
    }
}
