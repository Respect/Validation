<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Result;
use Respect\Validation\Rule;

abstract class Envelope implements Rule
{
    /** @param array<string, mixed> $parameters */
    public function __construct(
        private readonly Rule $rule,
        private readonly array $parameters = [],
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of($this->rule->evaluate($input)->hasPassed, $input, $this, $this->parameters);
    }
}
