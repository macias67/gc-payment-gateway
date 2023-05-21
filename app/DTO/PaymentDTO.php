<?php

namespace App\DTO;

class PaymentDTO
{
    private array $issuer;
    private array $paymentTypeId;
    private string $email;
    private string $token;
    private float $amount;

    public function __construct($data)
    {
        $this->issuer = $data['issuer'][0];
        $this->paymentTypeId = $data['payment_type_id'][0];
        $this->email = $data['email'];
        $this->token = $data['token'];
        $this->amount = $data['amount'];
    }

    public function setIssuer($issuer) : void
    {
        $this->issuer = $issuer;
    }

    public function getIssuer(): array
    {
        return $this->issuer;
    }

    public function setPaymentTypeId($paymentTypeId) : void
    {
        $this->paymentTypeId = $paymentTypeId;
    }

    public function getPaymentTypeId() : array
    {
        return $this->paymentTypeId;
    }

    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setToken($token) : void
    {
        $this->token = $token;
    }

    public function getToken() : string
    {
        return $this->token;
    }

    public function setAmount($amount) : void
    {
        $this->amount = $amount;
    }

    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @throws \JsonException
     */
    public function toJson()
    {
        return json_encode(get_object_vars($this), JSON_THROW_ON_ERROR);
    }
}

