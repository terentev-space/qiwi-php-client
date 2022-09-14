<?php

namespace QiwiClient\Exceptions;

use Throwable;

class CallMethodException extends QiwiClientException
{
    public function __construct(string $method, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Qiwi client method "%s" error',
                $method
            ),
            $code,
            $previous
        );
    }
}
