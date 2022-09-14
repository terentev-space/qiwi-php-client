<?php

namespace QiwiClient\Entities\Responses;

use QiwiClient\Entities\ClientResponse;
use QiwiClient\Entities\Results\PaySiteBillResult;

class PaySiteBillResponse extends ClientResponse
{
    public function parseData(): PaySiteBillResult
    {
        $data = $this->getBody();
        return new PaySiteBillResult(
            $data['billId'],
            $data['invoiceUid'],
            $data['amount']['currency'],
            $data['amount']['value'],
            $data['expirationDateTime'],
            $data['status']['value'],
            $data['status']['changedDateTime'],
            $data['payUrl']
        );
    }
}
