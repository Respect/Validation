<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanCompareValues;

/**
 * Abstract class to help on creating rules that compare value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractComparison extends AbstractRule
{
    use CanCompareValues;

    /**
     * @var mixed
     */
    private $compareTo;

    /**
     * Compare both values and return whether the comparison is valid or not.
     *
     * @param mixed $left
     * @param mixed $right
     */
    abstract protected function compare($left, $right): bool;

    /**
     * Initializes the rule by setting the value to be compared to the input.
     *
     * @param mixed $maxValue
     */
    public function __construct($maxValue)
    {
        $this->compareTo = $maxValue;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        $left = $this->toComparable($input);
        $right = $this->toComparable($this->compareTo);

        if (!$this->isAbleToCompareValues($left, $right)) {
            return false;
        }

        return $this->compare($left, $right);
    }
}
