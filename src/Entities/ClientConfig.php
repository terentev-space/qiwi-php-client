<?php

namespace QiwiClient\Entities;

use QiwiClient\Interfaces\ClientConfigInterface;

class ClientConfig implements ClientConfigInterface
{
    /**
     * @var string
     */
    private $siteId;
    /**
     * @var string
     */
    private $publicKey;
    /**
     * @var string
     */
    private $token;

    /**
     * ClientConfig constructor.
     * @param string $siteId - Site ID
     * @param string $publicKey - Public Key
     * @param string $token - Токен
     * @link https://kassa.qiwi.com/service/settings/agent/{siteKey}
     */
    public function __construct(
        string $siteId,
        string $publicKey,
        string $token
    ) {
        $this->siteId = $siteId;
        $this->publicKey = $publicKey;
        $this->token = $token;
    }

    public function getSiteId(): string
    {
        return $this->siteId;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
