<?php

namespace QiwiClient;

use QiwiClient\Factories\ClientFactory;

class Qiwi
{
    public const DATETIME_FORMAT = 'Y-m-d\TH:i:sP';

    public const CURRENCY_RUB = 'RUB';
    public const CURRENCY_USD = 'USD';
    public const CURRENCY_KZT = 'KZT';
    public const CURRENCY_EUR = 'EUR';
    public const CURRENCY_CNY = 'CNY';

    public const STATUS_CREATED = 'CREATED';
    public const STATUS_PAID = 'PAID';

    /** @var string Ожидание 3DS авторизации */
    public const STATUS_PAYMENT_WAITING = 'WAITING';
    /** @var string Запрос авторизации отклонен */
    public const STATUS_PAYMENT_DECLINED = 'DECLINED';
    /** @var string Запрос авторизации успешно обработан (Уведомления) */
    public const STATUS_PAYMENT_SUCCESS = 'SUCCESS';
    /** @var string Запрос авторизации успешно обработан (Ответы API) */
    public const STATUS_PAYMENT_COMPLETED = 'COMPLETED';

    /** @var string Запрос возврата отклонен */
    public const STATUS_REFUND_DECLINE = 'DECLINE';
    /** @var string Запрос возврата успешно обработан (Уведомления) */
    public const STATUS_REFUND_SUCCESS = 'SUCCESS';
    /** @var string Запрос возврата успешно обработан (Ответы API) */
    public const STATUS_REFUND_COMPLETED = 'COMPLETED';

    /** @var string Запрос подтверждения отклонен (Уведомления, Ответы API) */
    public const STATUS_CAPTURE_DECLINE = 'DECLINE';
    /** @var string Запрос подтверждения отклонен (Ответ API на запрос статуса) */
    public const STATUS_CAPTURE_DECLINED = 'DECLINED';
    /** @var string Запрос подтверждения успешно обработан (Уведомления) */
    public const STATUS_CAPTURE_SUCCESS = 'SUCCESS';
    /** @var string Запрос подтверждения успешно обработан (Ответы API) */
    public const STATUS_CAPTURE_COMPLETED = 'COMPLETED';

    /** @var string Некорректный статус транзакции */
    public const STATUS_REASON_INVALID_STATE = 'INVALID_STATE';
    /** @var string Некорректная сумма */
    public const STATUS_REASON_INVALID_AMOUNT = 'INVALID_AMOUNT';
    /** @var string Ошибка при передаче данных о получателе */
    public const STATUS_REASON_INVALID_RECEIVER_DATA = 'INVALID_RECEIVER_DATA';
    /** @var string Отклонено MPI */
    public const STATUS_REASON_DECLINED_BY_MPI = 'DECLINED_BY_MPI';
    /** @var string Отклонено fraud-мониторингом */
    public const STATUS_REASON_DECLINED_BY_FRAUD = 'DECLINED_BY_FRAUD';
    /** @var string Повторный запрос авторизации запрещен на основании полученного ответа от Платежной системы */
    public const STATUS_REASON_REATTEMPT_NOT_PERMITTED = 'REATTEMPT_NOT_PERMITTED';
    /** @var string Ошибка взаимодействия с банком */
    public const STATUS_REASON_GATEWAY_INTEGRATION_ERROR = 'GATEWAY_INTEGRATION_ERROR';
    /** @var string Техническая ошибка на стороне банка */
    public const STATUS_REASON_GATEWAY_TECHNICAL_ERROR = 'GATEWAY_TECHNICAL_ERROR';
    /** @var string Техническая ошибка при проведении 3DS аутентификации */
    public const STATUS_REASON_ACQUIRING_MPI_TECH_ERROR = 'ACQUIRING_MPI_TECH_ERROR';
    /** @var string Техническая ошибка */
    public const STATUS_REASON_ACQUIRING_GATEWAY_TECH_ERROR = 'ACQUIRING_GATEWAY_TECH_ERROR';
    /** @var string Техническая ошибка */
    public const STATUS_REASON_ACQUIRING_ACQUIRER_ERROR = 'ACQUIRING_ACQUIRER_ERROR';
    /** @var string Ошибка при проведении авторизации средств */
    public const STATUS_REASON_ACQUIRING_AUTH_TECHNICAL_ERROR = 'ACQUIRING_AUTH_TECHNICAL_ERROR';
    /** @var string Ошибка эмитента. Банк-эмитент не доступен */
    public const STATUS_REASON_ACQUIRING_ISSUER_NOT_AVAILABLE = 'ACQUIRING_ISSUER_NOT_AVAILABLE';
    /** @var string Ошибка эмитента. Подозрение на мошенничество */
    public const STATUS_REASON_ACQUIRING_SUSPECTED_FRAUD = 'ACQUIRING_SUSPECTED_FRAUD';
    /** @var string Ошибка эмитента. Превышен один из лимитов */
    public const STATUS_REASON_ACQUIRING_LIMIT_EXCEEDED = 'ACQUIRING_LIMIT_EXCEEDED';
    /** @var string Ошибка эмитента. Операция не разрешена */
    public const STATUS_REASON_ACQUIRING_NOT_PERMITTED = 'ACQUIRING_NOT_PERMITTED';
    /** @var string Ошибка эмитента. Некорректный CVV */
    public const STATUS_REASON_ACQUIRING_INCORRECT_CVV = 'ACQUIRING_INCORRECT_CVV';
    /** @var string Ошибка эмитента. Неверный срок действия карты */
    public const STATUS_REASON_ACQUIRING_EXPIRED_CARD = 'ACQUIRING_EXPIRED_CARD';
    /** @var string Ошибка эмитента. Проверьте корректность введенных данных */
    public const STATUS_REASON_ACQUIRING_INVALID_CARD = 'ACQUIRING_INVALID_CARD';
    /** @var string Ошибка эмитента. Недостаточно средств */
    public const STATUS_REASON_ACQUIRING_INSUFFICIENT_FUNDS = 'ACQUIRING_INSUFFICIENT_FUNDS';
    /** @var string Неизвестная ошибка */
    public const STATUS_REASON_ACQUIRING_UNKNOWN = 'ACQUIRING_UNKNOWN';
    /** @var string Счет уже оплачен */
    public const STATUS_REASON_BILL_ALREADY_PAID = 'BILL_ALREADY_PAID';
    /** @var string Ошибка при проведении платежа */
    public const STATUS_REASON_PAYIN_PROCESSING_ERROR = 'PAYIN_PROCESSING_ERROR';
    /** @var string Ошибка превышения лимита пользователя QIWI Кошелька */
    public const STATUS_REASON_QW_LIMIT_ERROR = 'QW_LIMIT_ERROR';
    /** @var string Пользователю необходимо пройти идентификацию в QIWI Кошельке */
    public const STATUS_REASON_QW_IDENTIFICATION_ERROR = 'QW_IDENTIFICATION_ERROR';
    /** @var string Ошибка авторизации в QIWI Кошельке */
    public const STATUS_REASON_QW_AUTH_ERROR = 'QW_AUTH_ERROR';
    /** @var string Недостаточно средств в QIWI Кошельке */
    public const STATUS_REASON_QW_INSUFFICIENT_FUNDS = 'QW_INSUFFICIENT_FUNDS';
    /** @var string Недопустимая сумма платежа */
    public const STATUS_REASON_QW_AMOUNT_ERROR = 'QW_AMOUNT_ERROR';
    /** @var string Ошибка регистрации пользователя QIWI Кошелька */
    public const STATUS_REASON_QW_REGISTRATION_ERROR = 'QW_REGISTRATION_ERROR';
    /** @var string Ошибка при пополнении QIWI Кошелька пользователя */
    public const STATUS_REASON_QW_AGENT_ERROR = 'QW_AGENT_ERROR';
    /** @var string QIWI Кошелек заблокирован */
    public const STATUS_REASON_QW_ACCOUNT_ERROR = 'QW_ACCOUNT_ERROR';
    /** @var string Достигнут лимит платежей в QIWI Кошельке */
    public const STATUS_REASON_QW_IDENTIFICATION_STATUS_ERROR = 'QW_IDENTIFICATION_STATUS_ERROR';
    /** @var string Валюта QIWI Кошелька не найдена */
    public const STATUS_REASON_QW_CURRENCY_ERROR = 'QW_CURRENCY_ERROR';
    /** @var string Ошибка проведения платежа в QIWI Кошельке */
    public const STATUS_REASON_QW_PAYMENT_ERROR = 'QW_PAYMENT_ERROR';
    /** @var string Провайдер QIWI Кошелька заблокирован */
    public const STATUS_REASON_QW_PROVIDER_ERROR = 'QW_PROVIDER_ERROR';
    /** @var string Истекло время СМС-подтверждения платежа в QIWI Кошельке */
    public const STATUS_REASON_QW_SMS_CONFIRM_EXPIRED = 'QW_SMS_CONFIRM_EXPIRED';

    /** @var string использовать одношаговый сценарий авторизации. */
    public const FLAG_SALE = 'SALE';
    /** @var string флаг для выпуска платежного токена. */
    public const FLAG_BIND_PAYMENT_TOKEN = 'BIND_PAYMENT_TOKEN';

    public static function client(string $siteId, string $token): Client
    {
        return (new ClientFactory())->make(
            $siteId,
            $token
        );
    }
}
