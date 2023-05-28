<?php

namespace App\Http\Controllers;

use App\DTO\PaymentDTO;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function get(Request $request, PaymentService $paymentService): JsonResponse
    {
        $paymentId = $request->get('id', 0);

        // Get Payment info
        $result = $paymentService->getPayment($paymentId);

        return response()->json([
            'message' => 'Payment information',
            'payment' => ($result === null) ? [] : [
                'id' => $result->id,
                'status' => $result->status,
                'status_detail' => $result->status_detail,
                'payment_type_id' => $result->payment_type_id
            ]
        ], Response::HTTP_OK);
    }

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
