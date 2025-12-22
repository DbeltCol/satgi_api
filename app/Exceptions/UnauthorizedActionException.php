<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedActionException extends Exception
{
    public function __construct(string $message = 'No tienes permisos para realizar esta acción.')
    {
        parent::__construct($message);
    }

    public function render($request)
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage(),
        ], Response::HTTP_FORBIDDEN); 
    }
}
