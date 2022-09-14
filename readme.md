# Qiwi Php Client

Especially for **[🦊 Zorra Telecom](https://zorra.com)** and **👥 Everyone else**

## Привет
Attention: At the moment the number of methods is very limited, they will be added later if QIWI does not make a normal alternative...
Внимание: На данный момент количество методов сильно ограниченно, они будут добавлены позже, если QIWI не сделает нормальную альтернативу...

## Минимальный набор API - ЕСТЬ

#### ✅ [Создание счета](https://developer.qiwi.com/ru/payments/#invoice_put)
Запрос создает платежный счет.
```
PUT /payin/v1/sites/{siteId}/bills/{billId}
```

#### ✅ [Статус счета](https://developer.qiwi.com/ru/payments/#invoice-details)
Запрос предназначен для получения деталей платежного счета. В успешном ответе приходит список данных по счету и его платежам с запрошенным billId.
```
GET /payin/v1/sites/{siteId}/bills/{billId}/details
```

#### ❔ [Получение списка платежей по счету](https://developer.qiwi.com/ru/payments/#invoice-payments)
Получение списка платежей по счету
```
GET /payin/v1/sites/{siteId}/bills/{billId}
```
_МОЖНО ИСПОЛЬЗОВАТЬ: [Статус счета](https://developer.qiwi.com/ru/payments/#invoice-details)_

#### ❌ [Платеж](https://developer.qiwi.com/ru/payments/#payments)
Запрос создает платежную транзакцию.
```
PUT /payin/v1/sites/{siteId}/payments/{paymentId}
```
_ПОКА НЕ ПРИГОДИЛСЯ_
#### ❔ [Статус платежа](https://developer.qiwi.com/ru/payments/#payment_get)
Получить информацию о платежной транзакции.
```
GET /payin/v1/sites/{siteId}/payments/{paymentId}
```
_ПОКА НЕ ПРИГОДИЛСЯ_

_МОЖНО ИСПОЛЬЗОВАТЬ: [Статус счета](https://developer.qiwi.com/ru/payments/#invoice-details)_

#### ❌ [Завершение аутентификации клиента](https://developer.qiwi.com/ru/payments/#payment_complete)
После успешного прохождения дополнительной аутентификации, ТСП необходимо отправить запрос с параметрами соответствующими типу дополнительной аутентификации для завершения проверки.
```
POST /payin/v1/sites/{siteId}/payments/{paymentId}/complete
```
_ПОКА НЕ ПРИГОДИЛСЯ_

#### ❌ [Подтверждение платежа](https://developer.qiwi.com/ru/payments/#capture)
Подтверждает платеж после холдирования средств. Если используется двухшаговый сценарий, то мерчанту необходимо отправить этот запрос после авторизации платежа.
```
PUT /payin/v1/sites/{siteId}/payments/{paymentId}/captures/{captureId}
```
_ПОКА НЕ ПРИГОДИЛСЯ_

#### ❌ [Статус подтверждения](https://developer.qiwi.com/ru/payments/#capture_get)
Запрашивает статус указанного подтверждения платежа.
```
GET /payin/v1/sites/{siteId}/payments/{paymentId}/captures/{captureId}
```
_ПОКА НЕ ПРИГОДИЛСЯ_

#### ❌ [Операция возврата](https://developer.qiwi.com/ru/payments/#refund-api)
Запрос предназначен для возврата средств по завершенному платежу. ТСП может выполнить несколько запросов для возврата частичных сумм.
```
PUT /payin/v1/sites/{siteId}/payments/{paymentId}/refunds/{refundId}
```
_ПОКА НЕ ПРИГОДИЛСЯ_

## Install

#### Composer
```shell
composer require terentev-space/qiwi-php-client
```

## Usage

1) Set up QIWI: https://developer.qiwi.com/ru/payments/#start
2) Connect the library
3) Prepare
```php
// Factories
$configFactory = new \QiwiClient\Factories\ConfigFactory();
$clientFactory = new \QiwiClient\Factories\ClientFactory();

// Make Config
$config = $configFactory->make(
    'siteId',
    'token',
    'publicKey' // optional
);
/* OR */
$config = new \QiwiClient\Entities\ClientConfig(
    'siteId',
    'publicKey',
    'token'
);

// Make Client
$client = $clientFactory->make(
    'siteId',
    'token',
    'publicKey' // optional
);
/* OR */
$client = Qiwi::client(
    'siteId',
    'token'
);
/* OR */
$client = new \QiwiClient\Client(
    $config,
    new \GuzzleHttp\Client(),
    new \Psr\Log\NullLogger()
);
```
4) Use
```php
$billId = '...';

$amount = 1.01;
/* OR */
$amount = 1.019; // = 1.01

$currency = Qiwi::CURRENCY_RUB;
/* OR */
$currency = 'RUB';

$expiration = null; // +1 day
/* OR */
$expiration = '2022-01-01T00:00:00+00:00';
/* OR */
$expiration = new DateTime();
/* OR */
$expiration = $datetime->format(\QiwiClient\Qiwi::DATETIME_FORMAT);

$flags = [
    \QiwiClient\Qiwi::FLAG_SALE, // optional
    \QiwiClient\Qiwi::FLAG_BIND_PAYMENT_TOKEN, // optional
];

$account = 'string(64) - id';
$email = 'string(64) or null - email';
$phone = 'string(15) or null - phone';

$country = 'string(1000) or null';
$city = 'string(1000) or null';
$region = 'string(1000) or null';
$details = 'string(1000) or null';

$pan = 'string(19) or null';
$wallet = 'string(64) or null';
$inn = 'string(12) or null';
$phone = 'string(15) or null';
$bankAccount = 'string(20) or null';
$bic = 'string(9) or null';

$cf1 = 'string(256) or null';
$cf2 = 'string(256) or null';
$cf3 = 'string(256) or null';
$cf4 = 'string(256) or null';
$cf5 = 'string(256) or null';
$merchantThemeCode = 'string(256) or null';
$merchantContractId = 'string(256) or null';
$merchantBookingNumber = 'string(256) or null';
$merchantPhone = 'string(256) or null';
$merchantFullName = 'string(256) or null';
$invoiceCallbackUrl = 'string(256) or null';

/** @var array $cheque Данные чека для операции. */
$cheque = [/* ... */];

$request = PaySiteBillQuery::make($billId, $amount, $currency)
    ->setExpirationDateTime($expiration) // optional
    ->setFlags(...$flags) // optional
    ->setCustomer(
        $account,
        $email, // optional
        $phone // optional
    ) // optional
    ->setAddress(
        $country, // optional
        $city, // optional
        $region, // optional
        $details // optional
    ) // optional
    ->setReceiverData(
        $pan, // optional
        $wallet, // optional
        $inn, // optional
        $phone, // optional
        $bankAccount, // optional
        $bic // optional
    ) // optional
    ->setCustomFields(
        $cf1, // optional
        $cf2, // optional
        $cf3, // optional
        $cf4, // optional
        $cf5, // optional
        $merchantThemeCode, // optional
        $merchantContractId, // optional
        $merchantBookingNumber, // optional
        $merchantPhone, // optional
        $merchantFullName, // optional
        $invoiceCallbackUrl // optional
    ) // optional
    ->setCheque($cheque)
;
/* OR */
$request = [
    'billId' => $billId,
    'amount' => [
        'value' => $amount,
        'currency' => $currency,
    ],
    'expirationDateTime' => $expiration,
    'flags' => $flags,
    'customer' => [
        'account' => $account,
        'email' => $email,
        'phone' => $phone,
    ],
    'address' => [
        'country' => $country,
        'city' => $city,
        'region' => $region,
        'details' => $details,
    ],
    'receiverData' => [
        'pan' => $pan,
        'wallet' => $wallet,
        'inn' => $inn,
        'phone' => $phone,
        'bankAccount' => $bankAccount,
        'bic' => $bic,
    ],
    'customFields' => [
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
    ],
    'cheque' => $cheque,
];

$response = $client->paySiteBill($request);
$response->getCode(); // Response code 200
$response->getBody(); // Response data array
/** @var \QiwiClient\Entities\Results\PaySiteBillResult $data */
$data = $response->parseData();

// ...
$billId = $data->getBillId();
// 1.01
$amount = $data->getAmountValue();
// RUB
$currency = $data->getAmountCurrency();
// 2000-00-00T00:00:00+00:00
$exp = $data->getExpirationDateTime();
// 00000000-0000-0000-0000-000000000000
$invoice = $data->getInvoiceUid();
// CREATED
$status = $data->getStatusValue();
// 2000-00-00T00:00:00+00:00
$statusChanged = $data->getStatusChangedDateTime();
// https://oplata.qiwi.com/form?invoiceUid=00000000-0000-0000-0000-000000000000
$url = $data->getPayUrl();

$response = $client->getSiteBillDetails('1663126085');
$response->getCode(); // Response code 200
$response->getBody(); // Response data array
/** @var \QiwiClient\Entities\Results\GetSiteBillDetailsResult $data */
$data = $response->parseData();

// ...
$billId = $data->getBillId();
// 1.01
$amount = $data->getAmountValue();
// RUB
$currency = $data->getAmountCurrency();
// CREATED
$status = $data->getStatusValue();
// 2000-00-00T00:00:00+00:00
$statusChanged = $data->getStatusChangedDateTime();
/* ... */
// https://oplata.qiwi.com/form?invoiceUid=00000000-0000-0000-0000-000000000000
$url = $data->getPayUrl();

/** @var \QiwiClient\Entities\Items\SiteBillPayment $payment */
$payment = $data->getPayments()[0];

// siteId
$siteId = $payment->getSiteId();
// ...
$billId = $payment->getBillId();
// 1.01
$amount = $payment->getAmountValue();
// RUB
$currency = $payment->getAmountCurrency();
// CREATED
$status = $payment->getStatusValue();
/* ... */
// []
$status = $payment->getCustomFields();
```

## Доработка библиотеки
1. В библиотеке присутствует [Dockerfile](Dockerfile), сбилдить образ докера можно так: ``docker build -t "qiwi-php-client" .``
2. Запускать докер-контейнер можно так: ``docker run -it -v $(pwd):/qiwi-php-client qiwi-php-client bash``
3. При первом запуске надо подтянуть зависимости, в контейнере выполнить: ``composer install``
4. Настроено тестовое окружение, для его работы неоходимо скопировать файл `phpunit.xml.dist` в `phpunit.xml`
5. Запуск тестов в контейнере: ``./vendor/bin/phpunit`` 

## Credits

- [Ivan Terentev](https://github.com/terentev-space)
- [All Contributors](https://github.com/terentev-space/qiwi-php-client/contributors)

## License

The MIT License. Please see [License File](LICENSE) for more information.