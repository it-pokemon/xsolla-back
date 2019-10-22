<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $exceptionMessage = $exception->getMessage();
        $exceptionStatusCode = $exception->getCode();

        $response = new Response();
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
            $exceptionStatusCode = $exception->getStatusCode();
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $message = json_encode(array(
            "error" => $exceptionMessage,
            "code" => $exceptionStatusCode
        ), JSON_UNESCAPED_UNICODE);

        $response->setContent($message);

        $event->setResponse($response);
    }
}