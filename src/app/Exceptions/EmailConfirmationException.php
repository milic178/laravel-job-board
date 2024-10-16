<?php

namespace App\Exceptions;

use Exception;

class EmailConfirmationException extends Exception
{
    protected $errorCode;

    public function __construct(string $message, int $errorCode = 0)
    {
        parent::__construct($message);
        $this->errorCode = $errorCode;
    }

    public function render($request)
    {
        return response()->view('emailConfirmed', [
            'error' => $this->getMessage(),
            'errorCode' => $this->errorCode,
        ], $this->errorCode ?: 400);
    }
}
