<?php

declare(strict_types=1);

namespace App\Request;

use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\RequestStack;

class CartUpsertRequest
{
    private InputBag $data;

    public function __construct(RequestStack $requestStack)
    {
        $this->data = $requestStack->getCurrentRequest()->request;
    }

    public function getName(): string
    {
        return $this->data->get('name');
    }

    public function getIsSelected(): bool
    {
        if ($this->data->get('isSelected') == 'true') {
            return true;
        }

        return false;
    }
}
