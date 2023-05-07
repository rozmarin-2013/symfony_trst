<?php

declare(strict_types=1);

namespace App\Currency\Presentation\Http;

use App\Core\Http\Response\BaseResponse;
use App\Currency\Application\Service\CreateCurrencyRateService;
use App\Currency\Presentation\Http\Request\CreateCurrencyRateRequest;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CreateCurrencyRateController
{
    public function __construct(
        private CreateCurrencyRateService $createCurrencyRateService
    ) {}

    #[Route('/currency', name: 'currency_create', methods: ['Post'])]
    public function __invoke(CreateCurrencyRateRequest $request)
    {
        try {
            ($this->createCurrencyRateService)($request);
        } catch (\Exception $e) {
            return new BaseResponse(['error' => $e->getMessage()], 400);
        }

        return new BaseResponse([], 204);
    }
}
