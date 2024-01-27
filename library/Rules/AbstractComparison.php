<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanCompareValues;

abstract class AbstractComparison extends AbstractRule
{
    use CanCompareValues;

    private readonly mixed $compareTo;

    abstract protected function compare(mixed $left, mixed $right): bool;

    public function __construct(mixed $maxValue)
    {
        $this->compareTo = $maxValue;
    }

    public function validate(mixed $input): bool
    {
        $left = $this->toComparable($input);
        $right = $this->toComparable($this->compareTo);

        if (!$this->isAbleToCompareValues($left, $right)) {
            return false;
        }

        return $this->compare($left, $right);
    }
}
