<?php

declare(strict_types=1);

namespace App\Currency\Application\Service;

use App\Currency\Domain\CurrencyRate;
use App\Currency\Presentation\Http\Request\FilterCurrencyRateRequest;
use Doctrine\ORM\EntityManagerInterface;

class GetCurrencyRate
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){}
    public function __invoke(FilterCurrencyRateRequest $request)
    {
        $currencyRatesRepository = $this->entityManager->getRepository(CurrencyRate::class);
        $currency = $currencyRatesRepository->findOneByFilters([
            'currency' => $request->currency,
            'date' => $request->date
        ]);

        return $currency[0] ?? [];
    }
}
