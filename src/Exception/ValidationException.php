<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \Exception
{
    public function __construct(
        private readonly ConstraintViolationListInterface $violationList
    ) {
        parent::__construct("validation failed");
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }
}
