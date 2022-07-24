<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\CartUpsertRequest;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('carts', name: 'api_cart_')]
class CartController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(CartService $cartService): JsonResponse
    {
        $emailListDTO = $cartService->list();

        return new JsonResponse($emailListDTO);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(CartUpsertRequest $request, CartService $cartService): JsonResponse
    {
        $cartService->create($request);

        return new JsonResponse(status: JsonResponse::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'delete',  methods: ['DELETE'])]
    public function delete(int $id, CartService $cartService): JsonResponse
    {
        $cartService->delete($id);

        return new JsonResponse(status: JsonResponse::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'edit', methods: ['POST'])]
    public function edit(int $id, CartUpsertRequest $request, CartService $cartService): JsonResponse
    {
        $cartService->edit($id, $request);

        return new JsonResponse(status: JsonResponse::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: 'get', methods: ['GET'])]
    public function get(int $id, CartService $cartService): JsonResponse
    {
        $emailDTO = $cartService->get($id);

        return new JsonResponse($emailDTO);
    }
}
