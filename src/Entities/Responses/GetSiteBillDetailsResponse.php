<?php

namespace QiwiClient\Entities\Responses;

use QiwiClient\Entities\ClientResponse;
use QiwiClient\Entities\Items\SiteBillPayment;
use QiwiClient\Entities\Results\GetSiteBillDetailsResult;

class GetSiteBillDetailsResponse extends ClientResponse
{
    public function parseData(): GetSiteBillDetailsResult
    {
        $data = $this->getBody();
        $payments = [];
        foreach ($data['payments'] ?? [] as $payment) {
            $payments[] = new SiteBillPayment(
                $payment['siteId'] ?? null,
                $payment['billId'] ?? null,
                $payment['createdDateTime'] ?? null,
                $payment['amount']['currency'] ?? null,
                $payment['amount']['value'] ?? null,
                $payment['capturedAmount']['currency'] ?? null,
                $payment['capturedAmount']['value'] ?? null,
                $payment['refundedAmount']['currency'] ?? null,
                $payment['refundedAmount']['value'] ?? null,
                $payment['paymentMethod']['type'] ?? null,
                $payment['paymentMethod']['maskedPan'] ?? null,
                $payment['paymentMethod']['rrn'] ?? null,
                $payment['paymentMethod']['authCode'] ?? null,
                $payment['customer']['account'] ?? null,
                $payment['customer']['phone'] ?? null,
                $payment['customer']['address'] ?? null,
                $payment['requirements'] ?? null,
                $payment['status']['value'] ?? null,
                $payment['status']['changedDateTime'] ?? null,
                $payment['status']['reason'] ?? null,
                $payment['customFields'] ?? null
            );
        }
        return new GetSiteBillDetailsResult(
            $data['billId'],
            $data['amount']['value'],
            $data['amount']['currency'],
            $data['status']['value'],
            $data['status']['changedDateTime'],
            $data['comment'] ?? null,
            $data['customFields'] ?? null,
            $data['expirationDateTime'],
            $data['payUrl'],
            $payments
        );
    }
}
