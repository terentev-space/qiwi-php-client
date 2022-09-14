<?php

namespace QiwiClient\Interfaces;

interface ClientResponseInterface
{
    public function getCode(): int;
    public function getBody(): array;

    public function parseData();
}
