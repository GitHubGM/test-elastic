<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $message = '';
    protected $code = 422;

    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
        ], $this->code);
    }
}
