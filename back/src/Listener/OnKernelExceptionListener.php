<?php

declare(strict_types=1);

namespace App\Listener;

use App\DTO\ErrorDTO;
use App\Exception\ExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class OnKernelExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ExceptionInterface) {
            $code = $exception->getCode();
            $errorDTO = new ErrorDTO($exception->getMessage(), $exception->getErrors());
        } else {
            $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
            $errorDTO = new ErrorDTO($exception->getMessage(), []);
        }

        $event->setResponse(new JsonResponse($errorDTO, $code));
    }
}
