<?php

namespace App\Services;

use App\DTO\PaymentDTO;
use Exception;
use Faker\Factory;
use MercadoPago\Card;
use MercadoPago\Customer;
use MercadoPago\Payment;
use MercadoPago\SDK;

class MercadoPagoService implements PaymentServiceInterface
{
    public function __construct()
    {
        SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
    }

    /**
     * @param PaymentDTO $paymentDTO
     * @return Customer
     */
    public function createCustomer(PaymentDTO $paymentDTO): \MercadoPago\Customer
    {
        try {
            // Create Customer
            $customer = new Customer();
            // $customer->email = Factory::create()->email;
            $customer->email = $paymentDTO->getEmail();
            $customer->save();

            dd($customer);

            return $customer;
        } catch (Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }

    }

    /**
     * @param string $customerId
     * @param PaymentDTO $paymentDTO
     * @return Payment
     */
    public function createPayment(string $customerId, PaymentDTO $paymentDTO) : \MercadoPago\Payment
    {
        try {
            $payment = new Payment();

            $payment->transaction_amount = $paymentDTO->getAmount();
            $payment->token = $paymentDTO->getToken();
            $payment->installments = 1;
            $payment->payer = [
                "type" => "customer",
                "id" => $customerId
            ];
            $payment->save();

            return $payment;
        } catch (Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }

    /**
     * @param string $email
     * @return Customer|null
     */
    public function getCustomer(string $email) : ?\MercadoPago\Customer
    {
        try {
            $filters = [ "email" => $email ];
            $results = Customer::search($filters);

            if ($results->count() > 0) {
                return $results->offsetGet(0);
            }

            return null;
        } catch (Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }

    /**
     * @param string $customerId
     * @param PaymentDTO $paymentDTO
     * @return Card
     */
    public function createCard(string $customerId, PaymentDTO $paymentDTO) : \MercadoPago\Card
    {
        try {
            // Create Card
            $card = new Card();
            $card->token = $paymentDTO->getToken();
            $card->customer_id = $customerId;
            $card->issuer = $paymentDTO->getIssuer();
            $card->payment_method = $paymentDTO->getPaymentTypeId();
            $card->save();

            return $card;
        } catch (Exception $exception) {
            throw new \RuntimeException($exception->getMessage());
        }
    }
}

