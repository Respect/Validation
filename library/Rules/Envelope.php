<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Result;
use Respect\Validation\Validatable;

abstract class Envelope extends Standard
{
    /** @param array<string, mixed> $parameters */
    public function __construct(
        private readonly Validatable $rule,
        private readonly array $parameters = []
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return new Result($this->rule->evaluate($input)->isValid, $input, $this, $this->parameters);
    }
}
