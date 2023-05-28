<?php

namespace App\DTO;

use JsonException;

class PaymentDTO
{
    private int $issuerId;
    private string $paymentMethodId;
    private string $email;
    private string $token;
    private int $installments;
    private float $amount;
    private int $idp;

    public function __construct($data)
    {
        $this->issuerId = $data['issuer_id'];
        $this->paymentMethodId = $data['payment_method_id'];
        $this->email = $data['payer']['email'];
        $this->token = $data['token'];
        $this->installments = $data['installments'];
        $this->amount = $data['transaction_amount'];
        $this->idp = $data['idp'];
    }

    /**
     * @param $issuer
     * @return void
     */
    public function setIssuerId($issuer) : void
    {
        $this->issuerId = $issuer;
    }

    /**
     * @return int
     */
    public function getIssuerId(): int
    {
        return (int) $this->issuerId;
    }

    /**
     * @return string
     */
    public function getPaymentMethodId(): string
    {
        return $this->paymentMethodId;
    }

    /**
     * @param string $paymentMethodId
     * @return void
     */
    public function setPaymentMethodId(string $paymentMethodId): void
    {
        $this->paymentMethodId = $paymentMethodId;
    }

    /**
     * @param $paymentTypeId
     * @return void
     */
    public function setPaymentTypeId($paymentTypeId) : void
    {
        // $this->paymentTypeId = $paymentTypeId;
    }

    /**
     * @return array
     */
    public function getPaymentTypeId() : array
    {
        // return $this->paymentTypeId;
        return [];
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param $token
     * @return void
     */
    public function setToken($token) : void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * @param $amount
     * @return void
     */
    public function setAmount($amount) : void
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return (float)$this->amount;
    }

    /**
     * @return int
     */
    public function getInstallments(): int
    {
        return $this->installments;
    }

    /**
     * @param int $installments
     */
    public function setInstallments(int $installments): void
    {
        $this->installments = $installments;
    }

    /**
     * @return int
     */
    public function getIdp(): int
    {
        return $this->idp;
    }

    /**
     * @param int $idp
     */
    public function setIdp(int $idp): void
    {
        $this->idp = $idp;
    }

    /**
     * @throws JsonException
     */
    public function toJson()
    {
        return json_encode(get_object_vars($this), JSON_THROW_ON_ERROR);
    }
}

