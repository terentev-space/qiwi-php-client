<?php

namespace QiwiClient\Entities\Items;

class SiteBillPayment
{
    /**
     * @var string|null
     */
    private $siteId;
    /**
     * @var string|null
     */
    private $billId;
    /**
     * @var string|null
     */
    private $createdDateTime;
    /**
     * @var string|null
     */
    private $amountCurrency;
    /**
     * @var float|null
     */
    private $amountValue;
    /**
     * @var string|null
     */
    private $capturedAmountCurrency;
    /**
     * @var float|null
     */
    private $capturedAmountValue;
    /**
     * @var string|null
     */
    private $refundedAmountCurrency;
    /**
     * @var float|null
     */
    private $refundedAmountValue;
    /**
     * @var string|null
     */
    private $paymentMethodType;
    /**
     * @var string|null
     */
    private $paymentMethodMaskedPan;
    /**
     * @var string|null
     */
    private $paymentMethodRrn;
    /**
     * @var string|null
     */
    private $paymentMethodAuthCode;
    /**
     * @var string|null
     */
    private $customerAccount;
    /**
     * @var string|null
     */
    private $customerPhone;
    /**
     * @var array|mixed|object
     */
    private $customerAddress;
    /**
     * @var array|mixed|object
     */
    private $requirements;
    /**
     * @var string|null
     */
    private $statusValue;
    /**
     * @var string|null
     */
    private $statusChangedDateTime;
    /**
     * @var string|null
     */
    private $statusReason;
    /**
     * @var array|mixed|object
     */
    private $customFields;

    /**
     * SiteBillPayment constructor.
     * @param string|null $siteId
     * @param string|null $billId
     * @param string|null $createdDateTime
     * @param string|null $amountCurrency
     * @param float|null $amountValue
     * @param string|null $capturedAmountCurrency
     * @param float|null $capturedAmountValue
     * @param string|null $refundedAmountCurrency
     * @param float|null $refundedAmountValue
     * @param string|null $paymentMethodType
     * @param string|null $paymentMethodMaskedPan
     * @param string|null $paymentMethodRrn
     * @param string|null $paymentMethodAuthCode
     * @param string|null $customerAccount
     * @param string|null $customerPhone
     * @param array|object|mixed|null $customerAddress
     * @param array|object|mixed|null $requirements
     * @param string|null $statusValue
     * @param string|null $statusChangedDateTime
     * @param string|null $statusReason
     * @param array|object|mixed|null $customFields
     */
    public function __construct(
        ?string $siteId,
        ?string $billId,
        ?string $createdDateTime,
        ?string $amountCurrency,
        ?float $amountValue,
        ?string $capturedAmountCurrency,
        ?float $capturedAmountValue,
        ?string $refundedAmountCurrency,
        ?float $refundedAmountValue,
        ?string $paymentMethodType,
        ?string $paymentMethodMaskedPan,
        ?string $paymentMethodRrn,
        ?string $paymentMethodAuthCode,
        ?string $customerAccount,
        ?string $customerPhone,
        $customerAddress,
        $requirements,
        ?string $statusValue,
        ?string $statusChangedDateTime,
        ?string $statusReason,
        $customFields
    ) {
        $this->siteId = $siteId;
        $this->billId = $billId;
        $this->createdDateTime = $createdDateTime;
        $this->amountCurrency = $amountCurrency;
        $this->amountValue = $amountValue;
        $this->capturedAmountCurrency = $capturedAmountCurrency;
        $this->capturedAmountValue = $capturedAmountValue;
        $this->refundedAmountCurrency = $refundedAmountCurrency;
        $this->refundedAmountValue = $refundedAmountValue;
        $this->paymentMethodType = $paymentMethodType;
        $this->paymentMethodMaskedPan = $paymentMethodMaskedPan;
        $this->paymentMethodRrn = $paymentMethodRrn;
        $this->paymentMethodAuthCode = $paymentMethodAuthCode;
        $this->customerAccount = $customerAccount;
        $this->customerPhone = $customerPhone;
        $this->customerAddress = $customerAddress;
        $this->requirements = $requirements;
        $this->statusValue = $statusValue;
        $this->statusChangedDateTime = $statusChangedDateTime;
        $this->statusReason = $statusReason;
        $this->customFields = $customFields;
    }

    /**
     * @return string|null
     */
    public function getSiteId(): ?string
    {
        return $this->siteId;
    }

    /**
     * @return string|null
     */
    public function getBillId(): ?string
    {
        return $this->billId;
    }

    /**
     * @return string|null
     */
    public function getCreatedDateTime(): ?string
    {
        return $this->createdDateTime;
    }

    /**
     * @return string|null
     */
    public function getAmountCurrency(): ?string
    {
        return $this->amountCurrency;
    }

    /**
     * @return float|null
     */
    public function getAmountValue(): ?float
    {
        return $this->amountValue;
    }

    /**
     * @return string|null
     */
    public function getCapturedAmountCurrency(): ?string
    {
        return $this->capturedAmountCurrency;
    }

    /**
     * @return float|null
     */
    public function getCapturedAmountValue(): ?float
    {
        return $this->capturedAmountValue;
    }

    /**
     * @return string|null
     */
    public function getRefundedAmountCurrency(): ?string
    {
        return $this->refundedAmountCurrency;
    }

    /**
     * @return float|null
     */
    public function getRefundedAmountValue(): ?float
    {
        return $this->refundedAmountValue;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodType(): ?string
    {
        return $this->paymentMethodType;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodMaskedPan(): ?string
    {
        return $this->paymentMethodMaskedPan;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodRrn(): ?string
    {
        return $this->paymentMethodRrn;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodAuthCode(): ?string
    {
        return $this->paymentMethodAuthCode;
    }

    /**
     * @return string|null
     */
    public function getCustomerAccount(): ?string
    {
        return $this->customerAccount;
    }

    /**
     * @return string|null
     */
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    /**
     * @return array|mixed|object
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * @return array|mixed|object
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @return string|null
     */
    public function getStatusValue(): ?string
    {
        return $this->statusValue;
    }

    /**
     * @return string|null
     */
    public function getStatusChangedDateTime(): ?string
    {
        return $this->statusChangedDateTime;
    }

    /**
     * @return string|null
     */
    public function getStatusReason(): ?string
    {
        return $this->statusReason;
    }

    /**
     * @return array|mixed|object
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }
}
