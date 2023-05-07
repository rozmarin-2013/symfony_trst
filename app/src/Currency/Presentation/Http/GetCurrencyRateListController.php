<?php

declare(strict_types=1);

namespace App\Currency\Presentation\Http;

use App\Currency\Application\Service\GetCurrencyRateList;
use App\Currency\Presentation\Http\Request\FilterCurrencyRateListRequest;
use App\Currency\Presentation\Http\Response\CurrencyRateListResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class GetCurrencyRateListController extends AbstractController
{
    public function __construct(
        protected readonly GetCurrencyRateList $currencyRateList
    ){}

    #[Route('/currencies', name: 'currency_list', methods: ['GET'])]
    public function __invoke(FilterCurrencyRateListRequest $request)
    {
        $currencyRateList = ($this->currencyRateList)($request);

        return new CurrencyRateListResponse($currencyRateList);
    }
}
