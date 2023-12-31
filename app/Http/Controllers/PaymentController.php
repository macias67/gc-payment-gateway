<?php

namespace App\Http\Controllers;

use App\DTO\PaymentDTO;
use App\Exceptions\CustomerException;
use App\Services\ActivationService;
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

    /**
     * @param Request $request
     * @param PaymentService $paymentService
     * @param ActivationService $activationService
     * @return JsonResponse
     * @throws CustomerException
     */
    public function handler(Request           $request,
                            PaymentService    $paymentService,
                            ActivationService $activationService): JsonResponse
    {
        $data = $request->all();
        $paymentDTO = new PaymentDTO($data);

        // Process payment
        $payment = $paymentService->processPayment($paymentDTO);

        if ($paymentService->isApprovedPayment($payment->status)) {
            // Reactivate Service
            $activationService->sendActivationRequest($paymentDTO->getIdp(), $payment);
        }

        return response()->json([
            'message' => 'Payment processed successfully',
            'payment' => [
                'id' => $payment->id,
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'payment_type_id' => $payment->payment_type_id
            ],
            'idp' => $paymentDTO->getIdp()
        ], Response::HTTP_CREATED);
    }
}
