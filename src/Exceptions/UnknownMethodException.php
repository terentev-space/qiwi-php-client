<?php

namespace QiwiClient\Exceptions;

use Throwable;

class UnknownMethodException extends QiwiClientException
{
    public function __construct(string $method, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf(
                'Unknown qiwi client method "%s"',
                $method
            ),
            $code,
            $previous
        );
    }
}
