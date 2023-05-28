<?php

namespace App\Services;

use App\DTO\PaymentDTO;
use App\Exceptions\CustomerException;
use Exception;
use Illuminate\Support\Facades\Log;
use MercadoPago\Card;
use MercadoPago\Customer;
use MercadoPago\Payment;
use MercadoPago\SDK;
use RuntimeException;

class MercadoPagoService implements PaymentServiceInterface
{
    public function __construct()
    {
        SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
    }

    /**
     * @param PaymentDTO $paymentDTO
     * @return Customer
     * @throws CustomerException
     */
    public function createCustomer(PaymentDTO $paymentDTO): Customer
    {
        // Create Customer
        $customer = new Customer();
        $customer->email = $paymentDTO->getEmail();
        $customer->save();

        // Validate Error
        if ($customer->Error()) {
            $error = $customer->Error();

            Log::error("customer error", [
                'message' => $error->message,
                'status' => $error->status,
                'error' => $error->error,
                'causes' => $error->causes[0],
                'file' => __FILE__,
            ]);

            throw new CustomerException(
                $error->causes[0]->description,
                $error->causes[0]->code
            );
        }

        Log::debug("customer created", [
            'id' => $customer->id,
            'email' => $customer->email,
            'user_id' => $customer->user_id,
            'file' => __FILE__,
        ]);

        return $customer;
    }

    /**
     * @param string $customerId
     * @param PaymentDTO $paymentDTO
     * @return Payment
     * @throws Exception
     */
    public function createPayment(string $customerId, PaymentDTO $paymentDTO) : Payment
    {
        $payment = new Payment();

        $payment->transaction_amount = $paymentDTO->getAmount();
        $payment->token = $paymentDTO->getToken();
        $payment->description = "Pago Mensualidad Grupo Capitolio";
        $payment->installments = 1;
        $payment->payment_method_id = $paymentDTO->getPaymentMethodId();
        $payment->issuer_id = $paymentDTO->getIssuerId();
        $payment->payer = [
            "entity_type" => "individual",
            "type" => "customer",
            "id" => $customerId,
            "email" => $paymentDTO->getEmail()
        ];
        $payment->statement_descriptor = "GRUPOCAPITOLIO";
        //  $payment->capture = true;
        $payment->save();

        Log::info("payment created", [
            'id' => $payment->id,
            'customer_id' => $customerId,
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'payment_type_id' => $payment->payment_type_id,
            'file' => __FILE__,
        ]);

        return $payment;
    }

    /**
     * @param string $email
     * @return Customer|null
     */
    public function getCustomer(string $email): ?Customer
    {
        try {
            $filters = ["email" => $email];
            $results = Customer::search($filters);

            if ($results->count() > 0) {
                return $results->offsetGet(0);
            }

            return null;
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

    /**
     * @param string $customerId
     * @param PaymentDTO $paymentDTO
     * @return Card
     */
    public function createCard(string $customerId, PaymentDTO $paymentDTO): Card
    {
        try {
            // Create Card
            $card = new Card();
            $card->token = $paymentDTO->getToken();
            $card->customer_id = $customerId;
            $card->issuer = $paymentDTO->getIssuerId();
            $card->payment_method = $paymentDTO->getPaymentTypeId();
            $card->save();

            Log::info("card created", [
                'id' => $card->id,
                'customer_id' => $card->customer_id,
                'issuer' => $card->issuer,
                'payment_method' => $card->payment_method,
                'file' => __FILE__,
            ]);

            return $card;
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}

