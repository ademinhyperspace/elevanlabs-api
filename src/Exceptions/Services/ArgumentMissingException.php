<?php

namespace Shahinyanm\ElevenlabsApi\Exceptions\Services;

use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Response;

class ArgumentMissingException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): Response
    {
        return response([
            'error' => 422,
            'message' => "Arguments is missing: $this->message",
            'help' => 'Add necessary arguments in called method, and make sure it\'s correct.'
        ]);
    }
}
