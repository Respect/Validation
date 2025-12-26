<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use Respect\Validation\Helpers\CanCompareValues;
use Respect\Validation\Result;
use Respect\Validation\Rule;

abstract class Comparison implements Rule
{
    use CanCompareValues;

    public function __construct(
        private readonly mixed $compareTo,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $left = $this->toComparable($input);
        $right = $this->toComparable($this->compareTo);

        $parameters = ['compareTo' => $this->compareTo];

        if (!$this->isAbleToCompareValues($left, $right)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->compare($left, $right), $input, $this, $parameters);
    }

    abstract protected function compare(mixed $left, mixed $right): bool;
}
