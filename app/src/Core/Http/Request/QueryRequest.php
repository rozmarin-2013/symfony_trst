<?php

namespace App\Core\Http\Request;

use Symfony\Component\HttpFoundation\Request;

class
QueryRequest extends BaseRequest
{
    protected function populate(): void
    {
        $request = $this->getRequest()->query->all();

        foreach ($request as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
