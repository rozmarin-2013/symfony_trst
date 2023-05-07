<?php

namespace App\Currency\Presentation\Http\Response;

use App\Core\Http\Response\BaseResponse;
use App\Currency\Domain\CurrencyRate;
use Symfony\Component\HttpFoundation\Response;

class CurrencyRateResponse extends BaseResponse
{
    public function __construct(CurrencyRate $currencyRate, int $statusCode = Response::HTTP_OK)
    {
        parent::__construct(self::serializeTextbooks($currencyRate), $statusCode);
    }

    public static function serializeTextbooks(CurrencyRate $currencyRate): array
    {
        return [
            'currency' => $currencyRate->getCurrency()->getCode(),
            'date' => $currencyRate->getUpdatedAt()->format('Y-m-d'),
            'amount' => $currencyRate->getAmount()
        ];
    }
}
