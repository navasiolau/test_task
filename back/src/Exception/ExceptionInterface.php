<?php

namespace App\Exception;

interface ExceptionInterface
{
    /**
     * @return string[]
     */
    public function getErrors(): array;
}
