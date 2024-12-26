<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Result;
use Respect\Validation\Rule;

abstract class Wrapper extends Standard
{
    public function __construct(
        protected readonly Rule $rule
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return $this->rule->evaluate($input);
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }
}
