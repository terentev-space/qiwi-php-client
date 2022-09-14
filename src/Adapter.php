<?php

namespace QiwiClient;

use QiwiClient\Entities\Queries\PaySiteBillQuery;
use QiwiClient\Entities\Responses\GetSiteBillDetailsResponse;
use QiwiClient\Entities\Responses\PaySiteBillResponse;
use QiwiClient\Exceptions\InvalidQueryArgumentException;
use QiwiClient\Interfaces\Arrayable;
use QiwiClient\Interfaces\ClientAdapterInterface;
use QiwiClient\Interfaces\ClientInterface;
use QiwiClient\Interfaces\QueryInterface;

class Adapter implements ClientAdapterInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param PaySiteBillQuery|Arrayable|array $query
     * @return PaySiteBillResponse
     * @throws InvalidQueryArgumentException
     * @link PUT https://api.qiwi.com/partner/payin/v1/sites/{siteId}/bills/{billId}
     * @see https://developer.qiwi.com/ru/payments/#qiwi-form-invoice-api
     */
    public function paySiteBill($query): PaySiteBillResponse
    {
        $this->checkQuery($query);
        $data = $query instanceof Arrayable ? $query->toArray() : (array)$query;
        $billId = $data['billId'];
        unset($data['billId']);
        $response = $this->getClient()->request(
            Client::HTTP_PUT,
            "https://api.qiwi.com/partner/payin/v1/sites/{siteId}/bills/{$billId}",
            $data
        );
        return new PaySiteBillResponse(
            $response->getCode(),
            $response->getBody()
        );
    }

    /**
     * @param string $billId
     * @return GetSiteBillDetailsResponse
     * @link GET https://api.qiwi.com/partner/payin/v1/sites/{siteId}/bills/{billId}
     * @see https://developer.qiwi.com/ru/payments/#invoice-details
     */
    public function getSiteBillDetails(string $billId): GetSiteBillDetailsResponse
    {
        $response = $this->getClient()->request(
            Client::HTTP_GET,
            "https://api.qiwi.com/partner/payin/v1/sites/{siteId}/bills/{$billId}/details"
        );
        return new GetSiteBillDetailsResponse(
            $response->getCode(),
            $response->getBody()
        );
    }

    /**
     * @param $query
     * @throws InvalidQueryArgumentException
     */
    private function checkQuery($query): void
    {
        if (is_array($query)) {
            return;
        }
        if ($query instanceof QueryInterface) {
            return;
        }
        if ($query instanceof Arrayable) {
            return;
        }
        if (method_exists($query, 'toArray')) {
            return;
        }
        throw new InvalidQueryArgumentException(
            'The query is not an array and does not contain the toArray method'
        );
    }
}
