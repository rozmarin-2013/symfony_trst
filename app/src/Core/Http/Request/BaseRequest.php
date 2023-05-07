<?php

declare(strict_types=1);

namespace App\Core\Http\Request;

use App\Core\Http\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRequest
{
    abstract protected function populate(): void;
    public function __construct(protected ValidatorInterface $validator)
    {
        $this->populate();

        if ($this->autoValidateRequest()) {
            $this->validate();
        }
    }

    public function validate(): void
    {
        $errors = $this->validator->validate($this);

        $messages = ['message' => 'validation_failed', 'errors' => []];

        /** @var \Symfony\Component\Validator\ConstraintViolation  */
        foreach ($errors as $message) {
            $messages['errors'][] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }

        if (count($messages['errors']) > 0) {
            $response = new BaseResponse($messages, 400);
            $response->send();

            exit;
        }
    }

    protected function autoValidateRequest(): bool
    {
        return true;
    }

    public function getRequest(): Request
    {
        return Request::createFromGlobals();
    }
}
