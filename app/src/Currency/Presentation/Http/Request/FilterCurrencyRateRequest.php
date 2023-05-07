<?php

namespace App\Currency\Presentation\Http\Request;

use App\Core\Http\Request\QueryRequest;
use Symfony\Component\Validator\Constraints\NotBlank;

class FilterCurrencyRateRequest extends QueryRequest
{
    #[NotBlank]
    public string $date;

    #[NotBlank]
    public string $currency;
}
