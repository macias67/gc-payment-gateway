<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Throwable;

class PaymentException extends Exception
{
    protected $message;

    protected $code;

    public function __construct(
        $message = "Error al crear pago",
        $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
        $this->code = $code;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getResponseMessage(): string
    {
        return $this->message;
    }
}
