<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;

use function array_diff;
use function is_array;

#[Template(
    '{{name}} must be subset of {{superset}}',
    '{{name}} must not be subset of {{superset}}',
)]
final class Subset extends Standard
{
    /**
     * @param mixed[] $superset
     */
    public function __construct(
        private readonly array $superset
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['superset' => $this->superset];
        if (!is_array($input)) {
            return Result::failed($input, $this)->withParameters($parameters);
        }

        return new Result(array_diff($input, $this->superset) === [], $input, $this, parameters: $parameters);
    }
}
