<?php

namespace QiwiClient\Interfaces;

interface ClientAdapterInterface
{
    public function getClient() : ClientInterface;
}
