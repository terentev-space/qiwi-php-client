<?php

namespace QiwiClient\Factories;

use QiwiClient\Entities\ClientConfig;
use QiwiClient\Interfaces\ClientConfigInterface;

class ConfigFactory
{
    public function make(
        string $siteId,
        string $token,
        ?string $publicKey = null
    ): ClientConfigInterface {
        return new ClientConfig(
            $siteId,
            $publicKey ?? '',
            $token
        );
    }
}
