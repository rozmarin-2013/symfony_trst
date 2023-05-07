<?php

declare(strict_types=1);

namespace App\Core\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseResponse extends JsonResponse
{
    public const CONTENT_TYPE_HEADER = 'application/vnd.api+json';

    public function __construct(array $data, int $statusCode)
    {
        parent::__construct(
            ['data' => $data],
            $statusCode,
            ['Content-Type' => self::CONTENT_TYPE_HEADER],
        );
    }
}
