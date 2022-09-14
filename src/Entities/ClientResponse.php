<?php

namespace QiwiClient\Entities;

use QiwiClient\Interfaces\ClientResponseInterface;

class ClientResponse implements ClientResponseInterface
{
    /**
     * @var int
     */
    private $code;
    /**
     * @var array
     */
    private $body;

    public function __construct(int $code, array $body = [])
    {
        $this->code = $code;
        $this->body = $body;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function parseData()
    {
        return $this->getBody();
    }
}
