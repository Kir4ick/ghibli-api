<?php

namespace App\Listener;

use App\Exception\Handler\ExceptionMapping;
use App\Exception\Handler\ExceptionMappingResolver;
use App\Response\ErrorResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ApiExceptionListener
{
    public function __construct(
        readonly private ExceptionMappingResolver $resolver,
        readonly private LoggerInterface $logger,
        readonly private SerializerInterface $serializer
    ){}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $mapping = $this->resolver->resolve($exception::class);
        if ($mapping === null) {
            $mapping = new ExceptionMapping(Response::HTTP_INTERNAL_SERVER_ERROR, true, true);
        }

        var_dump($exception::class, $exception->getPrevious()?->getMessage(), $exception->getTraceAsString());
        die();

        if ($mapping->getCode() >= Response::HTTP_INTERNAL_SERVER_ERROR || $mapping->isLoggable()) {
            $this->logger->error($exception->getMessage(), [
                'trace' => $exception->getTraceAsString(),
                'previous' => $exception->getPrevious()?->getMessage()
            ]);
        }

        $message = $mapping->isHidden() ? Response::$statusTexts[$mapping->getCode()] : $exception->getMessage();

        $data = $this->serializer->serialize(new ErrorResponse($message), JsonEncoder::FORMAT);
        $response = new JsonResponse($data, $mapping->getCode(), [], true);

        $event->setResponse($response);
    }
}
