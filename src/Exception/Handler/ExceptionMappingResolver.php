<?php

namespace App\Exception\Handler;

use InvalidArgumentException;

class ExceptionMappingResolver
{
    private array $mappings;

    public function __construct(array $mappings)
    {
        foreach ($mappings as $class => $mapping) {
            if (! isset($mapping['code'])) {
                throw new InvalidArgumentException('error code not found');
            }

            $this->mapException($class, $mapping['code'], $mapping['hidden'] ?? false, $mapping['loggable'] ?? true);
        }
    }

    private function mapException(string $class, int $code, bool $hidden, bool $loggable): void
    {
        $this->mappings[$class] = new ExceptionMapping($code, $hidden, $loggable);
    }

    public function resolve(string $throwableClass): ?ExceptionMapping
    {
        foreach ($this->mappings as $class => $exceptionMapping) {
            if ($class == $throwableClass || is_subclass_of($throwableClass, $class)) {
                return $exceptionMapping;
            }
        }

        return null;
    }
}
