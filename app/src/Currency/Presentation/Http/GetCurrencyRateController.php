<?php

namespace App\Currency\Presentation\Http;

use App\Core\Http\Response\BaseResponse;
use App\Currency\Application\Service\GetCurrencyRate;
use App\Currency\Presentation\Http\Request\FilterCurrencyRateRequest;
use App\Currency\Presentation\Http\Response\CurrencyRateResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetCurrencyRateController extends AbstractController
{
    public function __construct(
        protected readonly GetCurrencyRate $currencyRate
    ){}
    #[Route('/currency', name: 'currency_search', methods: ['GET'])]
    public function __invoke(FilterCurrencyRateRequest $request): BaseResponse
    {
        $curencyRate = ($this->currencyRate)($request);

        return $curencyRate
            ? new CurrencyRateResponse($curencyRate)
            : new BaseResponse([], 404);
    }
}
