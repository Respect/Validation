<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Result;
use Respect\Validation\Validatable;

abstract class AbstractEnvelope extends AbstractRule
{
    /**
     * @param mixed[] $parameters
     */
    public function __construct(
        private readonly Validatable $validatable,
        private readonly array $parameters = []
    ) {
    }

    public function validate(mixed $input): bool
    {
        return $this->validatable->validate($input);
    }

    public function evaluate(mixed $input): Result
    {
        return (new Result($this->validatable->evaluate($input)->isValid, $input, $this))
            ->withParameters($this->parameters);
    }

    /**
     * @param mixed[] $extraParameters
     */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException
    {
        return parent::reportError($input, $extraParameters + $this->parameters);
    }
}
