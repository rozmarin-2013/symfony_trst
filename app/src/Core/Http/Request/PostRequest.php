<?php

namespace App\Core\Http\Request;

use Symfony\Component\HttpFoundation\Request;

class PostRequest extends BaseRequest
{
    protected function populate(): void
    {
        foreach ($this->getRequest()->toArray() as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
