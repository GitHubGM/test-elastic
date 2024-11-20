<?php

namespace App\Exceptions\Products;

use Exception;

class NotFoundSearch extends Exception
{
    protected $message = 'К сожалению, мы ничего не нашли по Вашему запросу.';
    protected $code = 404;

    public function render($request)
    {
        return response()->json([
            'message' => $this->message,
        ], $this->code);
    }
}
