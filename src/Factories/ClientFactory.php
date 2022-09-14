<?php

namespace QiwiClient\Factories;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Client as HttpClient;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use QiwiClient\Client;
use QiwiClient\Entities\ClientConfig;

class ClientFactory
{
    public function make(
        string $siteId,
        string $token,
        ?string $publicKey = null,
        ?HttpClientInterface $http = null,
        ?LoggerInterface $logger = null
    ): Client {
        return new Client(
            new ClientConfig(
                $siteId,
                $publicKey ?? '',
                $token
            ),
            $http ?? new HttpClient(),
            $logger ?? new NullLogger()
        );
    }
}
