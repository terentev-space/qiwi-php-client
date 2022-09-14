<?php

namespace QiwiClient\Exceptions;

use Throwable;

class MethodNotAllowedRequestException extends RequestException
{
    /**
     * @var string|null
     */
    private $serviceName;
    /**
     * @var string|null
     */
    private $errorCode;
    /**
     * @var string|null
     */
    private $description;
    /**
     * @var string|null
     */
    private $userMessage;
    /**
     * @var string|null
     */
    private $dateTime;
    /**
     * @var string|null
     */
    private $traceId;
    /**
     * @var array
     */
    private $errors;

    public function __construct(
        string $message,
        $code = 0,
        Throwable $previous = null,
        ?string $serviceName = null,
        ?string $errorCode = null,
        ?string $description = null,
        ?string $userMessage = null,
        ?string $dateTime = null,
        ?string $traceId = null,
        array $errors = []
    ) {
        parent::__construct($message, $code, $previous);
        $this->serviceName = $serviceName;
        $this->errorCode = $errorCode;
        $this->description = $description;
        $this->userMessage = $userMessage;
        $this->dateTime = $dateTime;
        $this->traceId = $traceId;
        $this->errors = $errors;
    }

    /**
     * @return string|null
     */
    public function getServiceName(): ?string
    {
        return $this->serviceName;
    }

    /**
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getUserMessage(): ?string
    {
        return $this->userMessage;
    }

    /**
     * @return string|null
     */
    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    /**
     * @return string|null
     */
    public function getTraceId(): ?string
    {
        return $this->traceId;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
