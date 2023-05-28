<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomerException extends Exception
{
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    public function getResponseMessage(): string
    {
        return "Error al crear cliente";
    }
}
