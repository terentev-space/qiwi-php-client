<?php

namespace QiwiClient\Entities\Queries;

use DateTime;
use DateTimeInterface;
use QiwiClient\Interfaces\QueryInterface;
use QiwiClient\Qiwi;

class PaySiteBillQuery implements QueryInterface
{
    /**
     * @var string
     */
    private $billId;
    /**
     * @var float
     */
    private $amountValue;
    /**
     * @var string
     */
    private $amountCurrency;
    /**
     * @var string
     */
    private $expirationDateTime;
    /**
     * @var array|string[]
     */
    private $flags;
    /**
     * @var array|null
     */
    private $customer;
    /**
     * @var array|null
     */
    private $address;
    /**
     * @var array|null
     */
    private $receiverData;
    /**
     * @var array|null
     */
    private $customFields;
    /**
     * @var mixed
     */
    private $cheque;

    /**
     * @param string $billId - Уникальный идентификатор счета в информационной системе ТСП. Уникальность означает, что идентификатор должен отличаться от идентификаторов всех ранее созданных счетов ТСП в рамках одного siteId.
     * @param float $amountValue - Сумма операции (округленная до двух десятичных знаков в меньшую сторону).
     * @param string $amountCurrency - Валюта в буквенном формате согласно ISO 4217.
     * @return PaySiteBillQuery
     */
    public static function make(
        string $billId,
        float $amountValue,
        string $amountCurrency
    ): PaySiteBillQuery {
        return (new PaySiteBillQuery(
            $billId,
            $amountValue,
            $amountCurrency
        ));
    }

    /**
     * PaySiteBillQuery constructor.
     * @param string $billId - Уникальный идентификатор счета в информационной системе ТСП. Уникальность означает, что идентификатор должен отличаться от идентификаторов всех ранее созданных счетов ТСП в рамках одного siteId.
     * @param float $amountValue - Сумма операции (округленная до двух десятичных знаков в меньшую сторону).
     * @param string $amountCurrency - Валюта в буквенном формате согласно ISO 4217.
     */
    public function __construct(
        string $billId,
        float $amountValue,
        string $amountCurrency
    ) {
        $this->billId = $billId;
        $this->amountValue = $amountValue;
        $this->amountCurrency = $amountCurrency;
    }

    /**
     * @param DateTimeInterface|string|null $value - Дата, до которой счет будет доступен для оплаты, в формате ISO8601 (YYYY-MM-DDThh:mm:ss±hh:ss). Если счет не будет оплачен до этой даты, последующая оплата станет невозможна.
     * @return $this
     */
    public function setExpirationDateTime($value = null): self
    {
        if ($value instanceof DateTimeInterface) {
            $this->expirationDateTime = $value->format(Qiwi::DATETIME_FORMAT);
        } elseif (!empty($value)) {
            $this->expirationDateTime = $value;
        } else {
            $this->expirationDateTime = (new DateTime('+1 day'))->format(Qiwi::DATETIME_FORMAT);
        }
        return $this;
    }

    /**
     * @param string ...$value
     * @return $this
     */
    public function setFlags(...$value): self
    {
        $this->flags = $value;
        return $this;
    }

    /**
     * @param string $account 64 - Уникальный идентификатор Покупателя в системе ТСП.
     * @param string|null $email 64 - E-mail Покупателя.
     * @param string|null $phone 15 - Контактный телефон Покупателя.
     * @return $this
     */
    public function setCustomer(string $account, ?string $email = null, ?string $phone = null): self
    {
        $this->customer = [
            'account' => $account,
            'email' => $email,
            'phone' => $phone,
        ];
        return $this;
    }

    /**
     * @param string|null $country 1000 - Страна Покупателя.
     * @param string|null $city 1000 - Город местонахождения Покупателя.
     * @param string|null $region 1000 - Округ, регион, область, штат.
     * @param string|null $details 1000 - Адрес местонахождения Покупателя (улица, дом).
     * @return $this
     */
    public function setAddress(
        ?string $country = null,
        ?string $city = null,
        ?string $region = null,
        ?string $details = null
    ): self {
        $this->address = [
            'country' => $country,
            'city' => $city,
            'region' => $region,
            'details' => $details,
        ];
        return $this;
    }

    /**
     * @param string|null $pan 19 - Номер карты получателя денежного перевода. Указывается для операций денежных переводов.
     * @param string|null $wallet 64 - Номер кошелька получателя платежа. Указывается при пополнении кошелька.
     * @param string|null $inn 12 - ИНН организации-эмитента кошелька. Указывается при пополнении кошелька.
     * @param string|null $phone 15 - Номер телефона получателя платежа. Указывается при пополнении телефона.
     * @param string|null $bankAccount 20 - Номер счета получателя платежа. Указывается для операций денежных переводов.
     * @param string|null $bic 9 - БИК кредитной организации получателя платежа. Указывается для операций денежных переводов.
     * @return $this
     */
    public function setReceiverData(
        ?string $pan = null,
        ?string $wallet = null,
        ?string $inn = null,
        ?string $phone = null,
        ?string $bankAccount = null,
        ?string $bic = null
    ): self {
        $this->receiverData = [
            'pan' => $pan,
            'wallet' => $wallet,
            'inn' => $inn,
            'phone' => $phone,
            'bankAccount' => $bankAccount,
            'bic' => $bic,
        ];
        return $this;
    }

    /**
     * @param string|null $cf1 256 - Поле для произвольной информации, дополняющей данные по операции.
     * @param string|null $cf2 256 - Поле для произвольной информации, дополняющей данные по операции.
     * @param string|null $cf3 256 - Поле для произвольной информации, дополняющей данные по операции.
     * @param string|null $cf4 256 - Поле для произвольной информации, дополняющей данные по операции.
     * @param string|null $cf5 256 - Поле для произвольной информации, дополняющей данные по операции.
     * @param string|null $merchantThemeCode 256 - Код стиля для применения к платежной форме.
     * @param string|null $merchantContractId 256 - Номер договора.
     * @param string|null $merchantBookingNumber 256 - Номер бронирования.
     * @param string|null $merchantPhone 256 - Мобильный телефон покупателя.
     * @param string|null $merchantFullName 256 - ФИО покупателя.
     * @param string|null $invoiceCallbackUrl 256 - URL отправки уведомления по операции.
     * @return $this
     */
    public function setCustomFields(
        ?string $cf1 = null,
        ?string $cf2 = null,
        ?string $cf3 = null,
        ?string $cf4 = null,
        ?string $cf5 = null,
        ?string $merchantThemeCode = null,
        ?string $merchantContractId = null,
        ?string $merchantBookingNumber = null,
        ?string $merchantPhone = null,
        ?string $merchantFullName = null,
        ?string $invoiceCallbackUrl = null
    ): self {
        $this->customFields = [
            'cf1' => $cf1,
            'cf2' => $cf2,
            'cf3' => $cf3,
            'cf4' => $cf4,
            'cf5' => $cf5,
            'merchantThemeCode' => $merchantThemeCode,
            'merchantContractId' => $merchantContractId,
            'merchantBookingNumber' => $merchantBookingNumber,
            'merchantPhone' => $merchantPhone,
            'merchantFullName' => $merchantFullName,
            'invoiceCallbackUrl' => $invoiceCallbackUrl,
        ];
        return $this;
    }

    /**
     * @param $object - Данные чека для операции.
     * @return $this
     */
    public function setCheque($object): self
    {
        $this->cheque = $object;
        return $this;
    }

    /**
     * @return string - Уникальный идентификатор счета в информационной системе ТСП. Уникальность означает, что идентификатор должен отличаться от идентификаторов всех ранее созданных счетов ТСП в рамках одного siteId.
     */
    public function getBillId(): string
    {
        return $this->billId;
    }

    public function toArray(): array
    {
        $data = [
            'billId' => $this->getBillId(),
            'amount' => [
                'value' => $this->getAmountValue(),
                'currency' => $this->amountCurrency,
            ],
        ];
        if (!empty($this->expirationDateTime)) {
            $data['expirationDateTime'] = $this->expirationDateTime;
        }
        if (!empty($this->flags)) {
            $data['flags'] = $this->flags;
        }
        if (!empty($this->customer)) {
            $data['customer'] = $this->customer;
        }
        if (!empty($this->address)) {
            $data['address'] = $this->address;
        }
        if (!empty($this->receiverData)) {
            $data['receiverData'] = $this->receiverData;
        }
        if (!empty($this->customFields)) {
            $data['customFields'] = $this->customFields;
        }
        if (!empty($this->cheque)) {
            $data['cheque'] = $this->cheque;
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getAmountValue(): string
    {
        return number_format($this->amountValue, 2);
    }
}
