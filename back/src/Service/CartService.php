<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CartDTO;
use App\DTO\CartListDTO;
use App\Entity\Cart;
use App\Repository\CartRepository;
use App\Request\CartUpsertRequest;
use Symfony\Component\HttpFoundation\Request;

class CartService
{
    public function __construct(
        private readonly CartRepository $cartRepository,
    ) {
    }

    public function create(CartUpsertRequest $request): void
    {
        $cart = new Cart();
        $cart->setName($request->getName());

        $this->cartRepository->add($cart, true);
    }

    public function delete(int $cartId): void
    {
        $this->cartRepository
            ->getEntityManager()
            ->wrapInTransaction(function () use ($cartId) {
                $this->cartRepository->removeByCartId($cartId);
            });
    }

    public function edit(int $cartId, Request $request): void
    {
        $cart = $this->cartRepository->get($cartId);

        $cart->setName($request->query->get('name'));
        $cart->setIsSelected($request->query->get('isSelected'));
    }

    public function get(int $cartId): CartDTO
    {
        $cart = $this->cartRepository->find($cartId);

        return new CartDTO(
            id: $cart->getId(),
            name: $cart->getName(),
            isSelected: $cart->isSelected(),
        );
    }

    public function list(): CartListDTO
    {
        return new CartListDTO(
            totalCount: $this->cartRepository->listCount(),
            cartDTOs: array_map(
                function (Cart $cart) {
                    return new CartDTO(
                        id: $cart->getId(),
                        name: $cart->getName(),
                        isSelected: $cart->isSelected(),
                    );
                },
                $this->cartRepository->findAll()
            )
        );
    }
}
