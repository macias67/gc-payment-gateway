<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Throwable;

class ClientNotFoundException extends Exception
{
    protected $message;

    protected $code;

    public function __construct(
        $message = "El id del cliente no existe",
        $code = Response::HTTP_NOT_FOUND,
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
