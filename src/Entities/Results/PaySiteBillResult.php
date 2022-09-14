<?php

namespace QiwiClient\Entities\Results;

class PaySiteBillResult
{
    /**
     * @var string
     */
    private $billId;
    /**
     * @var string
     */
    private $invoiceUid;
    /**
     * @var string
     */
    private $amountCurrency;
    /**
     * @var string
     */
    private $amountValue;
    /**
     * @var string
     */
    private $expirationDateTime;
    /**
     * @var string
     */
    private $statusValue;
    /**
     * @var string
     */
    private $statusChangedDateTime;
    /**
     * @var string
     */
    private $payUrl;

    public function __construct(
        string $billId,
        string $invoiceUid,
        string $amountCurrency,
        string $amountValue,
        string $expirationDateTime,
        string $statusValue,
        string $statusChangedDateTime,
        string $payUrl
    )
    {
        $this->billId = $billId;
        $this->invoiceUid = $invoiceUid;
        $this->amountCurrency = $amountCurrency;
        $this->amountValue = $amountValue;
        $this->expirationDateTime = $expirationDateTime;
        $this->statusValue = $statusValue;
        $this->statusChangedDateTime = $statusChangedDateTime;
        $this->payUrl = $payUrl;
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
    public function getInvoiceUid(): string
    {
        return $this->invoiceUid;
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
    public function getAmountValue(): string
    {
        return $this->amountValue;
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
     * @return string
     */
    public function getPayUrl(): string
    {
        return $this->payUrl;
    }
}
