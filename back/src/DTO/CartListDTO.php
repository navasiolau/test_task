<?php

declare(strict_types=1);

namespace App\DTO;

class CartListDTO implements \JsonSerializable
{
    /**
     * @param CartDTO[]  $cartDTOs
     */
    public function __construct(
        private readonly array $cartDTOs
    ) {
    }

    /**
     * @return array{
     *     carts:cartDTO[]
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'carts' => $this->cartDTOs,
        ];
    }
}
