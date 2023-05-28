<?php

namespace App\Http\Controllers;

use App\DTO\PaymentDTO;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function store(Request $request, PaymentService $paymentService): JsonResponse
    {
        $data = $request->all();
        $paymentDTO = new PaymentDTO($data);

        // Process payment
        $payment = $paymentService->processPayment($paymentDTO);

        // Reactivate Service

        return response()->json([
            'message' => 'Payment processed successfully',
            'payment' => [
                'id' => $payment->id,
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'payment_type_id' => $payment->payment_type_id
            ]
        ], Response::HTTP_CREATED);
    }
}
