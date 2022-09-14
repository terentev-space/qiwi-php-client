<?php

namespace QiwiClient\Interfaces;

interface ClientInterface
{
    public function request(string $method, string $uri, array $data = []): ClientResponseInterface;
}
