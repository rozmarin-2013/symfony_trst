<?php

declare(strict_types=1);

namespace App\Currency\Application\Service;

use App\Currency\Domain\Currency;
use App\Currency\Domain\CurrencyRate;
use App\Currency\Presentation\Http\Request\CreateCurrencyRateRequest;
use Doctrine\ORM\EntityManagerInterface;

class CreateCurrencyRateService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){}
    public function __invoke(CreateCurrencyRateRequest $request)
    {
        $currencyRepository = $this->entityManager->getRepository(Currency::class);
        $currency = $currencyRepository->findOneBy(['code' => $request->currency]);

        if (!$currency) {
            throw new \Exception('invalid argument');
        }

        $currencyRate = new CurrencyRate();
        $currencyRate->setCurrency($currency);
        $currencyRate->setAmount($request->ammount);
        $this->entityManager->persist($currencyRate);
        $this->entityManager->flush();
    }
}
