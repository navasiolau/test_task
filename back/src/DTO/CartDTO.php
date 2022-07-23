<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

class CartDTO implements JsonSerializable
{
    /**
     * @param int $id
     * @param string $name
     * @param bool $isSelected
     */
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly bool $isSelected
    ) {
    }

    /**
     * @return array{
     *     id:string,
     *     name:string,
     *     isSelected:boolean
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'isSelected' => $this->isSelected,
        ];
    }
}
