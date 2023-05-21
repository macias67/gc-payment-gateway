<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentServiceFactory;
use App\Services\PaymentServiceInterface;

class PaymentServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->app->bind(PaymentServiceInterface::class, function ($app) {
            $provider = config('payment.default_provider');
            return PaymentServiceFactory::createService($provider);
        });
    }
}

