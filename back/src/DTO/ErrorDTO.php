<?php

declare(strict_types=1);

namespace App\DTO;

class ErrorDTO implements \JsonSerializable
{
    /**
     * @param string   $message
     * @param string[] $errors
     */
    public function __construct(
        private readonly string $message,
        private readonly array $errors = []
    ) {
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'message' => $this->message,
            'errors' => $this->errors,
        ];
    }
}
