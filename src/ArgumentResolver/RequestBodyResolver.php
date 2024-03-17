<?php

namespace App\ArgumentResolver;

use App\Attributes\RequestBody;
use App\Exception\RequestBodyConvertException;
use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestBodyResolver implements ValueResolverInterface
{

    public function __construct(
        readonly private SerializerInterface $serializer,
        readonly private ValidatorInterface $validator
    ){}

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($argument->getAttributes(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF) <= 0) {
            return [];
        }

        try {
            $model = $this->serializer->deserialize(
                $request->getContent(), $argument->getType(), JsonEncoder::FORMAT
            );
        } catch (\Throwable $exception) {
            throw new RequestBodyConvertException($exception);
        }

        $errors = $this->validator->validate($model);
        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        yield $model;
    }
}
