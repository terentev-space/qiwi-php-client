<?php

namespace QiwiClient;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Psr\Log\LoggerInterface;
use QiwiClient\Entities\ClientResponse;
use QiwiClient\Entities\Queries\PaySiteBillQuery;
use QiwiClient\Entities\Responses\GetSiteBillDetailsResponse;
use QiwiClient\Entities\Responses\PaySiteBillResponse;
use QiwiClient\Exceptions\BadRequestException;
use QiwiClient\Exceptions\CallMethodException;
use QiwiClient\Exceptions\ForbiddenRequestException;
use QiwiClient\Exceptions\InternalErrorRequestException;
use QiwiClient\Exceptions\MethodNotAllowedRequestException;
use QiwiClient\Exceptions\NotFoundException;
use QiwiClient\Exceptions\QiwiClientException;
use QiwiClient\Exceptions\RequestException;
use QiwiClient\Exceptions\UnauthorizedRequestException;
use QiwiClient\Exceptions\UnknownMethodException;
use QiwiClient\Interfaces\Arrayable;
use QiwiClient\Interfaces\ClientAdapterInterface;
use QiwiClient\Interfaces\ClientConfigInterface;
use QiwiClient\Interfaces\ClientInterface;
use QiwiClient\Interfaces\ClientResponseInterface;
use Throwable;

/**
 * A client for accessing the Qiwi API.
 *
 * @method PaySiteBillResponse paySiteBill(PaySiteBillQuery|Arrayable|array $query)
 * @method GetSiteBillDetailsResponse getSiteBillDetails(string $billId)
 */
class Client implements ClientInterface
{
    public const HTTP_GET = 'GET';
    public const HTTP_POST = 'POST';
    public const HTTP_PUT = 'PUT';
    public const HTTP_DELETE = 'DELETE';

    public const PARAM_SITE_ID = 'siteId';

    /**
     * @var HttpClientInterface|HttpClient
     */
    protected $http;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ClientAdapterInterface|null
     */
    private $adapter = null;

    /**
     * Client constructor.
     *
     * @param ClientConfigInterface $config
     * @param HttpClientInterface|null $http
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        ClientConfigInterface $config,
        HttpClientInterface $http,
        LoggerInterface $logger
    ) {
        $this->config = $config;
        $this->http = $http;
        $this->logger = $logger;
    }

    private function getOrInitAdapter(): ClientAdapterInterface
    {
        if (!($this->adapter instanceof Adapter)) {
            $this->adapter = new Adapter($this);
        }

        return $this->adapter;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return ClientResponseInterface
     * @throws RequestException
     * @throws UnauthorizedRequestException|ForbiddenRequestException|InternalErrorRequestException
     */
    public function request(string $method, string $uri, array $data = []): ClientResponseInterface
    {
        $uri = $this->processRequestUri($uri, [
            self::PARAM_SITE_ID => $this->config->getSiteId(),
        ]);
        $this->checkRequest($method, $uri, $data);

        $code = null;
        try {
            switch ($method) {
                case self::HTTP_GET:
                    $response = $this->http->get(
                        $uri . '?' . http_build_query($data),
                        [
                            'headers' => $this->getHeaders(),
                        ]
                    );
                    break;
                case self::HTTP_POST:
                    $response = $this->http->post(
                        $uri,
                        [
                            'headers' => $this->getHeaders(),
                            'json' => $data
                        ]
                    );
                    break;
                case self::HTTP_PUT:
                    $response = $this->http->put(
                        $uri,
                        [
                            'headers' => $this->getHeaders(),
                            'json' => $data
                        ]
                    );
                    break;
                case self::HTTP_DELETE:
                    $response = $this->http->delete(
                        $uri,
                        [
                            'headers' => $this->getHeaders(),
                            'json' => $data
                        ]
                    );
                    break;
            }

            $code = $response->getStatusCode();
            $body = $this->getResponseBody($response->getBody()->getContents());

            return new ClientResponse($code, $body);
        } catch (\GuzzleHttp\Exception\RequestException $ex) {
            if ($ex->getResponse()) {
                switch ($ex->getResponse()->getStatusCode())
                {
                    case 400:
                        $data400 = json_decode($ex->getResponse()->getBody()->getContents(), true);
                        throw new BadRequestException(
                            'Bad request',
                            0,
                            $ex,
                            $data400['serviceName'] ?? null,
                            $data400['errorCode'] ?? null,
                            $data400['description'] ?? null,
                            $data400['userMessage'] ?? null,
                            $data400['dateTime'] ?? null,
                            $data400['traceId'] ?? null,
                            $data400['cause'] ?? []
                        );
                    case 401:
                        throw new UnauthorizedRequestException('Unauthorized', 0, $ex);
                    case 403:
                        throw new ForbiddenRequestException('Forbidden', 0, $ex);
                    case 404:
                        $data404 = json_decode($ex->getResponse()->getBody()->getContents(), true);
                        throw new NotFoundException(
                            'Not found',
                            0,
                            $ex,
                            $data404['serviceName'] ?? null,
                            $data404['errorCode'] ?? null,
                            $data404['description'] ?? null,
                            $data404['userMessage'] ?? null,
                            $data404['dateTime'] ?? null,
                            $data404['traceId'] ?? null,
                            $data404['cause'] ?? []
                        );
                    case 405:
                        $data405 = json_decode($ex->getResponse()->getBody()->getContents(), true);
                        throw new MethodNotAllowedRequestException(
                            'Method not allowed',
                            0,
                            $ex,
                            $data405['serviceName'] ?? null,
                            $data405['errorCode'] ?? null,
                            $data405['description'] ?? null,
                            $data405['userMessage'] ?? null,
                            $data405['dateTime'] ?? null,
                            $data405['traceId'] ?? null,
                            $data405['cause'] ?? []
                        );
                    case 500:
                        throw new InternalErrorRequestException('Internal server error', 0, $ex);
                }
            }
            throw new RequestException($ex->getMessage(), 0, $ex);
        } catch (Throwable $ex) {
            throw new RequestException('Call failed', 0, $ex);
        } finally {
            $this->logRequest($method, $uri, $data, $code);
        }
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param null $code
     */
    private function logRequest(string $method, string $uri, array $data = [], $code = null): void
    {
        try {
            if ($this->logger instanceof LoggerInterface) {
                $this->logger->debug(
                    sprintf('[QIWI] Request to "%s" "%s" code: "%s"', $method, $uri, $code),
                    [$method, $uri, $data, $code]
                );
            }
        } catch (Throwable $ex) {
        }
    }

    /**
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     *
     * @throws CallMethodException
     * @throws UnknownMethodException
     */
    public function __call(string $method, array $parameters)
    {
        try {
            $adapter = $this->getOrInitAdapter();

            if (method_exists($adapter, $method)) {
                return $adapter->$method(...$parameters);
            }
        } catch (QiwiClientException $ex) {
            throw $ex;
        } catch (Throwable $ex) {
            throw new CallMethodException($method, 0, $ex);
        }

        throw new UnknownMethodException($method);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @throws QiwiClientException
     */
    protected function checkRequest(string $method, string $uri, array $data = []): void
    {
        if (!in_array($method, [
            static::HTTP_GET,
            static::HTTP_POST,
            static::HTTP_PUT,
            static::HTTP_DELETE,
        ])) {
            throw new QiwiClientException(sprintf('Wrong http request "%s" method "%s"', $uri, $method));
        }
        if (empty($uri)) {
            throw new QiwiClientException(sprintf('Wrong http request uri "%s"', $uri));
        }
    }

    protected function processRequestUri(string $uri, array $params): string
    {
        foreach ($params as $key => $value) {
            $uri = str_replace("{{$key}}", $value, $uri);
        }
        return $uri;
    }

    protected function getResponseBody($content): array
    {
        return json_decode($content, true);
    }

    private function getHeaders(): array
    {
        return [
            'Content-type' => 'application/json',
            'Authorization' => "Bearer {$this->config->getToken()}",
        ];
    }
}
