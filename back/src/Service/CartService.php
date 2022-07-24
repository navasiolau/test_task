<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CartDTO;
use App\DTO\CartListDTO;
use App\Entity\Cart;
use App\Exception\ValidationException;
use App\Repository\CartRepository;
use App\Request\CartUpsertRequest;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CartService
{
    public function __construct(
        private readonly CartRepository $cartRepository,
        private readonly ValidatorInterface $validator
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function create(CartUpsertRequest $request): void
    {
        $cart = new Cart($request->getName());

        $errors = $this->validator->validate($cart);
        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

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

    public function edit(int $cartId, CartUpsertRequest $request): void
    {
        $cart = $this->cartRepository->find($cartId);

        $cart->setName($request->getName());
        $cart->setIsSelected($request->getIsSelected());

        $this->cartRepository->add($cart, true);
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
