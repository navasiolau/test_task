<?php

declare(strict_types=1);

namespace App\DTO;

class CartListDTO implements \JsonSerializable
{
    /**
     * @param int        $totalCount
     * @param CartDTO[]  $cartDTOs
     */
    public function __construct(
        private readonly int $totalCount,
        private readonly array $cartDTOs
    ) {
    }

    /**
     * @return array{
     *     totalCount:string,
     *     carts:cartDTO[]
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'totalCount' => (string) $this->totalCount,
            'carts' => $this->cartDTOs,
        ];
    }
}
