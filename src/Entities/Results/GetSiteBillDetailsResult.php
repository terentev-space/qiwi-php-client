<?php

namespace QiwiClient\Entities\Results;

use QiwiClient\Entities\Items\SiteBillPayment;

class GetSiteBillDetailsResult
{
    /**
     * @var string
     */
    private $billId;
    /**
     * @var string
     */
    private $amountValue;
    /**
     * @var string
     */
    private $amountCurrency;
    /**
     * @var string
     */
    private $statusValue;
    /**
     * @var string
     */
    private $statusChangedDateTime;
    /**
     * @var string|null
     */
    private $comment;
    /**
     * @var array|mixed|object
     */
    private $customFields;
    /**
     * @var string
     */
    private $expirationDateTime;
    /**
     * @var string
     */
    private $payUrl;
    /**
     * @var array|SiteBillPayment[]
     */
    private $payments;

    /**
     * GetSiteBillDetailsResult constructor.
     * @param string $billId
     * @param string $amountValue
     * @param string $amountCurrency
     * @param string $statusValue
     * @param string $statusChangedDateTime
     * @param string|null $comment
     * @param array|object|mixed|null $customFields
     * @param string $expirationDateTime
     * @param string $payUrl
     * @param array|SiteBillPayment[] $payments
     */
    public function __construct(
        string $billId,
        string $amountValue,
        string $amountCurrency,
        string $statusValue,
        string $statusChangedDateTime,
        ?string $comment,
        $customFields,
        string $expirationDateTime,
        string $payUrl,
        array $payments
    )
    {
        $this->billId = $billId;
        $this->amountValue = $amountValue;
        $this->amountCurrency = $amountCurrency;
        $this->statusValue = $statusValue;
        $this->statusChangedDateTime = $statusChangedDateTime;
        $this->comment = $comment;
        $this->customFields = $customFields;
        $this->expirationDateTime = $expirationDateTime;
        $this->payUrl = $payUrl;
        $this->payments = $payments;
    }

    /**
     * @return string
     */
    public function getBillId(): string
    {
        return $this->billId;
    }

    /**
     * @return string
     */
    public function getAmountValue(): string
    {
        return $this->amountValue;
    }

    /**
     * @return string
     */
    public function getAmountCurrency(): string
    {
        return $this->amountCurrency;
    }

    /**
     * @return string
     */
    public function getStatusValue(): string
    {
        return $this->statusValue;
    }

    /**
     * @return string
     */
    public function getStatusChangedDateTime(): string
    {
        return $this->statusChangedDateTime;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return array|mixed|object
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @return string
     */
    public function getExpirationDateTime(): string
    {
        return $this->expirationDateTime;
    }

    /**
     * @return string
     */
    public function getPayUrl(): string
    {
        return $this->payUrl;
    }

    /**
     * @return array|SiteBillPayment[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }
}
