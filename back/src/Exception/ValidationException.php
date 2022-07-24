<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends Exception implements ExceptionInterface
{
    private const STATUS_CODE = Response::HTTP_UNPROCESSABLE_ENTITY;
    private const MESSAGE = 'Validation failed';

    public function __construct(private readonly ConstraintViolationListInterface $errors)
    {
        parent::__construct(self::MESSAGE, self::STATUS_CODE);
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->errors as $error) {
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}
