<?php

namespace Services\Routing\Exception;

use HttpException;
use Throwable;

class BadMethodHttpException extends HttpException
{
    public function __construct(string $message = "", int $code = 405, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
