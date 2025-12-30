<?php

declare(strict_types=1);

namespace Respect\Validation;

final readonly class CloneValidatorFactory implements ValidatorFactory
{
    public function __construct(
        private Validator $validator,
    ) {
    }

    public function create(): Validator
    {
        return clone $this->validator;
    }
}
