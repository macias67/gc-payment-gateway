<?php

namespace App\Services;

class PaymentServiceFactory
{
    public static function createService($provider)
    {
        switch ($provider) {
            case 'mercadopago':
                return new MercadoPagoService();
            case 'stripe':
                return new StripeService();
            case 'conekta':
                return new ConektaService();
            default:
                throw new \InvalidArgumentException('Invalid payment provider');
        }
    }
}
