<?php

declare(strict_types=1);

namespace App\Currency\Application\Service;

use App\Currency\Domain\CurrencyRate;
use App\Currency\Presentation\Http\Request\FilterCurrencyRateListRequest;
use Doctrine\ORM\EntityManagerInterface;

class GetCurrencyRateList
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){}
    public function __invoke(FilterCurrencyRateListRequest $request)
    {
        $currencyRatesRepository = $this->entityManager->getRepository(CurrencyRate::class);
        $currencyRatesList = $currencyRatesRepository->findAllByDate($request->date);

        return $currencyRatesList;
    }
}
