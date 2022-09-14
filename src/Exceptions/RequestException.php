<?php

namespace QiwiClient\Exceptions;

use Throwable;

class RequestException extends QiwiClientException
{
    public function __construct(string $message, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}
