<?php

declare(strict_types=1);

namespace App\Currency\Presentation\Http\Request;

use App\Core\Http\Request\BaseRequest;
use App\Core\Http\Request\QueryRequest;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class FilterCurrencyRateListRequest extends QueryRequest
{
    #[NotBlank]
    public string $date;
}

