<?php

declare(strict_types=1);

namespace App\Currency\Presentation\Http\Response;

use App\Core\Http\Response\BaseResponse;
use App\Currency\Domain\CurrencyRate;
use Symfony\Component\HttpFoundation\Response;

class CurrencyRateListResponse extends BaseResponse
{
    public function __construct(array $currencyRates, int $statusCode = Response::HTTP_OK)
    {
        parent::__construct(self::serializeTextbooks($currencyRates), $statusCode);
    }

    private static function serializeTextbooks(array $currencyRates): array
    {
        return array_map(
            static fn(CurrencyRate $currencyRate): array => CurrencyRateResponse::serializeTextbooks($currencyRate),
            $currencyRates,
        );
    }
}
