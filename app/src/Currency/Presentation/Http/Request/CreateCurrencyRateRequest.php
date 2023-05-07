<?php

declare(strict_types=1);

namespace App\Currency\Presentation\Http\Request;

use App\Core\Http\Request\PostRequest;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateCurrencyRateRequest extends PostRequest
{
    #[NotBlank]
    public string $currency;

    #[NotBlank]
    #[GreaterThan(0)]
    public float $ammount;
}
