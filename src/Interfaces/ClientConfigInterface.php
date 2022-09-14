<?php

namespace QiwiClient\Interfaces;

interface ClientConfigInterface
{
    public function getSiteId(): string;
    public function getPublicKey(): string;
    public function getToken(): string;
}
